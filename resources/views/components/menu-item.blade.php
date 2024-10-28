<style>
ul, li {
    list-style-type: none;
}
</style>

<div>
    @if ($menuItem->children->count())
        @if (!empty ($permissions) && in_array($menuItem->id, $permissions))
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" onclick="toggleMenu(event, '{{ $menuItem->id }}')">
                    {{ $menuItem->title }}
                </a>
        @endif
    @else
        @if (!empty ($permissions) && in_array($menuItem->id, $permissions))
            <li class="nav-item">
                @if (!$menuItem->parent_id)
                    <a class="nav-link" href="{{ $menuItem->url }}">{{ $menuItem->title }}</a>
                @endif
        @endif
    @endif
        @if ($menuItem->children->count())
            @if (!empty ($permissions) && in_array($menuItem->id, $permissions))
                <ul>
                    <div class="dropdown-menu" id="menu-{{ $menuItem->id }}">
                        @foreach($menuItem->children as $child)
                            <a class="dropdown-item" href="{{ $child->url }}">{{ $child->title }}</a>
                            <x-menu-item :menuItem="$child" :permissions="$permissions"/>
                        @endforeach
                    </div>
                </ul>
            @endif
        @endif
    @if (!empty ($permissions) && in_array($menuItem->id, $permissions))
        </li>
    @endif

</div>
