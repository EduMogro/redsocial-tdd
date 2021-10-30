## Sobre este proyecto

Proyecto para crear una red social usando TDD con Laravel 8.54, PHP 7.3, VueJS 3 y PHPUnit 9.5.10 y Laravel Dusk para los test.

## Instalación

- Descargar el proyecto ingresando en consola: > git clone -b main https://github.com/EduMogro/redsocial-tdd.git
- Ubicar en la carpeta del proyecto: > cd redsocial-tdd
- Copiar el archivo .env.example y renombrarlo a .env : > cp .env.example .env
- Instalar y actualizar composer: > composer update
- Generar la clave de aplicación: > php artisan key:generate
- Instalar dependencias de Node: > npm install
- Actualizar vue-loader: > npm i vue-loader
- Compilar los scripts: > npm run dev

## Correr Tests

- Iniciar MySQL
- Iniciar el servidor de Artisan en otra terminal: > php artisan serve
- Crear la carptea Unit en Tests/ : > md tests/Unit
- Ejecutar los tests: > php artisan test

- Tener instalado el navegador Chrome actualizado
- Instalar los controladores de Chrome para Dusk: > php artisan dusk:chrome-driver (solo ejecutar una vez)
- Ejecutar los tests: > php artisan dusk

## Licencia

EL framework de Laravel es un software open-source bajo licencia de [MIT license](https://opensource.org/licenses/MIT).
