# กะเพราหมูกรอบ

### Start Project (First time only)

``` shell
cd <root>

cp laravel/.env.example laravel/.env
composer install -d laravel 
php laravel/artisan config:clear
php laravel/artisan key:generate
```

### Run Project

``` shell
cd <root>

docker-compose up
```

Then, you can access the site in http://localhost:8000/

### Generate Database

``` shell
cd <root>

docker exec sec2_krapaomookrob_laravel_1 php artisan migrate:refresh --seed
```

### Members

* Niti Assavaplakorn
* Peeranuth Kehasukcharoen
* Pollawat Hongwimol
* Thanawat Jierawatanakanok
* Nithipud Tunticharoenviwat
* Krit Kruaykitanon
* Nuttanai Kijviwattanakarn
* Wiwanna Phaithoonmongkon