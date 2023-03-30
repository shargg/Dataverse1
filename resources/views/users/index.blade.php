@extends('layouts.app')
@section('styles')
<style>
    .add-user-btn {
        padding: 12px 10px;
        font-size: 18px;
    }
</style>
@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>User Management</h1>
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <div class="d-flex justify-content-between">
                <div class="form-group">
                    <label for="per_page">Show:</label>
                    <select id="per_page" class="form-control" onchange="updatePerPage(this.value)">
                        <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10</option>
                        <option value="30" {{ request('per_page') == 30 ? 'selected' : '' }}>30</option>
                        <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
                        <option value="100" {{ request('per_page') == 100 ? 'selected' : '' }}>100</option>
                    </select>
                </div>
                <a href="{{ route('users.create') }}" class="btn btn-primary add-user-btn">Add User</a>
            </div>
            <table class="table table-bordered mt-3">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Username</th> 
                        <th>Roles</th>
                        <th>Active</th>
                        <th>Actions</th>                       
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{ $user->name}}</td>
                            <td>{{ $user->username}}</td>
                            <td>
                                @foreach($user->roles as $role)
                                    <div class="role-item">{{ $role->name }}</div>
                                @endforeach
                            </td>
                            <td>{{ $user->is_active}}</td>
                            <td>
                                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="d-inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger btn-delete" data-user-id="{{ $user->id }}">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-end">
                {{ $users->appends(['per_page' => request('per_page')])->links() }}
            </div>
        </div>
    </div>
</div>
@section('scripts')
<script>
    function updatePerPage(value) {
        const url = new URL(window.location.href);
        url.searchParams.set('per_page', value);
        window.location.href = url.href;
    }
</script>
<script src="{{ asset('js/user.js') }}"></script>
@endsection
@endsection
