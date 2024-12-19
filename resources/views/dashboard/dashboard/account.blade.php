@extends('dashboard.master')
@section('content')
<div class="card-body">
    <div class="d-flex align-items-start align-items-sm-center gap-4">
        <img
            src="{{ $user->avatar ? asset('storage/avatars/' . $user->avatar) : asset('assets/img/avatars/1.png') }}"
            alt="user-avatar"
            class="d-block rounded"
            height="100"
            width="100"
            id="uploadedAvatar"
        />
        <div class="button-wrapper">
            <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                <span class="d-none d-sm-block">Upload new photo</span>
                <i class="bx bx-upload d-block d-sm-none"></i>
                <input
                    type="file"
                    id="upload"
                    class="account-file-input"
                    hidden
                    accept="image/png, image/jpeg"
                />
            </label>
            <button type="button" class="btn btn-outline-secondary account-image-reset mb-4">
                <i class="bx bx-reset d-block d-sm-none"></i>
                <span class="d-none d-sm-block">Reset</span>
            </button>
            <p class="text-muted mb-0">Allowed JPG, GIF or PNG. Max size of 800K</p>
        </div>
    </div>
</div>
<hr class="my-0" />
<div class="card-body">
    <form id="formAccountSettings" method="POST" action="{{ route('account.update') }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="mb-3 col-md-6">
                <label for="firstName" class="form-label">First Name</label>
                <input
                    class="form-control"
                    type="text"
                    id="firstName"
                    name="firstName"
                    value="{{ old('firstName', $user->first_name) }}"
                    autofocus
                />
            </div>
            <div class="mb-3 col-md-6">
                <label for="lastName" class="form-label">Last Name</label>
                <input class="form-control" type="text" name="lastName" id="lastName" value="{{ old('lastName', $user->last_name) }}" />
            </div>
            <div class="mb-3 col-md-6">
                <label for="email" class="form-label">E-mail</label>
                <input
                    class="form-control"
                    type="email"
                    id="email"
                    name="email"
                    value="{{ old('email', $user->email) }}"
                    placeholder="john.doe@example.com"
                />
            </div>
            <div class="mb-3 col-md-6">
                <label for="phoneNumber" class="form-label">Phone Number</label>
                <div class="input-group input-group-merge">
                    <span class="input-group-text">US (+1)</span>
                    <input
                        type="text"
                        id="phoneNumber"
                        name="phoneNumber"
                        class="form-control"
                        placeholder="202 555 0111"
                        value="{{ old('phoneNumber', $user->phone_number) }}"
                    />
                </div>
            </div>
            <div class="mb-3 col-md-6">
                <label for="address" class="form-label">Address</label>
                <input type="text" class="form-control" id="address" name="address" placeholder="Address" value="{{ old('address', $user->address) }}" />
            </div>
            <!-- New photo field -->
            <div class="mb-3 col-md-6">
                <label for="avatar" class="form-label">Profile Photo</label>
                <input
                    type="file"
                    class="form-control"
                    id="avatar"
                    name="avatar"
                    accept="image/*"
                />
            </div>
        </div>
        <div class="mt-2">
            <button type="submit" class="btn btn-primary me-2">Save changes</button>
            <button type="reset" class="btn btn-outline-secondary">Cancel</button>
        </div>
    </form>

</div>
@endsection
