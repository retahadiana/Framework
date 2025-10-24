@extends('layouts.app')

@section('title', 'Login - RSHP UNAIR')

@push('styles')
<style>
    .login-container {
        max-width: 500px;
        margin: 5rem auto;
        padding: 2rem;
        background: var(--white);
        border-radius: var(--border-radius-lg);
        box-shadow: var(--shadow-lg);
    }
    .form-group {
        margin-bottom: 1.5rem;
    }
    .form-group label {
        display: block;
        margin-bottom: 0.5rem;
        font-weight: 600;
        color: var(--neutral-700);
    }
    .form-group input {
        width: 100%;
        padding: 0.75rem 1rem;
        border-radius: var(--border-radius-md);
        border: 1px solid var(--neutral-300);
        font-size: 1rem;
    }
    .form-group input:focus {
        outline: none;
        border-color: var(--primary-teal);
        box-shadow: 0 0 0 3px rgba(8, 145, 178, 0.2);
    }
</style>
@endpush

@section('content')
<div class="login-container">
    <h2 style="text-align: center; color: var(--primary-teal);">Login</h2>
    <form action="#" method="POST">
        {{-- @csrf --}}
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>
        </div>
        <div class="form-group">
            <button type="submit" class="button-primary" style="width: 100%;">Login</button>
        </div>
        <div style="text-align: center; margin-top: 1rem;">
            <a href="#">Lupa Password?</a>
        </div>
    </form>
</div>
@endsection