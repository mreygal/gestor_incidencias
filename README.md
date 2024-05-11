# Gestor de Incidencias

Aquí está la descripción breve de mi proyecto de un Gestor de Incidencias con funcionalidad CRUD (Create, Read, Update, Delete).

## Descripción del proyecto

Este proyecto tiene como objeto la creación de un creador de tickets de incidencias que puedan verse en una página diferente. Esto es para que unos clientes puedan tener acceso a la herramienta de creación de tickets mientras que los administradores tienen acceso a la visualización de todas las incidencias.

Esta herramienta es:

- Fácil de instalar.
- Fácil de usar con una interfaz sumamente intuitiva.
- Muy ligera.

## Funcionalidades

Este gestor de incidencias tiene como principales funcionalidades:

- **Crear tickets de incidencia:** Creación rápida y sencilla con un título y una descripción.
- **Visualizar las incidencias:** Visualización de las incidencias de manera ordenada.
- **Edición/Borrado de incidencias:** Un administrador puede editar o borrar las incidencias fácilmente.
- **Instalación en cualquier plataforma:** Nada más hace falta tener un servidor web (como Apache) y otro servidor MySQL.

## Instalación

Siguiendo los siguientes pasos, se puede instalar el gestor de incidencias en modo local:

1. Ten un servidor web y otro servidor MySQL funcionando donde pongas los archivos. Esto se puede hacer fácilmente con [XAMPP](https://www.apachefriends.org/es/download.html).
2. Si has utilizado XAMPP, clona el repositorio dentro de la carpeta de XAMPP llamada "htdocs".
3. Ve a http://localhost/phpadmin con tu navegador y crea una base de datos llamada "db_gestor_incidencias".
4. Crea una tabla dentro de esa base de datos con la siguiente orden SQL:
```sql
CREATE TABLE IF NOT EXISTS incidencias (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(255) NOT NULL,
    descripcion TEXT NOT NULL,
    fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```
5. Ve a http://localhost/gestor_incidencias/meter_incidencia.html para ir a la página de creación de incidencias.
6. Ve a http://localhost/gestor_incidencias/ver_incidencias.html para ir a la página de visualización de incidencias.
7. Utiliza el gestor de incidencias tanto como quieras.


## Contacto

Si deseas ponerte en contacto conmigo, hazlo a través de un issue.

¡Muchas gracias por tu interés!
