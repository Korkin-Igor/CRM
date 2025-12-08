# Мини CRM

## Инструкция по запуску

```bash
git clone https://github.com/Korkin-Igor/CRM.git
cd CRM/deploy
cp ../project/.env.example ../project/.env
ln -s ../project/.env .env
docker compose up -d --build
docker compose exec app php artisan key:generate
docker compose exec app php artisan migrate --seed
```