# coreRegistration
Registro de Usuarios en una Base de Datos

Caso práctico: Deberás crear un sistema simple de registro de usuarios. Los usuarios podrán ingresar su nombre y correo electrónico a través de un formulario HTML, y estos datos se almacenarán en una base de datos MySQL utilizando PHP.
## Requisitos
1. Base de Datos (MySQL):
- [x] Crea una base de datos llamada usuarios_db.
- [x] Dentro de la base de datos, crea una tabla llamada usuarios con las siguientes columnas:
id (INT, AUTO_INCREMENT, PRIMARY KEY)
nombre (VARCHAR 100)
email (VARCHAR 100)
2. Formulario HTML:
- [x] Crea un formulario HTML con dos campos:
Nombre (input tipo texto).
Correo electrónico (input tipo email).
- [x] El formulario debe enviar los datos a un script PHP usando el método POST.
3. Script PHP (registrar.php):
- [x] Conecta a la base de datos MySQL usando PHP.
- [x] Recibe los datos del formulario (nombre y email).
- [x] Inserta los datos en la tabla usuarios.
- [x] Muestra un mensaje de éxito o error después de la inserción.
4. Funcionalidad Adicional (Opcional):
- [ ] Valida que el correo electrónico no esté ya registrado antes de insertarlo.
- [x] Muestra una lista de usuarios registrados en la misma página o en una página separada.

## Modo de entrega:
Envía un archivo comprimido con los siguientes elementos.
1. Un archivo HTML con el formulario de registro.
2. Un archivo PHP (registrar.php) que procese el formulario y guarde los datos en la base de datos.
3. Una base de datos MySQL con la tabla usuarios creada y lista para recibir datos.
Ejemplo de Funcionamiento:
1. El usuario ingresa su nombre y correo electrónico en el formulario.
2. Al enviar el formulario, los datos se envían a registrar.php.
3. El script PHP inserta los datos en la base de datos y muestra un mensaje de éxito o error.
