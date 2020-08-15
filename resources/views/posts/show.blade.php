@extends('layouts.app')

@section('title', $post->title)

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                @if ($post->thumbnail)
                <a href="{{ route('posts.show', $post->slug) }}">
                    <img style="height: 500px; object-fit: cover; object-position: top;" class="rounded w-100" src="{{ $post->takeImage() }}">
                </a>
                @endif
                <h1>{{ $post->title }}</h1>
                <div class="text-secondary mb-3">
                    <a href="/categories/{{ $post->category->slug }}">{{ $post->category->name }}</a> 
                    &middot; {{ $post->created_at->format('d F, Y') }}
                    &middot;
                    @foreach ($post->tags as $tag)
                        <a href="/tags/{{ $tag->slug }}">{{ $tag->name }}</a> 
                    @endforeach
        
                    <div class="media my-3">
                        <img width="65" class="rounded-circle mr-3" src="{{ $post->author->gravatar() }}">
                        <div class="media-body">
                            <div>
                                {{ $post->author->name }}
                            </div>
                            {{ '@' . $post->author->username }}
                        </div>
                    </div>
        
                </div>
        
                <p>{!! nl2br($post->body) !!}</p>
        
                <div>
                    <!-- Button trigger modal -->
                    @can('delete', $post)
                        <div class="flex mt-3">
                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#exampleModal">
                                Delete
                            </button>
        
                            <a href="{{ route('posts.edit', $post->slug) }}" class="btn btn-sm btn-success">Edit</a>
                        </div>
        
                        <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Yakin ingin hapus??</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            <form action="/posts/{{ $post->slug }}/delete" method="post">
                                @csrf
                                @method('delete')
                                <div class="modal-body">
                                    <div>{{ $post->title }}</div>
                                    <div>
                                        Published: {{ $post->created_at->format('d F, Y') }}
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </div>
                            </form>
                        </div>
                        </div>
                    </div>
                    @endcan
                </div>
            </div>
            
            <div class="col-md-4 mt-4">
                @foreach ($posts as $post)
                <div class="card mb-3">    

                    <div class="card-body">

                        <div>
                            <a href="{{ route('categories.show', $post->category->slug) }}" class="text-secondary">
                                <small>{{ $post->category->name }} - </small>
                            </a>

                             @foreach ($post->tags as $tag)
                                <a href="{{ route('tags.show', $tag->slug) }}" class="text-secondary">
                                    <small>{{ $tag->name }}</small>
                                </a>
                            @endforeach
                        </div>

                        <h5>
                            <a class="text-dark" href="{{ route('posts.show', $post->slug) }}" class="card-title">
                                {{ $post->title }}
                            </a>
                        </h5>
                        

                        <div>
                            {{ Str::limit($post->body, 130) }}
                        </div>

                        <div class="d-flex justify-content-between align-items-center mt-2">
                            <div class="media align-items-center">
                                <img width="40" class="rounded-circle mr-3" src="{{ $post->author->gravatar() }}">
                                <div class="media-body">
                                    <div>
                                        {{ $post->author->name }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection

