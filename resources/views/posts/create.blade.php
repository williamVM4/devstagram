@extends('layouts.app')

@section('titulo')
    Crear una nueva Publicación
@endsection

@push('styles')
<link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
@endpush

@section('contenido')
    <div class="md:flex md:items-center">
        <div class="md:w-1/2 px-10">
            <form action="{{route('imagenes.store')}}" id="dropzone" class="dropzone border-dashed border-2 w-full h-96 rounded flex flex-col justify-center items-center">
                @csrf
            </form>
        </div>
        <div class="md:w-1/2 p-8 bg-white rounded-lg shadow-xl mt-10 md:mt-0">
            <form action="{{ route('register') }}" method="POST" novalidate>
                @csrf
                <div class="mb-5">
                    <label for="titulo" class="mb-2 block uppercase text-gray-500 font-bold">
                        Titulo
                    </label>
                    <input id="titulo" name="titulo" type="text" placeholder="Titulo de la publicación" class="border p-3 w-full rounded-lg  @error('titulo') border-red-500 @enderror" value="{{old('titulo')}}"/>
                    @error('titulo')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="descripcion" class="mb-2 block uppercase text-gray-500 font-bold">
                        Descripción
                    </label>
                    <textarea id="descripcion" name="descripcion" placeholder="Descripción de la publicación" class="border p-3 w-full rounded-lg  @error('descripcion') border-red-500 @enderror">{{old('descripcion')}}</textarea>    
                    @error('descripcion')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                    @enderror
                </div>
                <button type="submit" class="bg-blue-500 w-full p-3 text-white uppercase font-bold rounded-lg"> Publicar </button>
            </form>
        </div>
    </div>
@endsection