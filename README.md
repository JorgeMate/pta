# Prueba Técnica PHP/Symfony

### Tecnología usada en el desarrollo

+ Symfony 6
+ _"Dockerizacion"_&emsp;Solo de la BBDD, no del _webserver_ ni de PHP
+ _Webserver_&emsp;Symfony local webserver
+ PHP 8.1.8
+ MySQL 5.7
+ EasyAdmin 4.0
+ GitHub (Repositorio público) para su distribución
+ _Visual Studio Code_ para desarrollo


### Instrucciones generales

+ > git clone pta "https://github.com/JorgeMate/pta.git"
+ > cd pta
+ > composer update
+ > docker-compose up -d
+ > symfony serve -d

### Carga de la BBDD y _fixture_ con el usuario de prueba

+ > symfony console doctrine:migration:migrate
+ > symfony console doctrine:fixtures:load

#### Usuario de prueba: **admin@example.com**
#### Contraseña: **pass**
---
## Notas generales
### HTML, JQuery, Bootstrap
- Al estar la tarea propuesta tan adaptada a las prestaciones de _EasyAdmin_, solo he tenido que emplear algo de HTML para el _background_ del _home_ del panel de control.
- La página de login también utiliza una plantilla de _EasyAdmin_, (que también hace uso del Bootstrap y JS del mismo).
- No utilizo _CDNs_, ni _webpack-encore_ para acceder a CSSs ni JS)
### Bases de Datos
- Como es mi medio natural, es el capítulo al que más tiempo le he dedicado. La BBDD se llama _countries_ y contiene la tabla _pais_. Como al fin y al cabo se trata de un panel de control, he considerado oportuno establecer mecanismos para autenticar a sus usuarios mediante la creación de otra tabla, _users_.
- Las tablas se definen y transfieren a la BBDD mediante _migrations_.
- El usuario de prueba se crea mediante _fixtures_.
### Acceso al _endpoint_ de paises, seleccion de características.
- Me he tomado la libertad de seleccionar solo algunos de los atributos (claves) de la información JSON devuelta por las APIs para este desarrollo.

<br><br>
jorgematemartinez@gmail.com