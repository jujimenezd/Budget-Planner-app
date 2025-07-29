# Proyecto BudgetPlanner

Proyecto final para la asignatura Programación con tecnologías web.

## Integrantes

- JOHN SEBASTIAN FLOREZ OCHOA - C.C 1067592528
- DAVID PARRA CASTAÑO - C.C 1002592617
- JUAN ESTEBAN JIMÉNEZ DAZA - C.C 1053866885

## Estructura del Proyecto

- `/backend` - Backend hecho en Laravel donde se maneja todo el
  sistema de Modelos, Base de datos, Controladores, Rutas, Vistas,
  Migraciones, Seeders, Autenticación, Autorización, Tokenización, Validación de datos,
  y un microfrontend usando Blade. Adicionalmente, se crea y configura una API REST para consumo en el frontend.

- `/frontend` - Frontend básico hecho en React el cual muestra una API REST para la tabla de transacciones con todos sus métodos CRUD. Adicionalmente, se maneja un sistema de registro e inicio de usuarios usando JWT, validaciones para el formulario de registro y login, y un sistema de autenticación para proteger las rutas de la aplicación.

## Requisitos Previos

### Backend

- PHP >= 8.0
- Composer
- MySQL
- Laravel 8.x

### Frontend

- Node.js >= 14.x
- NPM >= 6.x

## Configuración del Backend

1. Ingresar a la carpeta del backend:

   ```
   cd backend
   ```

2. Instalar las dependencias:

   ```
   composer install
   ```

3. Configurar el archivo .env:

   ```
   cp .env.example .env
   ```

4. Configurar la base de datos en el archivo `.env`:

   ```
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=nombre_base_de_datos
   DB_USERNAME=usuario
   DB_PASSWORD=contraseña
   ```

5. Generar la clave de la aplicación:

   ```
   php artisan key:generate
   ```

6. Generar la clave secreta JWT (esto se guarda automáticamente en el archivo .env):

   ```
   php artisan jwt:secret
   ```

7. Ejecutar las migraciones y seeders:

   ```
   php artisan migrate --seed
   ```

## Ejecutar servidor del backend

Para iniciar el servidor de desarrollo:

```
php artisan serve
```

El servidor se ejecutará en `http://localhost:8000` por defecto.

## Configuración del Frontend

1. Ingresar a la carpeta del frontend:

   ```
   cd frontend
   ```

2. Instalar las dependencias:

   ```
   npm install
   ```

## Ejecutar servidor del frontend

Para iniciar el servidor de desarrollo:

```
cd frontend
npm run dev
yarn dev
```

La aplicación estará disponible en `http://localhost:5173` por defecto.

## Ejecutar el proyecto completo

Para ejecutar el proyecto completo, se debe estar ejecutando ambos servidores:

1. Terminal 1 (Backend):

   ```
   cd backend
   php artisan serve
   ```

2. Terminal 2 (Frontend):
   ```
   cd frontend
   npm run dev
   yarn dev
   ```

## Usuarios Predeterminados

Si se han ejecutado los seeders, el sistema cuenta con los siguientes usuarios predeterminados:

- **Administrador**

  - Email: juan0@gmail.com
  - Contraseña: 12345

- **Usuario Regular**
  - Email: juan1@gmail.com
  - Contraseña: 12345

## Funcionalidades Principales

- Gestión de transacciones financieras
- Categorización de gastos e ingresos
- Presupuestos y metas financieras
- Generación de reportes
- Notificaciones

## Endpoints de la API

Se recomienda usar Postman para probar los endpoints de la API.

- `/api/auth` - Autenticación de usuarios

  - `POST /register` - Registro de usuario
  - `POST /login` - Inicio de sesión

Para obtener el token de autenticación, se debe hacer un POST a `/api/auth/login` con el email y contraseña del usuario y poder consultar los endpoints mostrados a continuación.

- `/api/transactions` - Transacciones de un usuario, con categorías y presupuestos asociados (CRUD)
- `/api/categories` - Categorías de un usuario (CRUD)
- `/api/budgets` - Presupuestos de un usuario (CRUD)
- `/api/goals` - Metas financieras de un usuario (CRUD)
- `/api/users` - Usuarios de la aplicación (CRUD)
