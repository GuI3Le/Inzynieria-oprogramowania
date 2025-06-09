<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Moje karnety</title>
    @vite('resources/css/app.css')
</head>
<body>
<div class="flex h-dvh justify-between items-center">
    <div class="flex min-h-screen items-center justify-center w-4/10 ml-10 box-border">
        <div class="flex flex-col justify-around h-full items-center w-full">
            <a href="{{ route('home') }}"><h1 class="text-8xl font-bold text-blue-800">ProFit</h1></a>
            <img src="{{ asset('images/dumbbell.png') }}" alt="logo" class="w-full h-auto object-cover rotate-15">
        </div>
    </div>
    <div class="flex items-center flex-col justify-evenly h-full w-3/10 mr-40 box-border">
        <h2 class="box-border text-4xl text-center">Moje karnety</h2>
        <div class="bg-gray-100 border border-gray-400 text-gray-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">Brak aktywnych karnetów</span>
        </div>
        <div class="flex justify-end w-full mt-4">
            <a href="{{ route('customer.dashboard') }}" class="bg-blue-800 rounded-full w-32 h-14 text-white flex items-center justify-center cursor-pointer hover:bg-blue-900 transition">Powrót</a>
        </div>
    </div>
</div>
</body>
</html>