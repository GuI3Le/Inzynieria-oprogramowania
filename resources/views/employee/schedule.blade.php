<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Harmonogram zajęć</title>
    @vite('resources/css/app.css')
</head>
<body>
<div class="flex h-screen justify-between items-center flex-col">
    <div class="w-full h-1/12 flex items-center justify-between bg-gray-100 border-b-black">
        <div class="flex w-1/4 justify-start flex-row items-center">
            <img src="{{asset('images/dumbbell.png')}}" alt="logo" class="inline-block object-contain h-32">
            <a href="{{route('home')}}" class="inline-block text-4xl font-bold text-blue-800">ProFit</a>
        </div>
        <div>
            <h1 class="inline-block text-5xl font-bold text-blue-800">Harmonogram zajęć</h1>
        </div>
        <div class="flex w-1/4 h-auto justify-around items-center flex-row">
            <a href="{{route('home')}}">Strona główna</a>
            <a href="">Konto {{strstr($employee->email,'@',true)}}</a>
            <form action="{{ route('employee.logout') }}" method="POST">
                @csrf
                <button type="submit" class="bg-blue-800 rounded-full w-30 text-white">Wyloguj się</button>
            </form>
        </div>
    </div>
    <div class="w-full h-9/10 p-8 overflow-auto">
        <div class="bg-white rounded-lg shadow-lg p-6">
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
                                                <div class="text-sm text-gray-600">{{ $schedule[$hour][$day]->employee->name }}</div>
                                                <div class="text-sm text-gray-600">Wolne miejsca: {{ $schedule[$hour][$day]->available_spots }}</div>
                                            </div>
                                        @endif
                                    </td>
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-6">
                <div class="grid grid-cols-3 gap-4">
                    <div class="bg-white p-4 rounded-lg shadow">
                        <h3 class="text-lg font-semibold mb-3">Dodawanie zajęć</h3>
                        <div class="space-y-3">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Nazwa zajęć</label>
                                <input type="text" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" placeholder="Wprowadź nazwę zajęć">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Dzień tygodnia</label>
                                <select class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                    <option value="">Wybierz dzień</option>
                                    @foreach($days as $day)
                                        <option value="{{ $day }}">{{ $day }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Godzina</label>
                                <select class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                    <option value="">Wybierz godzinę</option>
                                    @foreach($hours as $hour)
                                        <option value="{{ $hour }}">{{ $hour }}:00</option>
                                    @endforeach
                                </select>
                            </div>
                            <button class="w-full bg-blue-800 text-white px-4 py-2 rounded-md hover:bg-blue-950">Dodaj zajęcia</button>
                        </div>
                    </div>
                    <div class="bg-white p-4 rounded-lg shadow">
                        <h3 class="text-lg font-semibold mb-3">Usuwanie zajęć</h3>
                        <div class="space-y-3">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Nazwa zajęć</label>
                                <input type="text" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" placeholder="Wprowadź nazwę zajęć">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Dzień tygodnia</label>
                                <select class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                    <option value="">Wybierz dzień</option>
                                    @foreach($days as $day)
                                        <option value="{{ $day }}">{{ $day }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Godzina</label>
                                <select class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                    <option value="">Wybierz godzinę</option>
                                    @foreach($hours as $hour)
                                        <option value="{{ $hour }}">{{ $hour }}:00</option>
                                    @endforeach
                                </select>
                            </div>
                            <button class="w-full bg-red-600 text-white px-4 py-2 rounded-md hover:bg-red-700">Usuń zajęcia</button>
                        </div>
                    </div>
                    <div class="bg-white p-4 rounded-lg shadow">
                        <h3 class="text-lg font-semibold mb-3">Edytowanie zajęć</h3>
                        <div class="space-y-3">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Nazwa zajęć</label>
                                <input type="text" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" placeholder="Wprowadź nazwę zajęć">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Dzień tygodnia</label>
                                <select class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                    <option value="">Wybierz dzień</option>
                                    @foreach($days as $day)
                                        <option value="{{ $day }}">{{ $day }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Godzina</label>
                                <select class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                    <option value="">Wybierz godzinę</option>
                                    @foreach($hours as $hour)
                                        <option value="{{ $hour }}">{{ $hour }}:00</option>
                                    @endforeach
                                </select>
                            </div>
                            <button class="w-full bg-yellow-600 text-white px-4 py-2 rounded-md hover:bg-yellow-700">Edytuj zajęcia</button>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
