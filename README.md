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

## Funcionalidades de la Aplicación

1. **Crear Registros**: Completa el formulario y envía los datos a la base de datos.
2. **Leer Registros**: Visualiza todos los registros en una tabla dinámica.
3. **Actualizar Registros**: Edita registros existentes directamente desde la tabla.
4. **Eliminar Registros**: Elimina registros.

---

## Video de demostracion del funcionamiento del CRUD

https://github.com/user-attachments/assets/009a5da0-5e7a-42fe-89d4-bc4b86df0076




## Explicación de la solución


1. Configuración de Docker
   - Use un archivo docker-compose.yml para orquestar los servicios de PHP, MySQL, y phpMyAdmin.
   - En el Dockerfile:
      - Se configuró Composer para manejar dependencias.
      - Se habilitó el módulo rewrite de Apache para manejar rutas con .htaccess.
2. Configuración de Apache
   - Se agrego 000-default.conf para permitir rutas, redirigiendo todas las solicitudes a public/index.php.
   - El archivo .htaccess se utilizó para manejar las redirecciones necesarias.
3. Backend
   - Implementado con PHP puro y estructurado usando:
      - Controladores: Lógica de negocio manejada en FormularioController.
      - Helpers:
         - ActionHelper: Maneja la conexión con la base de datos y respuestas JSON.
         - ValidationHelper: Validación de entradas según los requisitos.
   - Endpoints: Cada operación CRUD tiene un endpoint (definido en routes.php).
4. Base de datos
   - Un script SQL inicial (init.sql) crea las tablas area y formulario, junto con valores predeterminados para los códigos de área.
5. Frontend
   - Se utilizó HTML, CSS y JavaScript puro para las interfaces.
   - Componentes principales:
      - form.html: Formulario para ingresar nuevos registros.
      - list.php: Tabla dinámica para listar, editar y eliminar registros.
   - Modales:
      - Modal para editar registros con validación de datos.
      - Modal de confirmación para eliminar registros.
   - JavaScript:
      - list.js gestiona las operaciones de edición y eliminación mediante llamadas a los endpoints correspondientes.      
      - app.js gestiona todo lo relacionado al form.html que es el formulario principal.
6. Validaciones Implementadas

   1. **Nombre y Apellido:**
      - Caracteres permitidos: letras (con acentos), espacios y apóstrofes.

   2. **Documento:**
      - Máximo 10 caracteres numéricos.

   3. **Código de Área:**
      - Solo 3 dígitos.
      - Debe existir en la tabla `area`.

   4. **Teléfono:**
      - Mínimo 8 dígitos numéricos.

   5. **Email:**
      - Formato: `nombredeusuario@dominio.com`.
      - Validaciones:
         - No permite puntos al inicio o al final del nombre de usuario.
         - No permite puntos consecutivos.
         - El dominio debe contener 2-3 caracteres después del último punto.

---

```

