@extends('layouts.app')

@section('content')
    <div class="login">
        <form action="/login" method="POST">
            @csrf
            @if($errors->any())
                <h4>{{$errors->first()}}</h4>
            @endif

            <input type="password" name="password" placeholder="Введите пароль">
            <button class="button" type="submit">Войти</button>
        </form>
    </div>
@endsection
