@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            @component("component.breadcrumb")
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('article.index') }}">Article</a></li>
                <li class="breadcrumb-item active" aria-current="page">Add Article</li>
            @endcomponent

            <div class="card">
                <div class="card-header">Add Article</div>
                
                <div class="card-body">

                    @if(session("status"))
                        <p class="alert alert-success">
                            {!! session("status") !!}
                        </p>
                    @endif

                    <form action="{{ route('article.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="title">Article Title</label>
                            <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}">
                            @error('title')
                                <small class="font-weight-bold text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-12 col-md-6">
                                    <label for="photo">Upload Photo</label>
                                    <input type="file" name="photo[]" id="photo" class="form-control p-1" multiple>
                                    @error('photo.*')
                                        <small class="font-weight-bold text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror"  rows="10">{{ old('description') }}</textarea>
                            @error('description')
                                <small class="font-weight-bold text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        
                        <button class="btn btn-primary">Save Article</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
