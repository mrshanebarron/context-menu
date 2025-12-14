<div
    x-data="{ show: @entangle('show'), x: @entangle('x'), y: @entangle('y') }"
    x-show="show"
    x-on:click.away="show = false"
    x-on:keydown.escape.window="show = false"
    :style="`position: fixed; left: ${x}px; top: ${y}px;`"
    class="z-50 min-w-48 bg-white rounded-lg shadow-lg border border-gray-200 py-1 overflow-hidden"
    style="display: none;"
>
    @foreach($items as $index => $item)
        @if(isset($item['divider']) && $item['divider'])
            <div class="border-t border-gray-200 my-1"></div>
        @else
            <button
                wire:click="selectItem({{ $index }})"
                class="w-full px-4 py-2 text-left text-sm text-gray-700 hover:bg-gray-100 flex items-center gap-3 {{ isset($item['disabled']) && $item['disabled'] ? 'opacity-50 cursor-not-allowed' : '' }}"
                @if(isset($item['disabled']) && $item['disabled']) disabled @endif
            >
                @if(isset($item['icon']))
                    <span class="w-4 h-4 flex-shrink-0">{!! $item['icon'] !!}</span>
                @endif
                <span>{{ $item['label'] ?? '' }}</span>
                @if(isset($item['shortcut']))
                    <span class="ml-auto text-xs text-gray-400">{{ $item['shortcut'] }}</span>
                @endif
            </button>
        @endif
    @endforeach
</div>
