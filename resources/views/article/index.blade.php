@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">

            @component("component.breadcrumb")
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Article</li>
            @endcomponent

            <div class="card">
                <div class="card-header">Article List</div>

                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="">
                            {{ $articles->appends(Request::all())->links() }}
                        </div>

                        <div class="">
                            <form action="{{ route('article.index') }}" method="get">
                                <div class="form-inline mb-3">
                                    <input type="text" class="form-control mr-2" name="search" >
                                    <button class="btn btn-primary">Search</button>
                                </div>  
                            </form>
                        </div>
                    </div>

                    @if(session("delete"))
                        <p class="alert alert-danger">
                            {!! session("delete") !!}
                        </p>
                    @endif

                    @if(session("updateStatus"))
                        <p class="alert alert-success">
                            {!! session("updateStatus") !!}
                        </p>
                    @endif

                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Title</th>
                                <th>Description</th>
                                @if(Auth::user()->role == 0)
                                <th>Owner</th>
                                @endif
                                <th>Control</th>
                                <th class="text-nowrap">Created At</th>
                            </tr>
                        </thead>

                        <tbody>                            
                            
                            @foreach($articles as $article)
                                <tr>
                                    <td>{{ $article->id }}</td>
                                    <td>{{ substr($article->title,0,30) }}.....</td>
                                    <td>
                                        {{ substr($article->description,0,80) }}.....
                                        <br>
                                        @foreach($article->getPhotos as $p)
                                            <img src="{{ asset('storage/article/'.$p->location) }}" class="rounded shadow-sm mt-2" style="width: 50px; height:50px;" alt="">
                                        @endforeach
                                    </td>
                                    @if(Auth::user()->role == 0)
                                    <td class="text-nowrap">
                                        @isset($article->getUser)
                                            {{ $article->getUser->name }}
                                        @else
                                            Unknown
                                        @endisset   
                                    </td>
                                    @endif
                                    <td class="text-nowrap">
                                        <a href="{{ route('article.show', $article->id) }}" class="btn btn-info btn-sm">Detail</a>
                                        <a href="{{ route('article.edit', $article->id) }}" class="btn btn-secondary btn-sm">Edit</a>                                        
                                        <form action="{{ route('article.destroy', $article->id) }}" method="post" class="d-inline-block">
                                            @csrf
                                            @method("delete")
                                            <button class="btn btn-danger btn-sm" type="submit">Delete</button>
                                        </form>
                                    </td>
                                    <td class="text-nowrap">
                                        <small>
                                            {{ $article->created_at->format("d M Y") }}
                                            <br>
                                            {{ $article->created_at->format("h:i a") }}
                                        </small>
                                    </td>                                    
                                </tr>
                            @endforeach
                        </tbody>
                        
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
