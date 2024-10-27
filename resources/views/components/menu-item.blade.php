<style>
ul, li {
    list-style-type: none;
}
</style>

<div>
    <!-- He who is contented is rich. - Laozi -->
    @if (!empty ($permissions))
        <li class="nav-item">
            @if (!empty ($permissions) && in_array($menuItem->id, $permissions))
                @if($menuItem->children->count())
                    <a class="nav-link" href="{{ $menuItem->url }}" onclick="toggleMenu(event, '{{ $menuItem->id }}')">
                        {{ $menuItem->title }}
                        <i class="fas fa-chevron-down"></i> <!-- Arrow icon -->
                    </a>
                @else
                    <a class="nav-link" href="{{ $menuItem->url }}">{{ $menuItem->title }}</a>
                @endif
            @endif
            @if($menuItem->children->count())
                <ul class="nav flex-column ml-3 collapse" id="menu-{{ $menuItem->id }}">
                    @foreach($menuItem->children as $child)
                        <x-menu-item :menuItem="$child" :permissions="$permissions"/>
                    @endforeach
                </ul>
            @endif
        </li>
    @endif

</div>
