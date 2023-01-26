<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

Настроить порты и доступы в бд
````
COMPOSE_NGINX_PORT=
COMPOSE_REDIS_PORT=
COMPOSE_MYSQL_PORT=

DB_DATABASE=
DB_USERNAME=
DB_PASSWORD=
````

## Nginx config
````
server {

    listen      80;

    server_name raffle-prizes.test;

    location / {
    	proxy_pass http://0.0.0.0:801/;

    	proxy_set_header X-Real-IP $remote_addr;
    	proxy_set_header X-Forwarded-for $remote_addr;
    	proxy_set_header Host $host;
    	proxy_connect_timeout 300;
    	proxy_send_timeout 300;
    	proxy_read_timeout 300;
    	proxy_redirect off;
    	proxy_set_header Connection close;
    	proxy_pass_header Content-Type;
    	proxy_pass_header Content-Disposition;
    	proxy_pass_header Content-Length;
    }
    
    location ~ /\.ht    {return 404;}
    location ~ /\.svn/  {return 404;}
    location ~ /\.git/  {return 404;}
    location ~ /\.hg/   {return 404;}
    location ~ /\.bzr/  {return 404;}
}
````

## Команды
Поднять контейнеры
````
docker-compose up -d
````

Командная строка php контейнера
````
docker exec -it raffle-prizes-test_php_1 bash
````

Установить зависимости
````
composer install
````

Применить миграции
````
php artisan migrate
````

Сгенерировать тестовые данные
````
php artisan db:seed
````

Сгенерировать токен
````
php artisan token:generate
````

## Авторизация в приложении
````
login: test@email.com
password: 123456
````

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
