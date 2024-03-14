@extends('layouts.app')

@section('titulo')
    {{$post->title}}
@endsection

@section('contenido')
    <div class="container mx-auto md:flex">
        <div class="md:w-1/2">
            <img src="{{asset('uploads' . '/' . $post->image)}}" alt="imagen del post {{$post->title}}" class="w-full">
            <div class="p-3">
                <p>0 likes</p>
            </div>
            <div>
                <p class="font-bold"> {{$post->user->username}}</p>
                <p class="text-sm text-gray-500">
                    {{$post->created_at->diffForHumans()}}
                </p>
                <p class="mt-5">
                    {{$post->content}}
                </p>
            </div>
            @auth
                @if($post->user->id === auth()->user()->id)
                <form action="{{route('posts.destroy', ["user"=> $post->user, "post"=> $post])}}" method="POST">
                    @method('DELETE')
                    @csrf
                    <input
                        type="submit"
                        value="Eliminar Publicación"
                        class="bg-red-500 hover:bg-red-600 p-2 rounded text-white font-bold mt-4 cursor-pointer"
                    />
                </form>
                @endif
            @endauth
        </div>
        <div class="md:w-1/2 p-5">
            <div class="bg-white p-5 mb-5">
                @auth
                <p class="font-bold text-xl text-center mb-4">Agrega un Nuevo Comentario</p>

                @if (session('success'))
                    <div class="bg-green-500 text-white p-3 rounded-lg text-center mb-5">
                        {{ session('success') }}
                    </div>
                @endif
                    <form action="{{route('comentarios.store', ['user'=> $post->user, 'post' => $post])}}" method="POST">
                        @csrf
                        <div class="mb-5">
                            <label for="content" class="mb-2 block uppercase text-gray-500 font-bold">Comentario</label>
                            <textarea id="content" name="content" placeholder="Agrega un comentario" class="border p-3 w-full rounded-lg  @error('content') border-red-500 @enderror">{{old('content')}}</textarea>    
                            @error('content')
                                <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                            @enderror
                        </div>
                        <button type="submit" class="bg-blue-500 w-full p-3 text-white uppercase font-bold rounded-lg"> Comentar </button>
                    </form>
                @endauth
                <div class="shadow bg-white mb-5 max-h-96 overflow-y-scroll">
                    @if($post->comentarios->count() > 0)
                        @foreach ($post->comentarios as $comentario)
                            <div class="p-5 border-gray-300 border-b">
                                <a class="font-bold" href="{{route('posts.index', $comentario->user)}}">
                                    {{$comentario->user->username}}
                                </a>
                                <p>{{$comentario->content}}</p>
                                <p class="text-sm text-gray-500">{{$comentario->created_at->diffForHumans()}}</p>
                            </div>
                        @endforeach
                    @else
                        <p class="text-center text-gray-500">No hay comentarios</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection