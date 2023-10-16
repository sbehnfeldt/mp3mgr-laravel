<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <table>
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Artist</th>
                                <th>Album</th>
                                <th>Track #</th>
                                <th>Filename</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($mp3s as $mp3)
                            <tr>
                                <td>{{$mp3->title}}</td>
                                <td>{{$mp3->artist?->name}}</td>
                                <td>{{$mp3->album?->title}}</td>
                                <td>{{$mp3->track}}</td>
                                <td>{{$mp3->filename}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
