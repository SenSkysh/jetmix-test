## Установка

Создать .env файл

Установить зависимости
```composer install```
Создать базу
```php artisan migrate```

## Тесты
```php artisan test```
После тестов база очищается

## Наполнение данными
```php artisan db:seed```

## Запуск
```php artisan serve```

## Документация
[http://127.0.0.1:8000/api/documentation](http://127.0.0.1:8000/api/documentation)

### Доступы для получения токена
email: manager@example.com  
password: manager  
device_name: любое  

email: client@example.com  
password: client  
device_name: любое  
