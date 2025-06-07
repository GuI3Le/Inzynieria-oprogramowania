<!doctype html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dodawanie pracownika</title>
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
        <h2 class="box-border text-4xl text-center">Dodawanie konta pracowniczego</h2>
        <form action="{{route('employee.showRegistrationForm')}}" method="post" class="flex flex-col justify-between items-center w-9/10 h-5/8 text-left">
            @csrf
            <label for="first_name" class="w-full text-left ml-5">Imię</label>
            <input type="text" name="first_name" id="" required placeholder="imie" class="block border-2 border-solid border-blue-800 rounded-full w-full text-3xl box-border pl-4">
            <label for="last_name" class="w-full text-left ml-5">Nazwisko</label>
            <input type="text" name="last_name" id="" required placeholder="nazwisko" class="block border-2 border-solid border-blue-800 rounded-full w-full text-3xl box-border pl-4">
            <label for="email" class="w-full text-left ml-5">Adres email</label>
            <input type="email" name="email" id="" required placeholder="email" class="block border-2 border-solid border-blue-800 rounded-full w-full text-3xl box-border pl-4">
            <label for="phone" class="w-full text-left ml-5">Numer telefonu</label>
            <input type="tel" name="phone" id="" required placeholder="numer telefonu" class="block border-2 border-solid border-blue-800 rounded-full w-full text-3xl box-border pl-4">
            <label for="role" class="w-full text-left ml-5">Rola
            </label>
                <select name="role_id" id="" required class="block border-2 border-solid border-blue-800 rounded-full w-full text-3xl box-border pl-4">
                    @foreach($roles as $role)
                        <option value="{{$role->id}}">{{$role->role_name}}</option>
                    @endforeach
                </select>
            <label for="password" class="w-full text-left ml-5">Hasło</label>
            <input type="password" name="password" id="" placeholder="hasło" required class="block border-2 border-solid border-blue-800 rounded-full w-full text-3xl box-border pl-4">
            <label for="password2" class="w-full text-left ml-5">Potwierdź hasło</label>
            <input type="password" name="password2" id="" placeholder="hasło" required class="block border-2 border-solid border-blue-800 rounded-full w-full text-3xl box-border pl-4">
            <button type="submit" class="bg-blue-800 rounded-full w-32 h-14 text-white cursor-pointer">Dodaj pracownika</button>
        </form>
    </div>
</div>
</body>
</html>
