# Sistema de Información Geográfica para Veterinaria

## Descripción
Este proyecto es un Sistema de Información Geográfica (SIG) diseñado específicamente para veterinarias. Su principal función es gestionar reservas y consolidar información de usuarios y clientes, incluyendo los datos de sus mascotas.

## Características Principales
- **Registro de Usuarios y Clientes:** Permite el registro y almacenamiento de información detallada de los usuarios y clientes del sistema.
- **Gestión de Mascotas:** Los clientes pueden registrar a sus mascotas en el sistema.
- **Reserva de Horarios:** Los clientes pueden reservar horas para atención veterinaria.
- **Gestión de Horarios por Administradores:** Los administradores pueden ingresar y editar los horarios del personal.

## Estructura del Proyecto
El proyecto se compone de los siguientes módulos y archivos:

1. **Menús:**
   - `m_c.php`: Menú para clientes.
   - `m_p.php`: Menú para usuarios administrativos.

2. **Registro y Gestión:**
   - `r_f.php`: Registro de mascotas.
   - `r_h.php`: Reserva de horas para clientes.
   - `r_p.php`: Registro de usuarios administrativos.
   - `ing_h.php`: Ingreso de horarios por parte del administrador.
   - `edit_h.php`: Edición de horarios por parte del administrador.

3. **Base de Datos:**
   - `db.sql`: Archivo SQL para la creación de la base de datos.
   - `dbconnect.php`: Archivo PHP para la conexión a la base de datos local con XAMPP.

4. **Otros Archivos:**
   - `index.php`: Archivo principal de entrada al sistema.

## Configuración y Despliegue
Para configurar y desplegar el sistema, se deben seguir los siguientes pasos:
1. Configurar un servidor local usando XAMPP.
2. Importar el archivo `db.sql` en la base de datos para crear la estructura necesaria.
3. Modificar el archivo `dbconnect.php` con los datos de conexión a la base de datos.
4. Colocar todos los archivos PHP en el directorio `htdocs` de XAMPP.
5. Acceder al sistema a través de `index.php` desde un navegador web.

## Requisitos
- Servidor local XAMPP o similar.
- Navegador web.

