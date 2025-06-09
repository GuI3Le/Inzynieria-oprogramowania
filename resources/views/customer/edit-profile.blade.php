<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edytuj profil</title>
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
        <h2 class="box-border text-4xl text-center">Edytuj profil</h2>
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif
        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
        @endif
        <form action="{{ route('customer.profile.update') }}" method="POST" class="flex flex-col justify-between items-center w-9/10 h-5/8 text-left">
            @csrf
            @method('PUT')
            <label for="name" class="w-full text-left ml-5">Nazwa użytkownika</label>
            <input type="text" name="name" id="name" value="{{ old('name', auth('customer')->user()->name) }}" required class="block border-2 border-solid border-blue-800 rounded-full w-full text-3xl box-border pl-4 @error('name') border-red-500 @enderror">
            @error('name')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror

            <label for="first_name" class="w-full text-left ml-5">Imię</label>
            <input type="text" name="first_name" id="first_name" value="{{ old('first_name', auth('customer')->user()->first_name) }}" required class="block border-2 border-solid border-blue-800 rounded-full w-full text-3xl box-border pl-4 @error('first_name') border-red-500 @enderror">
            @error('first_name')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror

            <label for="last_name" class="w-full text-left ml-5">Nazwisko</label>
            <input type="text" name="last_name" id="last_name" value="{{ old('last_name', auth('customer')->user()->last_name) }}" required class="block border-2 border-solid border-blue-800 rounded-full w-full text-3xl box-border pl-4 @error('last_name') border-red-500 @enderror">
            @error('last_name')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror

            <label for="email" class="w-full text-left ml-5">Adres email</label>
            <input type="email" name="email" id="email" value="{{ old('email', auth('customer')->user()->email) }}" required class="block border-2 border-solid border-blue-800 rounded-full w-full text-3xl box-border pl-4 @error('email') border-red-500 @enderror">
            @error('email')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror

            <label for="phone" class="w-full text-left ml-5">Numer telefonu</label>
            <input type="number" name="phone" id="phone" value="{{ old('phone', auth('customer')->user()->phone) }}" required class="block border-2 border-solid border-blue-800 rounded-full w-full text-3xl box-border pl-4 @error('phone') border-red-500 @enderror">
            @error('phone')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror

            <label for="birth_date" class="w-full text-left ml-5">Data urodzenia</label>
            <input type="date" name="birth_date" id="birth_date" value="{{ old('birth_date', auth('customer')->user()->birth_date) }}" required class="block border-2 border-solid border-blue-800 rounded-full w-full text-3xl box-border pl-4 @error('birth_date') border-red-500 @enderror">
            @error('birth_date')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror

            <label for="password" class="w-full text-left ml-5">Nowe hasło (opcjonalne)</label>
            <input type="password" name="password" id="password" placeholder="Nowe hasło" class="block border-2 border-solid border-blue-800 rounded-full w-full text-3xl box-border pl-4 @error('password') border-red-500 @enderror">
            @error('password')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror

            <label for="password_confirmation" class="w-full text-left ml-5">Potwierdź nowe hasło</label>
            <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Powtórz hasło" class="block border-2 border-solid border-blue-800 rounded-full w-full text-3xl box-border pl-4">
            
            <div class="flex justify-between w-full mt-4">
                <button type="submit" class="bg-blue-800 rounded-full w-32 h-14 text-white cursor-pointer hover:bg-blue-900 transition">Zapisz zmiany</button>
                <a href="{{ route('customer.dashboard') }}" class="bg-blue-800 rounded-full w-32 h-14 text-white flex items-center justify-center cursor-pointer hover:bg-blue-900 transition">Powrót</a>
            </div>
        </form>
    </div>
</div>
</body>
</html>