@extends('layouts.app')

@section('content')
    <div class="content versions create">
        <div class="title">Добавление версии СДПО</div>

        <form action="/versions" method="POST" class="create" enctype="multipart/form-data">
            @if($errors->any())
                <h4>{{$errors->first()}}</h4>
            @endif

            @csrf
            <input type="text" required name="name" placeholder="Введите название версии">
            <input type="file" name="file" required>
                <div class="checkbox">
                    <input type="checkbox" name="is_main" id="is_main">
                    <label for="is_main">Основная версия</label>
                </div>
            <button class="button" type="submit">Добавить</button>
        </form>
    </div>
@endsection
