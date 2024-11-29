# CRUD PHP

Este proyecto es una aplicación CRUD desarrollada en PHP, utilizando un entorno Dockerizado con soporte para phpMyAdmin
para la gestión de la base de datos.

## Características

- **PHP 8.2**
- **MySQL 8.0**
- **phpMyAdmin**

---

## Requisitos Previos

Asegúrate de tener instalados los siguientes programas:

- [Docker](https://docs.docker.com/get-docker/)
- [Docker Compose](https://docs.docker.com/compose/install/) (solo si usas Linx, ya que viene instalado por defecto en
  docker desktop app de windows/mac )

---

## Configuración y Ejecución

### 1. Clonar el Repositorio

```bash
 git clone https://github.com/tomassueldo/php-crud.git
 cd php-crud
```

### 2. Iniciar los Contenedores

Ejecuta el siguiente comando en la raíz del proyecto:

```bash
 docker-compose up --build -d
```

### 3. Instalar dependencias con Composer

Después de iniciar los contenedores, debes instalar las dependencias de PHP con Composer. Para ello, accede al
contenedor de tu aplicación y ejecuta el siguiente comando:

```bash
docker exec -it my_php_app_container composer install
```

Este comando construirá y ejecutará los servicios definidos en el archivo `docker-compose.yml`.

### 4. Acceso a la Aplicación

- **Frontend (CRUD)**: [http://localhost:8080/formulario](http://localhost:8080/formulario)
- **phpMyAdmin**: [http://localhost:9002](http://localhost:9002)

----

#### Endpoints:

```diff
 - GET /formulario (vista del formulario)
 - POST /formulario (store)
 - GET /formulario/list (listado de formularios cargados)
 - PUT /formulario (update)
 - DELETE /formulario
```
---
### 5. Credenciales de phpMyAdmin

Utiliza las siguientes credenciales para iniciar sesión en phpMyAdmin:

- **Servidor**: `my_db_container`
- **Usuario**: `root`
- **Contraseña**: `root`

Los codigos de área disponibles son: 101, 102, 103, 204, 215, 216, 355, 384, 399, 400


---

## Estructura del Proyecto

```
├── app/                # Código PHP
├── public/             # Carpeta pública (archivos accesibles desde el navegador)
│   ├── css/            # Archivos CSS
│   ├── js/             # Archivos JavaScript
├── vendor/             # Dependencias instaladas por Composer
├── Dockerfile          # Definición del contenedor PHP
├── docker-compose.yml  # Configuración de Docker Compose
├── README.md           # Instrucciones del proyecto
```

---

## Funcionalidades de la Aplicación

1. **Crear Registros**: Completa el formulario y envía los datos a la base de datos.
2. **Leer Registros**: Visualiza todos los registros en una tabla dinámica.
3. **Actualizar Registros**: Edita registros existentes directamente desde la tabla.
4. **Eliminar Registros**: Elimina registros.

---

```

