<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Panel pracownika</title>
    @vite('resources/css/app.css')
</head>
<body>
<div class="flex h-screen justify-between items-center flex-col">
    <div class="w-full h-1/12 flex items-center justify-between bg-gray-100 border-b-black">
        {{--        <div class="flex w-full h-auto justify-around items-center flex-row">--}}
        <div class="flex w-1/4 justify-start flex-row items-center">
            <img src="{{asset('images/dumbbell.png')}}" alt="logo" class="inline-block object-contain h-32">
            <a href="{{route('home')}}" class="inline-block text-4xl font-bold text-blue-800">ProFit</a>
        </div>
        <div>
            <h1 class="inline-block text-5xl font-bold text-blue-800">Panel pracownika</h1>
        </div>
        <div class="flex w-1/4 h-auto justify-around items-center flex-row">
            <a href="{{route('home')}}">Strona główna</a>
            <a href="">Konto {{strstr($employee->email,'@',true)}}</a>
            <form action="{{ route('employee.logout') }}" method="POST">
                @csrf
                <button type="submit" class="bg-blue-800 rounded-full w-30 text-white">Wyloguj się</button>
            </form>
        </div>
        {{--        </div>--}}
    </div>
    <div class="w-full h-9/10 grid grid-cols-2 grid-rows-2 place-items-center text-center px-40">
        <a href="#"
           class="inline-block bg-blue-800 py-24 text-white text-center rounded-3xl hover:bg-blue-950 h-4/5 aspect-square transition text-5xl">Zarządzanie
            karnetami</a>
        <a href="#"
           class="inline-block bg-blue-800 py-24 text-white text-center rounded-3xl hover:bg-blue-950 h-4/5 aspect-square transition text-5xl">Zarządzanie
            kontami klientów</a>
        <a href="#"
           class="inline-block bg-blue-800 py-24 text-white text-center rounded-3xl hover:bg-blue-950 h-4/5 aspect-square transition text-5xl">Zarządzanie
            zajęciami</a>
        <a href="#"
           class="inline-block bg-blue-800 py-24 text-white text-center rounded-3xl hover:bg-blue-950 h-4/5 aspect-square transition text-5xl">Statystyki
            i raporty</a>

    </div>
</div>


</body>
</html>
