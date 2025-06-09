<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Rejestracja klienta</title>
    @vite('resources/css/app.css')
</head>
<body>
<div class="flex h-dvh justify-between items-center">
    <div class="flex min-h-screen items-center justify-center w-4/10 ml-10 box-border">
        <div class="flex flex-col justify-around h-full items-center w-full">
            <a href="{{route('home')}}"><h1 class="text-8xl font-bold text-blue-800">ProFit</h1></a>
            <img src="{{asset('images/dumbbell.png')}}" alt="logo" class="w-full h-auto object-cover rotate-15">
        </div>
    </div>
    <div class="flex items-center flex-col justify-evenly h-full w-3/10 mr-40 box-border">
        <h2 class="box-border text-4xl text-center">Rejestracja konta klienta</h2>
        <form action="{{route('customer.submitRegistration')}}" method="post" class="flex flex-col justify-between items-center w-9/10 h-5/8 text-left">
            @csrf
            <label for="name" class="w-full text-left ml-5">Nazwa użytkownika</label>
            <input type="text" name="name" id="name" placeholder="Nazwa użytkownika" required class="block border-2 border-solid border-blue-800 rounded-full w-full text-3xl box-border pl-4">
            <label for="first_name" class="w-full text-left ml-5">Imię</label>
            <input type="text" name="first_name" id="first_name" placeholder="Imię" required class="block border-2 border-solid border-blue-800 rounded-full w-full text-3xl box-border pl-4">
            <label for="last_name" class="w-full text-left ml-5">Nazwisko</label>
            <input type="text" name="last_name" id="last_name" placeholder="Nazwisko" required class="block border-2 border-solid border-blue-800 rounded-full w-full text-3xl box-border pl-4">
            <label for="email" class="w-full text-left ml-5">Adres email</label>
            <input type="email" name="email" id="email" placeholder="email" required class="block border-2 border-solid border-blue-800 rounded-full w-full text-3xl box-border pl-4">
            <label for="phone" class="w-full text-left ml-5">Numer telefonu</label>
            <input type="number" name="phone" id="phone" placeholder="telefon" required class="block border-2 border-solid border-blue-800 rounded-full w-full text-3xl box-border pl-4">
            <label for="birth_date" class="w-full text-left ml-5">Data urodzenia</label>
            <input type="date" name="birth_date" id="birth_date" required class="block border-2 border-solid border-blue-800 rounded-full w-full text-3xl box-border pl-4">
            <label for="password" class="w-full text-left ml-5">Hasło</label>
            <input type="password" name="password" id="password" placeholder="hasło" required class="block border-2 border-solid border-blue-800 rounded-full w-full text-3xl box-border pl-4">
            <label for="password_confirmation" class="w-full text-left ml-5">Potwierdź hasło</label>
            <input type="password" name="password_confirmation" id="password_confirmation" placeholder="powtórz hasło" required class="block border-2 border-solid border-blue-800 rounded-full w-full text-3xl box-border pl-4">
            <button type="submit" class="bg-blue-800 rounded-full w-32 h-14 text-white cursor-pointer">Zarejestruj się</button>
        </form>
    </div>
</div>
</body>
</html>