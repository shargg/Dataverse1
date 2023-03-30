@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Edit User</h1>
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <form action="{{ route('users.update.post', $user->id) }}" method="GET" id="editUserForm" data-user-id="{{ $user->id }}">
                @csrf
                @method('POST')
                <input type="hidden" name="_method" value="PUT">
                <div class="form-group">
                    <label for="is_active">Active</label>
                    <input type="checkbox" name="is_active" id="is_active" value="1" {{ $user->is_active ? 'checked' : '' }}>
                </div>
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" name="name" id="name" value="{{ $user->name }}">
                </div>
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" name="username" value="{{ $user->username }}">
                    <span class="text-danger error-username"></span>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" name="email" id="email" value="{{ $user->email }}">
                    <span class="text-danger error-email"></span>
                </div>
                <div class="form-group">
                    <label for="password">Password (leave blank to keep current password)</label>
                    <input type="password" class="form-control" name="password" id="password">
                </div>
                <div class="form-group">
                    <label for="password_confirmation">Confirm Password</label>
                    <input type="password" class="form-control" name="password_confirmation" id="password_confirmation">
                </div>
                <div class="form-group">
                    <label for="roles">Roles</label><br>
                    <input type="checkbox" name="roles[]" value="Technical Manager" @if(in_array('Technical Manager', $user->roles->pluck('name')->toArray())) checked @endif> Technical Manager<br>
                    <input type="checkbox" name="roles[]" value="User and Subscriber Manager" @if(in_array('User and Subscriber Manager', $user->roles->pluck('name')->toArray())) checked @endif> User and Subscriber Manager<br>
                    <input type="checkbox" name="roles[]" value="Questions/Answers Manager" @if(in_array('Questions/Answers Manager', $user->roles->pluck('name')->toArray())) checked @endif> Questions/Answers Manager<br>
                    <input type="checkbox" name="roles[]" value="Content Manager" @if(in_array('Content Manager', $user->roles->pluck('name')->toArray())) checked @endif> Content Manager<br>
                    <input type="checkbox" name="roles[]" value="Jurisprudence - Legislation Manager" @if(in_array('Jurisprudence - Legislation Manager', $user->roles->pluck('name')->toArray())) checked @endif> Jurisprudence - Legislation Manager<br>
                    <input type="checkbox" name="roles[]" value="Newsletter and News Manager" @if(in_array('Newsletter and News Manager', $user->roles->pluck('name')->toArray())) checked @endif> Newsletter and News Manager<br>
                </div>
                <button type="submit" class="btn btn-primary">Save</button>
                <div class="alert alert-success" style="display:none;"></div>
                <div class="alert alert-danger" style="display:none;"></div>
                <a href="{{ route('users.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
@section('scripts')
<script src="{{ asset('js/user.js') }}"></script>
@endsection
@endsection
