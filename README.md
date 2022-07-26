# Prueba Técnica PHP/Symfony

### Tecnología usada en el desarrollo

+ Symfony 6
+ _"Dockerizacion"_&emsp;Solo de la BBDD, no del _webserver_ ni de PHP
+ _Webserver_&emsp;Symfony CLI
+ PHP 8.1.8
+ MySQL 5.7
+ EasyAdmin 4.0


### Instrucciones generales

+ > git clone pta "https://github.com/JorgeMate/pta.git"
+ > cd pta
+ > composer update
+ > docker-compose up -d
+ > symfony server:start -d

### Carga de la BBDD y _fixture_ con el usuario de prueba

+ > symfony console doctrine:migration:migrate
+ > symfony console doctrine:fixtures:load

#### Usuario de prueba: admin@example.com
#### Contraseña: pass