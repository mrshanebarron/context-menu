<div
    x-data="{
        open: false,
        x: 0,
        y: 0,
        show(e) {
            e.preventDefault();
            this.x = e.clientX;
            this.y = e.clientY;
            this.open = true;
        },
        hide() {
            this.open = false;
        }
    }"
    @contextmenu="show($event)"
    @click="hide()"
    @keydown.escape.window="hide()"
    class="relative"
>
    {{ $slot }}

    <div
        x-show="open"
        x-transition:enter="transition ease-out duration-100"
        x-transition:enter-start="opacity-0 scale-95"
        x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-75"
        x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-95"
        :style="{ position: 'fixed', left: x + 'px', top: y + 'px' }"
        @click.outside="hide()"
        class="z-50 min-w-[160px] bg-white rounded-lg shadow-lg border border-gray-200 py-1 overflow-hidden"
    >
        @foreach($items as $index => $item)
            @if(isset($item['divider']) && $item['divider'])
                <div class="my-1 border-t border-gray-200"></div>
            @else
                <button
                    type="button"
                    wire:click="selectItem('{{ $item['action'] ?? '' }}')"
                    @click="hide()"
                    @class([
                        'w-full flex items-center gap-3 px-4 py-2 text-sm text-left hover:bg-gray-100 transition-colors',
                        'text-red-600 hover:bg-red-50' => isset($item['danger']) && $item['danger'],
                        'text-gray-700' => !isset($item['danger']) || !$item['danger'],
                    ])
                >
                    @if(isset($item['icon']))
                        <span class="w-4 h-4">{!! $item['icon'] !!}</span>
                    @endif
                    {{ $item['label'] }}
                    @if(isset($item['shortcut']))
                        <span class="ml-auto text-xs text-gray-400">{{ $item['shortcut'] }}</span>
                    @endif
                </button>
            @endif
        @endforeach
    </div>
</div>
