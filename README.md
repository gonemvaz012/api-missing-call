## Run proyect 

docker-compose build

docker-compose up

docker-compose exec app php artisan migrate 
docker-compose exec app php artisan passport:install
docker-compose exec app php artisan db:seed --class=ConfiguracionSeeder



