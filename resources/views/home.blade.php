<!doctype html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ProFit Strona główna</title>
    @vite('resources/css/app.css')
</head>
<body>
<div class="flex h-screen justify-start items-center flex-col">
    <div class="w-full h-2/10 flex items-center">
        <div class="flex w-full h-auto justify-around items-center flex-col">
            <h1 class="text-6xl font-bold text-blue-800 text-center w-full">ProFit</h1>
            <h2 class="text-3xl font-bold text-black text-center w-full">Witaj na stronie głównej</h2>
        </div>
    </div>
    <div class="w-full h-7/10 grid grid-cols-2 grid-rows-2 place-items-center text-center px-40">
        <a href="{{route('customer.showRegistrationForm')}}" class="inline-block bg-blue-800 py-18 text-white text-center rounded-3xl hover:bg-blue-950 h-4/5 aspect-square transition text-4xl">Rejestracja klienta</a>
        <a href="{{route('customer.showLoginForm')}}" class="inline-block bg-blue-800 py-18 text-white text-center rounded-3xl hover:bg-blue-950 h-4/5 aspect-square transition text-4xl">Logowanie klienta</a>
        <a href="{{route('employee.showRegistrationForm')}}" class="inline-block bg-blue-800 py-18 text-white text-center rounded-3xl hover:bg-blue-950 h-4/5 aspect-square transition text-4xl">Dodawanie pracownika</a>
        <a href="{{route('employee.showLoginForm')}}" class="inline-block bg-blue-800 py-18 text-white text-center rounded-3xl hover:bg-blue-950 h-4/5 aspect-square transition text-4xl">Logowanie pracownika</a>
    </div>
</div>
</body>
</html>
