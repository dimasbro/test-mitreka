<style>
ul, li {
  list-style-type: none;
}
</style>

<div>
    <!-- Smile, breathe, and go slowly. - Thich Nhat Hanh -->
    <li class="nav-item">
        <input type="checkbox" name="permission[]" value="{{ $menuItem->id }}" {{ (!empty ($permissions) && in_array($menuItem->id, $permissions)) ? 'checked' : '' }}> {{ $menuItem->title }}
        @if($menuItem->children->count())
            <ul>
                @foreach($menuItem->children as $child)
                    <x-menu-select :menuItem="$child" :permissions="$permissions"/>
                @endforeach
            </ul>
        @endif
    </li>
</div>
