@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Menu Item') }}</div>

                <div class="card-body">
                    @if ($message = Session::get('error'))
                        <div class="alert alert-danger alert-block">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            {{ $message }}
                        </div>
                    @endif
                    <form action="{{ route('menu-item.update', $data->id) }}" method="POST">
                    {{ csrf_field() }}
                    <input type="hidden" name="_method" value="PUT">
                        <div class="form-group">
                          <label>Title <span class="text-danger">*</span></label>
                          <input type="text" class="form-control" name="title" value="{{ old('title') ?? $data->title }}">
                          @error('title')
                              <span style="color:red">{{ $message }}</span>
                          @enderror
                        </div>
                        <div class="form-group">
                            <label>URL <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="url" value="{{ old('url') ?? $data->url }}">
                            @error('url')
                                <span style="color:red">{{ $message }}</span>
                            @enderror
                          </div>
                          <div class="form-group">
                            <label>Parent</label>
                            <select name="parent" class="form-control">
                                <option value="0">- Pilih -</option>
                                @foreach ($parents as $p)
                                    <option value="{{ $p->id }}" {{ $p->id == old('parent') || $p->id == $data->parent_id ? 'selected' : '' }}>{{ $p->title }}</option>
                                @endforeach
                            </select>
                            @error('role')
                                <span style="color:red">{{ $message }}</span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Save</button>
                      </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
