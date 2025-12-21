<style>[x-cloak] { display: none !important; }</style>
<div
    x-data="{ show: @entangle('show'), x: @entangle('x'), y: @entangle('y') }"
    x-show="show"
    x-cloak
    x-on:click.away="show = false; $wire.closeContextMenu()"
    x-on:keydown.escape.window="show = false; $wire.closeContextMenu()"
    x-transition:enter="transition ease-out duration-100"
    x-transition:enter-start="opacity-0 scale-95"
    x-transition:enter-end="opacity-100 scale-100"
    x-transition:leave="transition ease-in duration-75"
    x-transition:leave-start="opacity-100 scale-100"
    x-transition:leave-end="opacity-0 scale-95"
    :style="`position: fixed; left: ${x}px; top: ${y}px; z-index: 50; min-width: 12rem; background-color: white; border-radius: 0.5rem; box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1), 0 4px 6px -2px rgba(0,0,0,0.05); border: 1px solid #e5e7eb; padding: 0.25rem 0; overflow: hidden;`"
>
    @foreach($this->items as $index => $item)
        @if(isset($item['divider']) && $item['divider'])
            <div style="border-top: 1px solid #e5e7eb; margin: 0.25rem 0;"></div>
        @else
            @php
                $isDanger = isset($item['danger']) && $item['danger'];
                $isDisabled = isset($item['disabled']) && $item['disabled'];
                $textColor = $isDanger ? '#dc2626' : '#374151';
                $hoverBg = $isDanger ? '#fef2f2' : '#f3f4f6';
            @endphp
            <button
                wire:click="selectItem({{ $index }})"
                style="width: 100%; padding: 0.5rem 1rem; text-align: left; font-size: 0.875rem; color: {{ $textColor }}; display: flex; align-items: center; gap: 0.75rem; border: none; background: transparent; cursor: {{ $isDisabled ? 'not-allowed' : 'pointer' }}; opacity: {{ $isDisabled ? '0.5' : '1' }};"
                onmouseover="this.style.backgroundColor='{{ $hoverBg }}'"
                onmouseout="this.style.backgroundColor='transparent'"
                @if($isDisabled) disabled @endif
            >
                @if(isset($item['icon']))
                    <span style="width: 1rem; height: 1rem; flex-shrink: 0; display: flex; align-items: center; justify-content: center;">{!! $item['icon'] !!}</span>
                @endif
                <span>{{ $item['label'] ?? '' }}</span>
                @if(isset($item['shortcut']))
                    <span style="margin-left: auto; font-size: 0.75rem; color: #9ca3af;">{{ $item['shortcut'] }}</span>
                @endif
            </button>
        @endif
    @endforeach
</div>
