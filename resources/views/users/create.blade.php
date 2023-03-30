@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Add User</h1>
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <form action="{{ route('users.store') }}" method="POST" id="createUserForm">
                @csrf
                <div class="form-group">
                    <label for="is_active">Active</label>
                    <input type="checkbox" name="is_active" id="is_active" value="1">
                </div>
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" name="name" id="name" required>
                </div>
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" name="username" id="username">
                    <span class="text-danger error-username"></span>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" name="password" id="password">
                    <span class="text-danger error-password"></span>
                </div>
                <div class="form-group">
                    <label for="password_confirmation">Confirm Password</label>
                    <input type="password" class="form-control" name="password_confirmation" id="password_confirmation">
                    <span class="text-danger error-password_confirmation"></span>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" name="email" id="email">                  
                    <span class="text-danger error-email"></span>
                </div>
                <div class="form-group">
                    <label for="roles">Roles</label><br>
                    <input type="checkbox" name="roles[]" value="Technical Manager"> Technical Manager<br>
                    <input type="checkbox" name="roles[]" value="User and Subscriber Manager"> User and Subscriber Manager<br>
                    <input type="checkbox" name="roles[]" value="Questions/Answers Manager"> Questions/Answers Manager<br>
                    <input type="checkbox" name="roles[]" value="Content Manager"> Content Manager<br>
                    <input type="checkbox" name="roles[]" value="Jurisprudence - Legislation Manager"> Jurisprudence - Legislation Manager<br>
                    <input type="checkbox" name="roles[]" value="Newsletter and News Manager"> Newsletter and News Manager<br>
                    <div class="text-danger error-roles" style="display:none;"></div>
                </div>
                <br>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary" id="submitBtn">Submit</button>
                </div>
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
