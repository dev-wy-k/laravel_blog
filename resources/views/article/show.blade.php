@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">

            @component("component.breadcrumb")
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('article.index') }}">Article</a></li>
                <li class="breadcrumb-item active" aria-current="page">Details</li>
            @endcomponent

            <div class="card">
                <div class="card-header">Article Detail</div>

                <div class="card-body">
                    @inject("users", "App\User")
                    <h4>{{ $article->title }}</h4>
                    <div class="">
                        <small>
                            <span class="mr-2">
                                <i class="fas fa-user text-primary"></i>
                                {{ $users->find($article->user_id)->name }}
                            </span>
                            <span>
                                <i class="far fa-clock text-success"></i>
                                {{ $article->created_at->diffForHumans() }}
                            </span>
                        </small>
                    </div>
                    <br>
                    <p>{{ $article->description }}</p>
                    <div class="">
                        @foreach($article->getPhotos as $p)
                            <a href="{{ asset('storage/article/'.$p->location) }}" target="_blink">
                                <img src="{{ asset('storage/article/'.$p->location) }}" class="rounded shadow-sm mt-2 mr-2" style="width: 200px;" alt="">
                            </a>
                        @endforeach
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
