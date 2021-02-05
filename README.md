# laravel-mailchimp
Integration with mailchimp

# Процесс развертывания приложения в 3 простых этапа

## 1. Скачиаем

Делаем pull, устанавливаем репозиторий в папку на компьютере.
Убеждаемся, что у нас есть composer, пишем `composer require`, находясь в папке с проектом.
Проставляем корневом файле `.env` доступы для базы данных.

## 2. Инциализируем

Запускаем в корневом каталоге `php artisan`, убеждаемся, что система видит команду
Выполняем:
  `php artisan migrate`
  `php artisan db:seed`
  `npm install`
  `npm run dev`
Все готово для запуска!

## 3. Запускем

В файле config/app.php устанавливаем корректный `timezone`.
Запускаем сервер: `php artisan serve`.
Все готово!

### Вам доступно 2 дополнительные команды в терминале artisan:
  1. `php artsian mailchimp:send`
  
  Добавляет в указанный список mailchimp данные пользователей из базы данных.
  
  2. `php artisan mailchimp:update`
  
  Синхронизируется с mailchimp и обновляет в локальной базе информацию о наличии подписки.
  Запускается каждые 30 минут во время работы сервера.
