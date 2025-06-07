<!doctype html>
<html lang="doc">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Logowanie pracownika</title>
    @vite('resources/css/app.css')
</head>
<body class="">
<div class="flex h-screen justify-between items-center">
    <div class="flex items-center justify-center w-4/10 h-full ml-10 box-border">
        <div class="flex flex-col justify-around h-full items-center w-full">
            <a href="{{route('home')}}"><h1 class="text-8xl font-bold text-blue-800">ProFit</h1></a>
            <img src="{{asset('images/dumbbell.png')}}" alt="logo" class="w-full h-auto object-cover rotate-15">
        </div>
    </div>
    <div class="flex items-center flex-col justify-center w-3/10 h-full mr-40 box-border">
        <h2 class="box-border  text-4xl h-1/5 text-center">Zaloguj się do swojego konta pracowniczego</h2>
        <form action="{{route('employee.submitLogin')}}" method="post" class="flex flex-col justify-around items-center w-full h-2/8">
            @csrf
            <label for="email" class="w-full text-left text-l">Adres email</label>
            <input type="email" name="email" id="" placeholder="email"
                   class="block border-2 border-solid border-blue-800 rounded-full w-full text-3xl box-border pl-4">
            <label for="password" class="w-full text-left text-l">Hasło</label>
            <input type="password" name="password" id="" placeholder="hasło" class="block border-2 border-solid border-blue-800 rounded-full w-full text-3xl box-border pl-4">
{{--            <input type="submit" value="Zaloguj" class="text-al">--}}
            <button type="submit" class="bg-blue-800 rounded-full w-1/5 h-1/5 text-white">Zaloguj</button>
        </form>
    </div>
</div>
</body>
</html>
