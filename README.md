# taag-test
 
Prueba técnica para Taag Genetics

## Pre requisitos
-Composer

## Instalación

-Clonar el repo.
-Instalar dependencias:
```
composer install
```

-Generar .env y key ejecutando en bash:
```
cp .env.example .env
php artisan key:generate
```

## Conexión con DB
### Metodo Automatico
-Crear nueva DB:
```
php artisan db:create
```
### Metodo manual
-crear DB en MySQL y cambiar nombre en .env 


## Correr migraciones y seeders:

Opción 1:
```
php artisan migrate --seed
```
Opción 2:
```
php artisan migrate
php artisan db:seed
```
## Convenciones
### De Enfoque
- Se prioriza la funcionabilidad (backend) sobre el diseño y escalabilidad del UX/UI (frontend).

### De Diseño
- El sistema puede tener multiples ejemplares de cada libro, cada uno en una ubicacion en un estante(modelo BookOnShelf).
- Si se elimina un libro se eliminarán tambien sus ejemplares (siempre y cuando no esten ejemplares en calidad de prestamo).
- Un Administrador tambien puede hacer la funcion de prestatario (pedir y devolver libros en su nombre).

### De Escenario(Seeds)
- Se crea para la prueba 10 estantes con identificativos de la 'A' a la 'J'.
- Se crea un usuario administrador (admin@admin.com) y 5 usuarios prestatarios (user1@prueba.com hasta user5@prueba.com) todos con misma password (1233clave).
- Se generan 30 autores, 50 libros y 100 ejemplares aleatorios.


# TODOS

- [x] Direccionar a home desde landing si usuario está autenticado.
- [ ] No pasar id en las rutas.
- [ ] CRUD de usuarios desde administracion(con soft deletes), validaciones que impidan cambiarse a si mismo, enviar mail con contrasña al usuario al momento del registro (con password autogenerada por el sistema). 
- [ ] Cambio de contraseña.
- [ ] Recuperación de contraseña (usuario olvidó su contraseña), solo para Admins.
- [ ] Confirmación de ejecucion de acciones por parte del usuario (tal vez un modal preguntando "¿está seguro de que desea xxxx?").
- [ ] Tiempo maximo de entrega (X cantidad de dias posterior a su prestamo, en caso de no devolver el ejemplar se limita el prestamo de ejemplares nuevos).
- [ ] CRUD de categorías (excepto delete, por mantener integridad referencial).
- [ ] CRUD de autores.
- [ ] CRUD de estantes (si se elimina una estantería preguntar a que estante se mueven todos los ejemplares).
- [x] Eliminar Ejemplar.
- [x] No permitir eliminar ejemplar que está en calidad de prestamo.
- [ ] Que un administrador pueda devolver un libro prestado en nombre de un prestatario
- [ ] Agregar softDeletes en modelos para que quede registro historico de prestamos de ejemplares/libros eliminados.
- [ ] Generar etiquetas que identifique fisicamente cada ejemplar.
