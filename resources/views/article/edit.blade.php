@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">

            @component("component.breadcrumb")
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('article.index') }}">Article</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit Article</li>
            @endcomponent

            <div class="card">
                <div class="card-header">Edit Article</div>
                
                <div class="card-body">

                    @if(session("status"))
                        <p class="alert alert-success">
                            {!! session("status") !!}
                        </p>
                    @endif
                    

                    <div class="row align-items-center">
                        <div class="col-12 col-md-6">
                            <form action="{{ route('article.update', $article->id) }}" id="form-update" method="post">
                                @csrf
                                @method("put")
                                <div class="form-group">
                                    <label for="title">Article Title</label>
                                    <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" 
                                    value="{{ $errors->any() ? old('title') : $article->title }}">
                                    @error('title')
                                        <small class="font-weight-bold text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror"  rows="15">{{ $errors->any() ? old('description') : $article->description }}</textarea>
                                    @error('description')
                                        <small class="font-weight-bold text-danger">{{ $message }}</small>
                                    @enderror
                                </div>                        
                                
                            </form>
                        </div>
                        

                        <div class="col-12 col-md-6">
                            @foreach($article->getPhotos as $p)
                                <div class="d-inline-block">
                                    <img src="{{ asset('storage/article/'.$p->location) }}" class="rounded shadow-sm mr-1" style="width: 150px; height:150px;" alt="">
                                    <form action="{{ route('photo.destroy', $p->id) }}" method="post">
                                        @csrf
                                        @method("delete")
                                        <button class="btn btn-danger btn-sm" style="margin-top: -80px; margin-left: 10px">Delete</button>
                                    </form>
                                </div>
                            @endforeach

                            <form action="{{ route('photo.store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-row">

                                <input type="hidden" name="article_id" value="{{$article->id}}">
                                    <div class="col-6">
                                        <input type="file" name="photo[]" id="photo" class="form-control p-1" multiple>
                                        @error('photo.*')
                                            <small class="font-weight-bold text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-6">
                                        <button class="btn btn-secondary">Upload Photo</button>
                                    </div>

                                </div>                        
                            </form>
                        </div>
                    </div>

                    <hr>
                    <button class="btn btn-primary float-right" form="form-update">Update Article</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

