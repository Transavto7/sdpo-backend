@extends('layouts.app')

@section('content')
    <div class="content versions create">
        <div class="title">Добавление версии СДПО</div>

        <form action="/versions/{{ $version->id }}" method="POST" class="create" enctype="multipart/form-data">
            @method('PUT')
            @if($errors->any())
                <h4>{{$errors->first()}}</h4>
            @endif

            @csrf
            <input type="text" required name="name" placeholder="Введите название версии" value="{{ $version->name }}">
            <input type="file" name="file">
            <div class="checkbox">
                <input type="checkbox" name="is_main" id="is_main" @checked($version->is_main)>
                <label for="is_main">Основная версия</label>
            </div>
            <button class="button" type="submit">Сохранить</button>
        </form>
    </div>
@endsection
