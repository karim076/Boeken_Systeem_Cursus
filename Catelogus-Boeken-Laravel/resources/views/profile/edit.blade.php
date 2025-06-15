@extends('layouts.app')

@section('content')
<div class="container mx-auto py-6 px-4">
    <div class="max-w-3xl mx-auto">
        <!-- Update Profile Information -->
        <div class="bg-white shadow rounded-lg p-6 mb-6">
            @include('profile.partials.update-profile-information-form')
        </div>

        <!-- Update Password -->
        <div class="bg-white shadow rounded-lg p-6 mb-6">
            @include('profile.partials.update-password-form')
        </div>

        <!-- Delete Account -->
        <div class="bg-white shadow rounded-lg p-6">
            @include('profile.partials.delete-user-form')
        </div>
    </div>
</div>
@endsection
