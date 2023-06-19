@extends('app')
 @section('title', 'Assessment')
@push('css')
<style>

    .profile-image-container {
        position: relative;
        display: inline-block;
        margin-bottom: 20px;
    }
    .edit-icon {
        position: absolute;
        top: 0;
        right: 0;
        background-color: rgba(255, 255, 255, 0.8);
        padding: 5px;
        cursor: pointer;
    }
    .update-image-form {
        display: flex;
        flex-direction: column;
        align-items: center;
    }
    .update-image-button {
        padding: 10px;
        background-color: transparent;
        color: #007bff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        text-decoration: underline;
    }
    .update-image-button:hover {
        background-color: transparent;
        color: #0069d9;
    }
</style>
@endpush

@section('content')
{{-- @dd($user_data) --}}
@checkAdmin
    @include('dashboard.admin-index')
@else
    @include('dashboard.user-index')
@endcheckAdmin
{{--    @include('dashboard.pages.users.update_image')--}}
@endsection
