<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="{{ asset('js/script.js') }}"></script>
</head>
<body>
    <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
        <div style="text-align: center;margin: auto;">
            <h1>Заметки пользователя {{Auth::user()->name}}</h1>
            <input type="text" id="titleAdd">
            <input type="text" id="contentAdd">
            <button type="submit" class="btn btn-success" onclick="createNote()">Добавить заметку</button>
            @if(count($notes) === 0)
                <h3 style="color: chartreuse">Заметки пока не созданы...</h3>
            @else
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Title</th>
                        <th scope="col">Content</th>
                        <th scope="col"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($notes as $note)
                        <tr>
                            <th scope="row">{{$note->id}}</th>
                            <td><input type="text" id="titleUpdate" value="{{$note->title}}"></td>
                            <td><input type="text" id="contentUpdate" value="{{$note->content}}"></td>
                            <td><button onclick="updateNote({{$note->id}})">Сохранить изменения</button></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @endif
        </div>
</body>
</html>
