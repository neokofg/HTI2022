<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<style>
    /* Dropdown Button */
    .dropbtn {
        background-color: #04AA6D;
        color: white;
        padding: 16px;
        font-size: 16px;
        border: none;
    }

    /* The container <div> - needed to position the dropdown content */
    .dropdown {
        position: relative;
        display: inline-block;
    }

    /* Dropdown Content (Hidden by Default) */
    .dropdown-content {
        display: none;
        position: absolute;
        background-color: #f1f1f1;
        min-width: 160px;
        box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
        z-index: 1;
    }

    /* Links inside the dropdown */
    .dropdown-content a {
        color: black;
        padding: 12px 16px;
        text-decoration: none;
        display: block;
    }

    /* Change color of dropdown links on hover */
    .dropdown-content a:hover {background-color: #ddd;}

    /* Show the dropdown menu on hover */
    .dropdown:hover .dropdown-content {display: block;}

    /* Change the background color of the dropdown button when the dropdown content is shown */
    .dropdown:hover .dropbtn {background-color: #3e8e41;}
</style>
<body>
    <a href="{{route('hackathons')}}">Назад</a>
    @if(Auth::user()->role == 1)
        @foreach($hackathon as $hack)
        <form action="{{route('editHackathon')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="text" style="display:none" value="{{$hack->id}}" name="id">
            <button type="button" id="editBtn">Редактировать</button>
            <button type="button" style="display:none" id="0">Назад</button>
            <input type="file" name="image" style="display:none" id="1">
            <input type="text" name="name" value="{{$hack->name}}" placeholder="Название" style="display:none" id="2">
            <input type="date" name="date" value="{{$hack->date}}" placeholder="Дата" style="display:none" id="3">
            <input type="number" name="prize" value="{{$hack->prize}}" placeholder="Призовой фонд" style="display:none" id="4">
            <textarea type="text" name="description" placeholder="Описание" style="display:none" id="5">{{$hack->description}}</textarea>
            <div class="dropdown" style="display:none" id="6">
                <button class="dropbtn">Добавить трек:</button>
                <div class="dropdown-content">
                    @foreach($tracks as $track)
                        <input type="checkbox" name="track" value="{{$track->id}}" @if($track->id == $hack->tracks)checked @endif>{{$track->name}}
                    @endforeach
                </div>
            </div>
            <input type="submit" style="display:none" id="7">
        </form>
        <form action="{{route('deleteHackathon')}}" method="POST">
            @csrf
            <input type="text" style="display:none" name="id" value="@foreach($hackathon as $hack){{$hack->id}} @endforeach">
            <button type="submit">Удалить</button>
        </form>
        @endforeach
    @endif
    @foreach($hackathon as $hack)
        <h2>{{$hack->name}}</h2>
        <img src="/images/{{$hack->image}}" style="width:500px;height:300px">
        <h3>{{$hack->prize}} руб.</h3>
        <p>{{$hack->description}}</p>
        <p>{{$hack->date}}</p>
    @endforeach
    <h2>Участники</h2>
    <ul>
    @foreach($team as $teamnames)
        <li>{{$teamnames->name}}</li>
    @endforeach
    </ul>
    <br>
    <h2>Треки</h2>
        @foreach($tracks as $track)
            <a href="images/{{$track->pdf}}"><ya-tr-span>{{$track->name}}</ya-tr-span></a>
            <br>
        @endforeach
    <br>
    @if(Auth::check())
    <form action="{{route('participate')}}" method="POST">
        @csrf
        <input type="text" name="hackid" value="{{$hack->id}}" style="display:none">
        <button>Участвовать</button>
    </form>
    @endif
</body>
</html>
<script type="text/javascript">
    let editBtn = document.getElementById('editBtn')
    let zero = document.getElementById('0')
    let one = document.getElementById('1')
    let two = document.getElementById('2')
    let three = document.getElementById('3')
    let four = document.getElementById('4')
    let five = document.getElementById('5')
    let six = document.getElementById('6')
    let seven = document.getElementById('7')
    editBtn.onclick = function(){
        editBtn.style.display = "none";
        zero.style.display = "block";
        one.style.display = "block";
        two.style.display = "block";
        three.style.display = "block";
        four.style.display = "block";
        five.style.display = "block";
        six.style.display = "block";
        seven.style.display = "block";
    }
    zero.onclick = function(){
        editBtn.style.display = "inline";
        zero.style.display = "none";
        one.style.display = "none";
        two.style.display = "none";
        three.style.display = "none";
        four.style.display = "none";
        five.style.display = "none";
        six.style.display = "none";
        seven.style.display = "none";
    }
</script>
