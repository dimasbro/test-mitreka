@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Role') }}</div>

                <div class="card-body">
                    @if ($message = Session::get('error'))
                        <div class="alert alert-danger alert-block">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            {{ $message }}
                        </div>
                    @endif
                    <form action="{{ route('role.update', $data->role_id) }}" method="POST">
                    {{ csrf_field() }}
                    <input type="hidden" name="_method" value="PUT">
                        <div class="form-group">
                          <label>Role Name <span class="text-danger">*</span></label>
                          <input type="text" class="form-control" name="role_name" value="{{ old('role_name') ?? $data->role_name }}">
                          @error('role_name')
                              <span style="color:red">{{ $message }}</span>
                          @enderror
                        </div>
                        <div class="form-group">
                            <label>Permission</label>
                            @foreach (\App\Models\MenuItem::where('parent_id', 0)->get() as $menuItem)
                                <x-menu-select :menuItem="$menuItem" :permissions="$permissions" />
                            @endforeach
                        </div>
                        <button type="submit" class="btn btn-primary">Save</button>
                      </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
