@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('User') }}</div>

                <div class="card-body">
                    @if ($message = Session::get('error'))
                        <div class="alert alert-danger alert-block">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            {{ $message }}
                        </div>
                    @endif
                    <form action="{{ route('user.update', $data->id) }}" method="POST">
                    {{ csrf_field() }}
                    <input type="hidden" name="_method" value="PUT">
                        <div class="form-group">
                          <label>Name <span class="text-danger">*</span></label>
                          <input type="text" class="form-control" name="name" value="{{ old('name') ?? $data->name }}">
                          @error('name')
                              <span style="color:red">{{ $message }}</span>
                          @enderror
                        </div>
                        <div class="form-group">
                            <label>Email <span class="text-danger">*</span></label>
                            <input type="email" class="form-control" name="email" value="{{ old('email') ?? $data->email }}">
                            @error('email')
                                <span style="color:red">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                          <label for="exampleInputPassword1">Password</label>
                          <input type="password" class="form-control" name="password">
                          @error('password')
                              <span style="color:red">{{ $message }}</span>
                          @enderror
                        </div>
                        <div class="form-group">
                            <label>Role <span class="text-danger">*</span></label>
                            <select name="role" class="form-control">
                                <option value="">- Pilih -</option>
                                @foreach ($roles as $rl)
                                    <option value="{{ $rl->role_id }}" {{ $rl->role_id == old('role') || $rl->role_id == $data->role_id ? 'selected' : '' }}>{{ $rl->role_name }}</option>
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
