# Шаблон сайта

## Установка

```sh
git clone https://github.com/itCpp/sites-template
cd sites-template
composer install
```
При необходимости замените наименование каталога

## Настройка

Необходимо настроить идентификационные данные сайта. Настройки находятся в `.env` файле
- `APP_NAME` - Наименование сервера
- `APP_KEY` - Секретная информация, находится у руководителя IT-отдела (**Обязательно к заполнению**)
- `APP_URL` - Полный адрес сервера
- `EVENT_HANDLING_URL` - это полный адрес сервера, по которому идет приём данных, например `http://localhost/api/`

`EXAMPLE_PAGE_ACCESS=true` - Включит тестовую страницу с формой отправки заявки, форма будет доступна по адресу **/example**

Настройте базу данных, в которой будет храниться статистика посещений сайта и прочие данные, для этого необходимо изменить значения в `.env` файле:
```php
DB_HOST=127.0.0.1
DB_DATABASE=homestead
DB_USERNAME=homestead
DB_PASSWORD=secret
```

Для создания всех таблиц необходимо выполнить команду
```sh
php artisan migrate
```

При отсутствии подключения к БД информация о заявке будет записана в файле `/storage/app/faileds.json`

## Одностраничный сайт

Для создания одностраничного сайта достаточно изменить файл `/resources/views/main.blade.php` в соотвутствующих секциях.
Секции будут встроены в главный шаблон `/resources/views/app.blade.php` который также можно редактировать на своё усмотрение.
[Подробнее о шаблонах Blade](https://laravel.su/docs/8.x/blade)

Все общедоступные файлы стилей или скриптов должны располагаться в каталоге `/public`.

## Создание страниц

Для создания страниц необходимо добавить маршрутизацию в файле `/routes/web.php`, создать файл шаблона в каталоге `/resources/views/` и заполнять его как обычный html файл
Передачу данных и вывод страниц можно выполнять при помощи отдельного контроллера, либо использовать уже имеющися `App\Http\Controllers\Pages::class` в котором нужно добавить соответсвующий метод.

## Отправка заявок

Для отправки заявок используется composer пакет `itcpp/sendrequest`
Маршрут обработки запроса по умолчанию определён по адресу **/itcpp/sendrequest**, принимает только **POST** запросы

Более подробнее о пакете [itcpp/sendrequest](https://github.com/itCpp/sendrequest).

### CSRF защита

Маршрут **/itcpp/sendrequest** защищен от межбраузерных атак, для успешного выполнения запроса необходимо отправить токен защиты, это можно сделать двумя способами:
- Отправить в теле запроса элемент `_token` с CSRF-токеном
- Добавить заголовок `X-CSRF-TOKEN` в каждый запрос

В главном шаблоне страниц произведа настройка объекта `ajax` и к каждому запросу автоматически добавлен заголовок с токеном
Подробнее о [CSRF-защите](https://laravel.su/docs/8.x/csrf)
