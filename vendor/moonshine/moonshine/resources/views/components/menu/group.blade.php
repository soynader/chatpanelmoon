@props([
    'item',
    'top' => false,
])
<li
    @if($top)
        class="menu-inner-item dropdown"
        x-data="dropdown"
        x-ref="dropdownEl"
        @click.outside="closeDropdown"
        data-dropdown-placement="bottom-start"
    @else
        class="menu-inner-item"
        x-data="{ dropdown: {{ $item->isActive() ? 'true' : 'false' }} }"
    @endif
>
    <button
        @if($top)
            @click="toggleDropdown"
            class="menu-inner-button dropdown-btn"
            :class="open && '_is-active'"
        @else
        x-data="navTooltip"
            @mouseenter="toggleTooltip()"
            @click.prevent="dropdown = ! dropdown"
            class="menu-inner-button"
            :class="dropdown && '_is-active'"
        @endif
        type="button"
    >
        @if($item->iconValue())
            {!! $item->getIcon(6) !!}
        @elseif(!$top)
            <span class="menu-inner-item-char">
                {{ str($item->label())->limit(2) }}
            </span>
        @endif

        <span class="menu-inner-text">{{ $item->label() }}</span>
        <span class="menu-inner-arrow">
            <x-moonshine::icon
                icon="heroicons.chevron-down"
                size="6"
                color="gray"
            />
        </span>
    </button>

    @if($item->items())
        <!-- Dropdown Menu -->
        <ul
            @if($top)
                class="menu-inner-dropdown dropdown-body"
            @else
                class="menu-inner-dropdown"
                style="display: none"
                x-show="dropdown"
                x-transition.top
            @endif
        >
            @foreach($item->items() as $child)
                @if($child->isGroup())
                    <x-moonshine::menu.group :item="$child"/>
                @else
                    <x-moonshine::menu.item :item="$child"/>
                @endif
            @endforeach
        </ul>
        <!-- END: Dropdown Menu -->
    @endif
</li>
