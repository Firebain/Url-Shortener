# Тестовое задание UrlShortener

## Инструкция для запуска

1. Клонируем репозиторий
2. Создаем базу данных
3. Создаем файл .env и копируем в него .env.example
4. В .env меняем следующие параметры
   - Настройки базы данных
   - Настройки SMTP
   - (Опционально) Меняем QUEUE_CONNECTION и настраиваем выбранный драйвер
5. Последовательно прописываем в папке проекта
   ```
   composer install
   php artisan key:generate
   php artisan migrate --seed
   ```
6. Запускаем Web Server

## Данные для входа

Логин: admin@admin.com

Пароль: password
