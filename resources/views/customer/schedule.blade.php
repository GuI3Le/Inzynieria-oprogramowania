<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Harmonogram zajęć</title>
    @vite('resources/css/app.css')
</head>
<body>
<div class="flex h-screen justify-between items-center flex-col">
    <div class="w-full h-1/12 flex items-center justify-between bg-gray-100 border-b-black">
        <div class="flex w-1/4 justify-start flex-row items-center">
            <img src="{{ asset('images/dumbbell.png') }}" alt="logo" class="inline-block object-contain h-32">
            <a href="{{ route('home') }}" class="inline-block text-4xl font-bold text-blue-800">ProFit</a>
        </div>
        <div>
            <h1 class="inline-block text-5xl font-bold text-blue-800">Harmonogram zajęć</h1>
        </div>
        <div class="flex w-1/4 h-auto justify-around items-center flex-row">
            <a href="{{ route('home') }}">Strona główna</a>
            <a href="">Konto {{ $customer ? strstr($customer->email, '@', true) : 'Gość' }}</a>
            @if($customer)
                <form action="{{ route('customer.logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="bg-blue-800 rounded-full w-30 text-white">Wyloguj się</button>
                </form>
            @endif
        </div>
    </div>
    <div class="w-full h-9/10 p-8 overflow-auto">
        <div class="bg-white rounded-lg shadow-lg p-6">
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

            <div class="overflow-x-auto">
                <table class="min-w-full table-auto border-collapse">
                    <thead>
                        <tr>
                            <th class="border border-gray-300 bg-gray-100 px-4 py-2">Godzina</th>
                            @foreach($days as $day)
                                <th class="border border-gray-300 bg-gray-100 px-4 py-2">{{ $day }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($hours as $hour)
                            <tr>
                                <td class="border border-gray-300 bg-gray-50 px-4 py-2 font-semibold">{{ $hour }}:00</td>
                                @foreach($days as $day)
                                    <td class="border border-gray-300 px-4 py-2 min-h-[100px]">
                                        @if($schedule[$hour][$day])
                                            <div class="bg-blue-100 p-2 rounded">
                                                <div class="font-semibold text-black">{{ $schedule[$hour][$day]->name }}</div>
                                                <div class="text-sm text-gray-600">{{ $schedule[$hour][$day]->employee->first_name }} {{ $schedule[$hour][$day]->employee->last_name }}</div>
                                                <div class="text-sm text-gray-600">Wolne miejsca: {{ $schedule[$hour][$day]->available_spots }}</div>
                                                @if($customer)
                                                    @php
                                                        $isRegistered = \App\Models\ClassRegistration::where('customer_id', $customer->id)
                                                            ->where('fitness_class_id', $schedule[$hour][$day]->id)
                                                            ->where('status', 'confirmed')
                                                            ->exists();
                                                    @endphp
                                                    @if($isRegistered)
                                                        <form action="{{ route('customer.class.unregister', $schedule[$hour][$day]->id) }}" method="POST" class="mt-2">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="bg-red-600 text-white rounded-full px-4 py-1 hover:bg-red-700 transition">Wypisz się</button>
                                                        </form>
                                                    @else
                                                        <form action="{{ route('customer.class.register', $schedule[$hour][$day]->id) }}" method="POST" class="mt-2">
                                                            @csrf
                                                            <button type="submit" class="bg-blue-800 text-white rounded-full px-4 py-1 hover:bg-blue-900 transition {{ $schedule[$hour][$day]->available_spots == 0 ? 'opacity-50 cursor-not-allowed' : '' }}" {{ $schedule[$hour][$day]->available_spots == 0 ? 'disabled' : '' }}>
                                                                Zapisz się
                                                            </button>
                                                        </form>
                                                    @endif
                                                @else
                                                    <p class="text-sm text-red-600 mt-2">Zaloguj się, aby się zapisać</p>
                                                @endif
                                            </div>
                                        @endif
                                    </td>
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</body>
</html>