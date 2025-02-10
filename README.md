# Bybit Crypto Top 100 🚀

Этот проект на **Laravel** (10+) показывает **топ 100 криптовалют** по рыночной капитализации (или «популярности») с биржи [Bybit](https://www.bybit.com/).  
Основная цель — продемонстрировать навыки работы с **API**, сортировки данных и общий опыт в **PHP** / **Laravel**.

## 🎯 Особенности

- **Laravel 10**: Современный фреймворк на PHP.
- **Bybit API**: Получение криптовалют и их показателей (цена, объём, 24h изменения).
- **Сортировка**: По рыночной капитализации или по популярности (24h объём торгов).
- **Безопасное хранение ключей**: Использование файла `.env` (по умолчанию в `.gitignore`).
- **Blade шаблоны**: Удобный вывод таблицы с данными.
- **Структура**: Контроллер + сервисный класс (`BybitService`).

## ⚙️ Установка и запуск

1. **Склонируйте репозиторий**:
```html
   git clone https://github.com/Dm1tra/bybit-crypto-top-100.git
   cd bybit-crypto-top-100
```
2. **Установите зависимости**:
```html
composer install
```
3. **Создайте .env на основе .env.example**:
```html
cp .env.example .env
```
Заполните параметры для Bybit:
```html
BYBIT_API_KEY="ВАШ_API_KEY"
BYBIT_API_SECRET="ВАШ_API_SECRET"
BYBIT_API_BASE_URL="https://api.bybit.com"
```
Если нужно использовать тестовую сеть, замените BYBIT_API_BASE_URL на https://api-testnet.bybit.com и получите testnet-ключи.
4. **Сгенерируйте APP_KEY**:
```html
php artisan key:generate
```
5. **Запустите локальный сервер**:

```html
php artisan serve
```
Приложение будет доступно по адресу http://127.0.0.1:8000.

💻 Использование
Главная страница ( GET / ) показывает Top 100 монет по marketCap.
Чтобы посмотреть сортировку по популярности (24h объёму), добавьте в запрос параметр sort=popularity:
```html
http://127.0.0.1:8000?sort=popularity
```
В представлении (resources/views/crypto/index.blade.php) есть ссылки для переключения режимов сортировки.

📂 Структура проекта (основные файлы)

- app/Http/Controllers/CryptoController.php:
	Отвечает за маршрут /, вызывает сервис BybitService.
- app/Services/BybitService.php:
	Вся логика запросов к Bybit API, сортировка полученных данных.
- routes/web.php:
	Определён маршрут Route::get('/', [CryptoController::class, 'index']);
- config/services.php:
	Подключение к env‑переменным (BYBIT_API_KEY, BYBIT_API_SECRET, 		BYBIT_API_BASE_URL).
- resources/views/crypto/index.blade.php:
	Таблица с криптовалютами и ссылки для сортировки.
