<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<a href="{{route('index')}}">Назад</a>
@foreach($team as $teams)
    <h2>Команда</h2>
    <img src="/images/{{$teams->image}}" style="width:100px;height:100px">
    <p>{{$teams->name}}</p>
    <p>{{$teams->description}}</p>
    <h3>Участники</h3>
    @foreach($users as $user)
        <p>{{$user->name}} {{$user->surname}}</p>
    @endforeach
    @if(Auth::user()->id == $teams->leaderid)
        <h3>Заявки:</h3>
        @if($userrequests != null)
        @foreach($userrequests as $requesta)
            <p>{{$requesta->name}} {{$requesta->surname}}</p>
            @foreach($requestz as $reqs)
            <form action="acceptRequest" method="POST">
                @csrf
                <input type="text" name="requestid" value="{{$reqs->id}}" style="display:none">
                <button>Принять</button>
            </form>
            <form action="declineRequest" method="POST">
                @csrf
                <input type="text" name="requestid" value="{{$reqs->id}}" style="display:none">
                <button>Отказать</button>
            </form>
            @endforeach
        @endforeach
        @endif
    @endif
@endforeach
</body>
</html>
