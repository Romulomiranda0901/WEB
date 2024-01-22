# Lista de Tareas

Lista de tareas utilizando Laravel, base de datos MySQL y Vue.

Demo: https://lista-tareas.yizack.com

Video demostración

https://github.com/Yizack/prueba-intermedio-tareas/assets/16264115/2f34e23e-d797-411c-ba30-64b5e77ae773

## Índice
- [Tecnologías](#tecnologías)
- [Requerimientos para reproducción](#requerimientos-para-reproducción)
- [Pasos de instalación del proyecto](#pasos-de-instalación-del-proyecto)
- [Pasos para ejecutar el proyecto](#pasos-para-ejecutar-el-proyecto)
- [REST API](#rest-api)
- [Ejemplo](#ejemplo)
- [Información adicional (Base de datos)](#información-adicional-base-de-datos)
- [Desarrollo](#desarrollo)

## Tecnologías
- Backend:
  - Laravel (PHP Framework)
  - Composer
  - MySQL
  - Node.js
  - Vite
  - Inertia
- Frontend:
  - Vue 3
  - Bootstrap 5

## Requerimientos para reproducción
- Descargar e Instalar [GitHub CLI](https://cli.github.com/)
- Descargar e Instalar PHP y MySQL, yo he utilizado [XAMPP](https://www.apachefriends.org/es/download.html) (PHP 8.2.4) como entorno
- Dentro de la carpeta `C:\xampp\php`, habilitar la extensión zip en el archivo `php.ini` de PHP si es necesario para habilitar la instalación de los paquetes de composer. Buscar `;extension=zip` y cambiarlo por `extension=zip`
- Descargar e instalar [Composer](https://getcomposer.org/download/) (2.5.8)
- Descargar e instalar [Node.js](https://nodejs.org/en/download) (18.16.1)
- Instalar [pnpm](https://pnpm.io/) utilizando el comando `npm install pnpm@latest -g`

## Pasos de instalación del proyecto
1. Clonar el repositorio de GitHub.

```sh
gh repo clone Yizack/prueba-intermedio-tareas
```

2. Cambiar de directorio

```sh
cd prueba-intermedio-tareas
```

3. Para instalar paquetes de composer del proyecto ejecutar

```sh
composer install
```

4. Comando para instalar paquetes npm utilizando pnpm

```sh
pnpm install
```

## Pasos para ejecutar el proyecto

Para la ejecución del proyecto se necesitará realizar los siguientes pasos.

1. IMPORTANTE: Renombrar el archivo `.env.example` a `.env` para hacer uso de las variables de entorno.

2. Iniciar Apache y MySQL por ejemplo en XAMPP

![xampp](https://github.com/Yizack/prueba-intermedio-tareas/assets/16264115/23df3714-d0cb-444d-b177-065c4fcab401)

3. Abrir una consola en el directorio del proyecto y ejecutar el siguiente comando para realizar la migración de la base de datos

```sh
php artisan migrate
```

4. Ejecutar la build de Vue con Vite

```sh
pnpm build
```

5. Para iniciar el servidor, ejecutar

```sh
php artisan serve
```

6. Acceder a la dirección http://localhost:8000 en el navegador.

7. Generar "App key" y actualizar

![appkey](https://github.com/Yizack/prueba-intermedio-tareas/assets/16264115/0a015c1d-f13a-40c1-8cf8-c91e58c81c7e)

8. Pantalla inicial si todo se ha ejecutado correctamente.

![captura-start](https://github.com/Yizack/prueba-intermedio-tareas/assets/16264115/cbcb0f43-73e2-4349-abbb-b468533d0318)

## REST API

### Endpoints 

Puntos finales de la API

| Endpoint          | Método | Descripción              |
|-------------------|--------|--------------------------|
| `/api/tareas`     | GET    | Obtener todas las tareas |
| `/api/tareas`     | POST   | Crear tarea              |
| `/api/tareas/:id` | PUT    | Modificar tarea          |
| `/api/tareas/:id` | DELETE | Eliminar tarea           |
| `/api/tareas/:id` | PATCH  | Completar tarea          |

### Propiedades 

La API web devuelve todos los datos de respuesta como un objeto JSON. A continuación se muestran tablas con la descripción de todas las propiedades.

| Propiedad         | Tipo      | Descripción                       |
|-------------------|-----------|-----------------------------------|
| `id`              | integer   | Identificador de la tarea         |
| `nombre`          | string    | Nombre de la tarea                |
| `completado`      | boolean   | Completación de la tarea          |
| `created_at`      | timestamp | Fecha y tiempo de creación        |
| `updated_at`      | timestamp | Fecha y tiempo de modificación    |


## Ejemplo

Captura del funcionamiento

![captura](https://github.com/Yizack/prueba-intermedio-tareas/assets/16264115/0f8d7587-c9e7-442c-b400-81b6f908e201)

## Información adicional (Base de datos)

### Laravel

El framework de Laravel nos permite crear migraciones de nuestra estructura de base de datos fácilmente utilizando el directorio `database/migrations` con código PHP. Por ejemplo, ver el archivo [`tareas_table.php`](/database/migrations/tareas_table.php)

Igualmente también nos facilita la creación de rutas de nuestra api utilizando el directorio `routes` y el archivo [`api.php`](/routes/api.php), a estas rutas podemos asignarles funciones de un controlador para obtener las tareas y realizar las modificaciones de nuestra base de datos.

El archivo del controlador de tareas donde se encuentran las acciones está localizado en [`app/Http/Controllers/TareaController.php`](app/Http/Controllers/TareaController.php)

### Instrucciones SQL

Para motivos de demostración de conocimiento también he creado un archivo con instrucciones para crear la tabla de la base de datos y los procedimientos de almacenado en caso de que no exista una opción de migración de base de datos como la que ofrece Laravel.

El archivo con las instrucciones se puede encontrar en [`db.sql`](/db.sql)

## Desarrollo

Para realizar cambios en entorno de desarrollo

1. Ejecutar el comando de entorno de desarrollo de Vite

```sh
pnpm dev
```

2. En otra consola sin cerrar la consola anterior, ejectuar el servidor

```sh
php artisan serve
```
