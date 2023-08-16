<?php

namespace App;

use App\Models\Artist;
use App\Models\Mp3File;
use Exception;
use Psr\Log\LoggerInterface;
use Sbehnfeldt\Mp3lib\ID3TagsReader;

class Importer
{
    private ID3TagsReader $reader;

    private LoggerInterface $logger;

    private static array $tagNameMap = [
        'UFID' => '',
        'TIT2' => 'title',
        'TALB' => 'album',
        'TPE1' => 'author',
        'TPE2' => 'album_author',
        'TRCK' => 'track',
        'TYER' => 'year',
        'TLEN' => 'length',
        'USLT' => 'lyric',
        'TPOS' => 'desc',
        'TCON' => 'genre',
        'TENC' => 'encoded',
        'TCOP' => 'copyright',
        'TPUB' => 'publisher',
        'TOPE' => 'original_artist',
        'WXXX' => 'url',
        'COMM' => 'comments',
        'TCOM' => 'composer',

        'APIC' => 'album_art',
        'PRIV' => 'private_data'
    ];


    /**
     * @param  ID3TagsReader  $reader
     * @param  LoggerInterface  $logger
     */
    public function __construct(ID3TagsReader $reader, LoggerInterface $logger)
    {
        $this->reader = $reader;
        $this->logger = $logger;
    }

    /**
     * @return ID3TagsReader
     */
    public function getReader(): ID3TagsReader
    {
        if (!isset($this->reader)) {
            $this->reader = new ID3TagsReader();
        }
        return $this->reader;
    }

    /**
     * @param  ID3TagsReader  $reader
     */
    public function setReader(ID3TagsReader $reader): void
    {
        $this->reader = $reader;
    }

    /**
     * @return LoggerInterface
     */
    public function getLogger(): LoggerInterface
    {
        return $this->logger;
    }

    /**
     * @param  LoggerInterface  $logger
     */
    public function setLogger(LoggerInterface $logger): void
    {
        $this->logger = $logger;
    }

    /**
     * @param  string  $dir
     * @return void
     *
     * Recursively import all MP3 files in the specified directory into the database.
     *
     * "Importing" will record the MP3 filename and all ID3v2 tags as a single database record.
     */
    public function import(string $dir)
    {
        $this->logger->info(sprintf('Importing directory "%s"', $dir));
        $this->scanDirectory($dir);
        $this->logger->info(sprintf('Import of directory "%s" complete', $dir));
    }


    private function scanDirectory(string $dir): void
    {
        $entries = scandir($dir);
        $this->logger->notice(sprintf('Scanning directory "%s"', $dir));
        foreach ($entries as $entry) {
            if (in_array($entry, ['.', '..'])) {
                continue;
            }
            $pathname = implode(DIRECTORY_SEPARATOR, [$dir, $entry]);
            if (is_dir($pathname)) {
                $this->scanDirectory($pathname);
            } elseif (is_file($pathname)) {
                try {
                    if (null !== ($tags = $this->scanFile($pathname))) {
                        $this->importTags($tags);
                    }
                } catch (Exception $e) {
                    $this->logger->warning(sprintf('Error scanning file "%s": %s"', $pathname, $e->getMessage()));
                }
            } else {
                $this->logger->warning(sprintf('Directory entry "%s" does not register as either a directory or file',
                    $pathname));
            }
        }
        $this->logger->notice(sprintf('Scanning of directory "%s" complete', $dir));
    }


    public function scanFile(string $pathname): ?array
    {
        if ('mp3' !== strtolower(pathinfo($pathname, PATHINFO_EXTENSION))) {
            return null;
        }
        $id3v2tag = $this->getReader()->readId3v2Tag($pathname);
        $tags     = [
            'filename' => $pathname
        ];
        foreach ($id3v2tag['frames'] as $frame) {
            if (!array_key_exists($frame['identifier'], self::$tagNameMap)) {
                continue;
            }
            if ('UFID' === $frame['identifier']) {
                $tags['UfidOwner']      = $frame['data'][0];
                $tags['UfidIdentifier'] = $frame['data'][1];
            } else {
                $tagName        = self::$tagNameMap[$frame['identifier']];
                $tags[$tagName] = $frame['data'];
                if ('TALB' === $frame['identifier']) {
                    $albumName = $frame['data'];
                } elseif ('TPE1' === $frame['identifier']) {
                    $artistName = $frame['data'];
                }
            }
            if (empty($artistName)) {
                $temp       = explode(DIRECTORY_SEPARATOR, $pathname);
                $artistName = $temp[count($temp) - 3];
            }
            // TODO: See if artist is already in database; insert if not


            if (empty($albumName)) {
                $temp      = explode(DIRECTORY_SEPARATOR, $pathname);
                $albumName = $temp[count($temp) - 2];
            }
            // TODO: See if album is already in adatabase; insert if not
        }

        return $tags;
    }

    /**
     * @param  array  $tags
     * @return void
     *
     * TODO: Write the tags to the database.
     * @throws Exception
     */
    private function importTags(array $tags): void
    {
        if (!array_key_exists('filename', $tags)) {
            throw new Exception('Missing required filename');
        }

        if (array_key_exists('author', $tags)) {
            $artist = Artist::where(['name' => $tags['author']])->first();


            if (!$artist) {
                $artist = new Artist(['name' => $tags['author']]);
                $artist->save();
            }
            $tags['author_id'] = $artist->id;
        }

        $tags['filename_hash'] = md5($tags['filename']);

        $mp3 = Mp3File::where([
            'filename_hash' => $tags['filename_hash']
        ])->first();


        if ($mp3) {
            echo("TODO: Update\n");
        } else {
            $mp3 = new Mp3File($tags);
            $mp3->save();
        }
    }
}
