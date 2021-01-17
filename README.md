1. git pull
2. cd ./avito_test
3. composer install
4. cd ./laradock
5. docker-compose up -d nginx mariadb phpmyadmin workspace
6. cd ..
7. В .env файле поменять значение DB_HOST на 127.0.0.1 (DB_HOST=127.0.0.1)
8. php artisan migrate:refresh
9. В .env файле поменять значение DB_HOST на mariadb (DB_HOST=mariadb)

## Добавить номер отеля.
`POST: localhost/api/rooms/create_room`

Принимает на вход текстовое описание и цену за ночь. 
Возвращает `id` комнаты.

Пример ответа:
`{
    "success": true,
    "data": {
        "room_id": 19
    },
    "message": "Room successfully created"
}`

## Удалить номер отеля и все его брони
`POST: localhost/api/rooms/delete_room`

Принимает на вход `id` комнаты.
Возвращает `204` код.

Удаление соответствующих броней происходит с помощью `on delete cascade`.

В случае если комнаты с указанным id не существует, возвращается ошибка:
`{
    "success": false,
    "message": "Not Found",
    "data": "Room with id 23231 not found"
}
`

## Получить список номеров отеля.
`GET: localhost/api/rooms/get_rooms`

Принимает на вход текстовое описание и цену за ночь.
Возвращает `id` комнаты.

Сортировка происходит на основе параметров запроса `sort_order` и `sort_field`

Пример запроса:
`curl -X GET localhost/api/rooms/get_rooms?sort_order=desc&sort_field=created_at`

## Получить список номеров отеля.
`GET: localhost/api/rooms/get_rooms`

Принимает на вход текстовое описание и цену за ночь.
Возвращает `id` комнаты.


## Добавить бронь. 
`POST: localhost/api/bookings/create_booking`

Принимает на вход существующий `ID` номера отеля, дату начала, дату окончания брони. 

Возвращает `ID` брони.

Пример ответа:
`{
    "success": true,
    "data": {
        "booking_id": 7
    },
    "message": "Booking created successfully"
}`

## Удалить бронь.
`POST: localhost/api/bookings/delete_booking/{ID}`

Принимает на вход `ID` брони

Пример запроса: `curl -X DELETE "localhost/api/bookings/delete_booking/24"`

В случае если брони с указанным id не существует, возвращается ошибка:
`{
    "success": false,
    "message": "Not Found",
    "data": "Booking with id 23231 not found"
}
`

## Получить список броней номера отеля.
`GET: localhost/api/bookings/get_bookings/{ID}`

Принимает на вход `ID` номера отеля

Пример запроса: `curl -X GET "localhost/api/bookings/get_bookings/24"`

Пример ответа:
`{
    "success": true,
    "data": [
        {
            "booking_id": 9,
            "room_id": 4,
            "date_start": "2019-05-01",
            "date_end": "2020-03-05"
        },
        {
            "booking_id": 10,
            "room_id": 4,
            "date_start": "2019-05-01",
            "date_end": "2020-03-03"
        }
    ],
    "message": "Booking loaded successfully"
}`
