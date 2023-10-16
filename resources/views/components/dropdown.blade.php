<div class="dropdown" x-bind:class="{closed: closed}"  @click.outside="closed = !closed" @close.stop="open = false">
    <div class="trigger" @click="closed = ! closed">
        {{ $trigger }}
    </div>

    <div class="content" x-show="!closed"
         {{--            x-transition:enter="transition ease-out duration-200"--}}
         {{--            x-transition:enter-start="opacity-0 scale-95"--}}
         {{--            x-transition:enter-end="opacity-100 scale-100"--}}
         {{--            x-transition:leave="transition ease-in duration-75"--}}
         {{--            x-transition:leave-start="opacity-100 scale-100"--}}
         {{--            x-transition:leave-end="opacity-0 scale-95"--}}
         @click="open = false">
        {{ $content }}
    </div>
</div>
