@extends('Layouts.app')

@section('content')
<div class="container">
    <div class="page-section">
        <h2>Dashboard</h2>

        @if(session('success'))
            <div class="alert" style="background:var(--success);color:#fff;padding:1rem;border-radius:.5rem;margin-bottom:1rem">
                {{ session('success') }}
            </div>
        @endif

        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <p>{{ __('You are logged in!') }}</p>
    </div>
</div>
@endsection
