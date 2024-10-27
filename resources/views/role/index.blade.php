@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Role') }}</div>

                <div class="col-md-12 text-right" style="padding-top: 20px">
                    <a href="{{ route('role.create') }}" class="btn btn-primary btn-sm">Create</a>
                </div>

                <div class="card-body">
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success alert-block">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            {{ $message }}
                        </div>
                    @endif
                    <table class="table table-striped">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Role Name</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $key => $dt)
                                <tr>
                                    <th scope="row">{{ $key+1 }}</th>
                                    <td>{{ $dt->role_name }}</td>
                                    <td>
                                        <a href="{{ route('role.edit', $dt->role_id) }}" class="btn btn-success btn-sm">Edit</a>
                                        <a href="{{ route('role.delete', $dt->role_id) }}" class="btn btn-danger btn-sm"  onclick="return confirm('Are you sure delete {{ $dt->role_name }}?')">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                      </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection