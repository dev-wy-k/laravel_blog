@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">

            @component("component.breadcrumb")
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit Profile</li>
            @endcomponent
            
        </div>

        <div class="col-12 col-md-4">
            <div class="card  mb-3">
                <div class="card-header">Edit Profile</div>
                
                <div class="card-body">

                    <img src="{{ asset('storage/profile/'.Auth::user()->photo) }}" class="w-100 rounded"  alt="">

                    <form action="{{ route('profile.update') }}" method="post" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="photo" class="mt-3">Choose User Photo</label>
                            <input type="file" name="photo" id="photo" class="form-control p-1">
                            @error('photo')
                                <small class="font-weight-bold text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <button class="btn btn-primary w-100">Update Photo</button>

                    </form>
                    
                </div>
            </div>


            <div class="card">
                <div class="card-header">Edit Profile</div>
                
                <div class="card-body">

                <form method="POST" action="{{ route('profile.changePassword') }}">
                    @csrf 

                    <div class="form-group">
                        <label for="password" class="">Current Password</label>
                        <input id="password" type="password" class="form-control @error('current_password') is-invalid @enderror" name="current_password" autocomplete="current-password">
                        @error('current_password')
                            <small class="font-weight-bold text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password" class="">New Password</label>
                        <input id="new_password" type="password" class="form-control @error('new_password') is-invalid @enderror" name="new_password" autocomplete="current-password">
                        @error('new_password')
                            <small class="font-weight-bold text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password" class="">New Confirm Password</label>
                        <input id="new_confirm_password" type="password" class="form-control @error('new_confirm_password') is-invalid @enderror" name="new_confirm_password" autocomplete="current-password">
                        @error('new_confirm_password')
                            <small class="font-weight-bold text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary w-100">
                        Change Password
                    </button>
                </form>
                    
                </div>
            </div>
            
        </div>

        <div class="col-12 col-md-8">
            <div class="card">

                <div class="card-header">Uploded Photo</div>


                <div class="card-body">
                    @foreach(Auth::user()->getPhoto as $p)
                        <img src="{{ asset('storage/article/'.$p->location) }}" class="rounded shadow-sm mt-2" style="width: 120px; height:120px;" alt="">
                    @endforeach
                </div>

            </div>
        </div>

        
    </div>
</div>
@endsection
