# Contact API

API REST desarrollada con Laravel 13 para la gestión de contactos de usuarios. Permite registrar usuarios, iniciar y cerrar sesión mediante Laravel Sanctum y realizar operaciones CRUD sobre los contactos.

## Tecnologías utilizadas

- PHP
- Laravel 13
- MySQL
- Laravel Sanctum
- Scramble
- Composer

## Funcionalidades

- Autenticación mediante tokens con Laravel Sanctum.
- Inicio de sesión.
- Consulta del perfil del usuario autenticado.
- Cierre de sesión.
- Creación de contactos.
- Consulta de contactos.
- Actualización completa y parcial de contactos.
- Eliminación de contactos.
- Validación de datos.
- Documentación automática de la API con Scramble.
- Protección de rutas mediante autenticación.

## Requisitos

- PHP 8.3 o superior, compatible con las dependencias del proyecto.
- Composer.
- MySQL.
- Git.

## Instalación

1. Clonar el repositorio:

```bash
git clone URL_DEL_REPOSITORIO
```

2. Ingresar a la carpeta del proyecto:

```bash
cd contact-api
```

3. Instalar las dependencias:

```bash
composer install
```

4. Crear el archivo de configuración:

```bash
cp .env.example .env
```

5. Generar la clave de la aplicación:

```bash
php artisan key:generate
```

6. Configurar la conexión a MySQL en el archivo `.env`, utilizando la base de datos `contact_api`.

7. Ejecutar las migraciones:

```bash
php artisan migrate
```

8. Iniciar el servidor:

```bash
php artisan serve
```

## Endpoints principales

Base URL: `http://127.0.0.1:8000/api/v1`

### Salud de la API

| Método | Endpoint | Descripción |
|---|---|---|
| GET | `/health` | Verificar el funcionamiento de la API |

### Autenticación

| Método | Endpoint | Descripción | Acceso |
|---|---|---|---|
| POST | `/auth/login` | Iniciar sesión | Público |
| GET | `/auth/me` | Consultar usuario autenticado | Protegido |
| POST | `/auth/logout` | Cerrar sesión | Protegido |

### Contactos

| Método | Endpoint | Descripción |
|---|---|---|
| GET | `/contacts` | Listar contactos |
| POST | `/contacts` | Crear contacto |
| GET | `/contacts/{id}` | Consultar contacto por ID |
| PUT | `/contacts/{id}` | Actualizar contacto |
| PATCH | `/contacts/{id}` | Actualizar parcialmente |
| DELETE | `/contacts/{id}` | Eliminar contacto |

Todos los endpoints de contactos requieren autenticación.

## Autenticación

La API utiliza Laravel Sanctum para proteger las rutas privadas mediante tokens Bearer.

Para acceder a los recursos protegidos se debe enviar el encabezado:

```http
Authorization: Bearer TU_TOKEN
Accept: application/json
```

El token se obtiene al iniciar sesión mediante el endpoint `/auth/login`.

## Documentación de la API

La documentación se genera automáticamente mediante Scramble.

Con el servidor iniciado, se puede consultar en:

`http://127.0.0.1:8000/docs/api`

También está disponible el documento OpenAPI en:

`http://127.0.0.1:8000/docs/api.json`

## Pruebas

Para ejecutar las pruebas automatizadas:

```bash
php artisan test
```

## Licencia

Proyecto desarrollado con fines académicos y de aprendizaje.
