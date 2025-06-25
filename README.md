# Pet Mate

# Requisitos para la instalación

# Paso para la instalación
1. Clonar el repositorio con el siguiente comando:
   git clone https://github.com/Erick-Damian-Casis/pet-mate.git

2. Accede al proyecto clonado de la siguiente manera:
   cd pet-mate

3. Asegúrate de tener Composer instalado, luego corre:
   composer install

4. Laravel necesita un archivo .env para funcionar:
    - Crea una copia del archivo .env.example y pegalo al mismo nivel, pero modificando su nombre a .env

5. Generar la clave de seguridad del proyecto:
   php artisan key:generate

6. Configura tu base de datos
   DB_DATABASE=homestead
   DB_USERNAME=root
   DB_PASSWORD=

7. Ejecuta las migraciones en la consola:
   - Si es la primera vez: php artisan db:seed
   - Si hay problemas ejecuta: php artisan migrate:fresh --seed

8. Levanta el servidor local:
   php artisan serve

# Pasos Para los endpoint con postman
1. Hay varios archivos ya modificados con las rutas de toda la aplicacion
    vamos a importarlos a nuestro Postman
2. En la parte superior izquierda hay un boton de importacion, ahi subimos nuestros archivos
3. Para probar las rutas primero tienes que generar el token de acceso en la seccion Auth
    - En la ruta http://localhost:8000/api/login
    - Ese token tiene que ir en todas las peticiones 
# Endpoint

# Users
1. Get http://localhost:8000/api/users
    - Devuelve un array de todos los usuarios
2. Get http://localhost:8000/api/users/{id}
    - Devuelve un objeto con la informacion del usuario y todas sus mascotas, tenemos que remplazar {id} por un numero de usuario creado, por ejemplo 1 o 2
3. Post http://localhost:8000/api/users
    - Tenemos que enviar en el Body los campos requeridos:
      {
      "name": "Juan Pérez",
      "email": "juan.perez@example.com",
      "password": "password123",
      "password_confirmation": "password123",
      "birthdate": "1998-12-12"
      }
4. Put http://localhost:8000/api/users/{id}
    - Tenemos que enviar en el Body los campos requeridos:
      {
      "name": "Juan Pérez",
      "email": "juan.perez@example.com",
      "password": "password123",
      "password_confirmation": "password123",
      "birthdate": "1998-12-12"
      }
    - La diferencia es que tenemos que remplazar el {id} de la persona que se quiera actualizar
5. Delete http://localhost:8000/api/users/{id}
    - Enviamos el {id} del usuario que solicitamos eliminar

# Pets
1. Get http://localhost:8000/api/pets
    - Devuelve un array de todas las mascotas
2. Get http://localhost:8000/api/pets/{id}
    - Devuelve un objeto con la informacion de la mascota
3. Post http://localhost:8000/api/pets
    - Tenemos que enviar en el Body los campos requeridos:
      {
      "user_id": 1,
      "name": "Firulais",
      "species": "dog",
      "race": "labrador",
      "age": 3
      }
4. Put http://localhost:8000/api/pets/{id}
    - Tenemos que enviar en el Body los campos requeridos:
      {
      "user_id": 1,
      "name": "Firu",
      "species": "dog",
      "race": "labrador",
      "age": 3
      }
    - La diferencia es que tenemos que remplazar el {id} de la mascota que se quiera actualizar
5. Delete http://localhost:8000/api/pets/{id}
    - Enviamos el {id} de la mascota que solicitamos eliminar

