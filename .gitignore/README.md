# Configuración de la Base de Datos

Para configurar la base de datos en tu entorno local, sigue estos pasos:

1. Clona este repositorio en tu máquina local.
2. Abre tu herramienta de gestión de bases de datos (por ejemplo, phpMyAdmin).
3. Crea una nueva base de datos con el nombre `hotel`.
4. En la interfaz de importación, selecciona el archivo `hotel.sql` y ejecuta la importación en la base de datos `hotel`.

**Nota:** Asegúrate de tener las credenciales de acceso correctas para tu base de datos local antes de importar.

Después de la importación, la base de datos estará configurada con los datos de muestra.

Si deseas establecer una conexión a la base de datos desde tu aplicación, utiliza las credenciales de acceso apropiadas y asegúrate de proteger adecuadamente las contraseñas y otros datos confidenciales.

# Empaquetado del proyecto

A continuación, te explico brevemente la función de cada carpeta y archivo:

assets: Aquí puedes almacenar tus archivos CSS, JavaScript, imágenes y otros recursos estáticos utilizados en tus páginas.

conections: Esta carpeta contiene archivos relacionados con la conexión a la base de datos, como conection.php.

pages: Aquí puedes tener archivos PHP individuales para cada página de tu sitio web. Por ejemplo, index.php podría ser tu página de inicio, crear_cuenta.php podría ser la página de registro, y panel_gestor.php podría ser la página de gestión.

.gitignore: En este archivo puedes listar los archivos y carpetas que deseas excluir de la versión controlada por Git.

README.md: Este archivo contiene información sobre el proyecto y las instrucciones para configurar y utilizar la aplicación.