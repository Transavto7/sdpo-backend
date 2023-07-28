@extends('layouts.app')

@section('content')
    <div class="content versions">
        <div class="title">Версии СДПО</div>

        <a href="/versions/create" class="button">
            <i class="ri-add-line"></i> Добавить
        </a>
        <table class="versions__list">
            <tr>
                <th>Версия</th>
                <th>Hash</th>
                <th>Дата создания</th>
                <th>Дата изменения</th>
                <th></th>
            </tr>
            @foreach($versions as $version)
                <tr @if($version->is_main) class="active" @endif>
                    <td>{{ $version->name }}</td>
                    <td>{{ $version->hash }}</td>
                    <td>{{ $version->created_at }}</td>
                    <td>{{ $version->updated_at }}</td>
                    <td class="buttons">
                        <a href="/versions/{{ $version->id }}" class="button icon success">
                            <i class="ri-download-2-line"></i>
                        </a>
                        <a href="/versions/{{ $version->id }}/edit" class="button icon">
                            <i class="ri-pencil-line"></i>
                        </a>
                        <form action="/versions/{{ $version->id }}" method="POST">
                            @csrf
                            @method('DELETE')

                            <button class="button icon danger" type="submit">
                                <i class="ri-delete-bin-7-line"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection
