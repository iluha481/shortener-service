# URL Shortener API (Laravel 11)

REST API сервис для сокращения ссылок с подсчётом переходов и статистикой.

---

## Стек

- PHP 8.3
- Laravel 11
- PostgreSQL 16
- Docker / Docker Compose

---

## Функционал

### Создание короткой ссылки

POST `/api/links`

```json
{
  "url": "https://example.com/some/long/url"
}
```
Ответ:

```json
{
  "code": "WpvFcg",
  "short_url": "http://localhost/WpvFcg"
}
```

### Редирект

GET `/{code}`

Пример:

```
http://localhost/WpvFcg
```
302 redirect на оригинальный URL

увеличивает счётчик переходов


### Статистика

GET `/api/links/{code}/stats`

Ответ

```json
{
  "url": "https://example.com",
  "code": "WpvFcg",
  "clicks": 42,
  "created_at": "2026-06-10T16:52:07.000000Z"
}
```

## Установка

### Клонирование

```bash
git clone <repo-url>
cd url-shortener-api
```



### Запуск Docker

```bash
make up
```

### Установка зависимостей

```bash
make composer
```

### ENV

```bash
cp .env.example .env
```

### Настройка .env

```bash
DB_CONNECTION=pgsql
DB_HOST=postgres
DB_PORT=5432
DB_DATABASE=shortener
DB_USERNAME=postgres
DB_PASSWORD=postgres
```

### Генерация ключа

```bash
make key
```
### Миграции
```bash
make migrate
```
### Доступ
```
http://localhost
```

## База данных
```
host: postgres
port: 5432
database: shortener
```
## Логика

код 6 символов (A-Z, a-z, 0-9)

уникальность через проверку в БД

повторный URL возвращает существующий код

каждый переход увеличивает clicks

## Таблица links
```
id
url
code (unique)
clicks
created_at
updated_at
```
## Docker сервисы
```
php
nginx
postgres
```


