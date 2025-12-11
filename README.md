# Мини CRM

## Инструкция по запуску

```bash
git clone https://github.com/Korkin-Igor/CRM.git
cd CRM/deploy
cp ../project/.env.example ../project/.env
ln -s ../project/.env .env
docker compose up -d --build
docker compose exec app composer install
docker compose exec app php artisan key:generate
docker compose exec app npm install
docker compose exec app npm run build
docker compose exec app php artisan migrate --seed

```

## Возможно будут проблемы с docker-окружением, нужно будет перезапустить контейнеры
```bash
docker compose down
docker compose up -d

```

#### Проект доступен по адресу http://localhost

### Данные для менеджера: 
##### email: igor@mail.com
##### password: 12345678
