Для запуска программы выпоните следушие каманда
~~~
docker-compose up -d
~~~
~~~
docker-compose exec php-fpm ./yii migrate/up
~~~
~~~
docker-compose exec php-fpm ./yii currency-filler/index
~~~

После можете перейти на http://localhost:8888/
