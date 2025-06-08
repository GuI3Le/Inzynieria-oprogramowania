# Prototyp systemu dla klubu fitness
## Uruchomienie projektu
### Wymagania:
- PHP 8.2
- Composer
- Laravel 12
- PostgreSQL
- Node.js & npm
- Tailwind CSS
### Kroki instalacji
1. Pobranie repozytorium
```bash
https://github.com/GuI3Le/Inzynieria-oprogramowania.git
cd Inzynieria-oprogramowania
```
2. Pobranie zależności PHP
```bash
composer install
```
3. Skopiowanie i konfiguracja pliku .env
```bash
cp .env.example .env
```
```dotenv
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=nazwa_bazy_danych
DB_USERNAME=uzytkownik_bazy_danych
DB_PASSWORD=haslo_uzytkownika
```
4. Utworzenie klucza
```bash
php artisan key:generate
```
5. Uruchomienie migracji
```bash
php artisan migrate
```
6. Instalacja zależności Node
```bash
npm install
```
7. Instalacja Tailwind CSS
```bash
npm install -D tailwindcss postcss autoprefixer
npx tailwindcss init -p
8. Konfiguracja tailwind.config.js
```js
module.exports = {
  content: [
    './resources/**/*.blade.php',
    './resources/**/*.js',
    './resources/**/*.vue',
  ],
  theme: {
    extend: {},
  },
  plugins: [],
}
```
9. Kompilacja zasobów frontendowych
```bash
npm run dev
```
10. Uruchomienie serwera
```bash
php artisan serve
```
