# Music-Life
Proyecto de DAW2, Entorno servidor. Una red social que conecta con la API de Spotify y permite conectar con otras personas a través de creación de playlists y críticas de álbums.
https://wireframepro.mockflow.com/view/MCiXAAvrNpb

## Notas - Apuntes - Observaciones:
1. Propuesta para cambiar de nombre el archivo img por media.  
>(Maki: Genial, aunque habría que cambiar todas las rutas entonces)

2. Cuando conozcamos como comprobar los usuarios de la web vamos a necesitar otra página para la recuperacion de cuenta/contraseña  
>(Maki: O podría ser el mismo mecanismo que el cambio entre crear cuenta/registrarse ?)
>(Miguel: Sí, queda como pendiente.)

3. Deudas tecnológicas: Casi resueltas. 


## Cosas a arreglar:
1. Base de datos problabemente (Qué datos de la API guardamos y cuáles no? y Mejorar Querys)  
1. Responsive  
1. Puntero animación  
>(Maki: Creo que he encontrado la respuesta, pero aún no he logrado que funcione)


4. Vídeo que pese menos  
5. Crear un project  
>(Miguel: Yo no puedo hacerlo en esta rama. Creo que el mejor es Team backlog o el que controla )  
### Estructura
- config/
  - init.php
- public/
  - index.php
  - styles.css
  - main.js
  - resto.html
- src/
  - clases.php
  - data.php
- doc/
- bin/
  - unserver.sh
- db/
  - create_db.sql
  - initial_load.sql
  - est_data.sql
  - home.sql

## USUARIO - NUESTRAS IDEAS:
	Crear cuenta
	Conectar a Spotify (Primero gestionamos usuarios propios antes de conectar con Spotify)
	Análisis de gustos (API)
	Recibir recomendaciones (API)
	Comparar gustos con otro usuario (API)
	Ver artistas, y géneros mas escuchados (API)
	Opinar y puntuar sobre musica
	Tus amigos están escuchando
	Valoraciones de artistas y listas de amigos

## USUARIO - LO QUE HEMOS HABLADO CON EL PROFE
	En el perfil del usuario aparecen sus artistas favs y se pueden puntuar y comentar en el foro
	Primero solo se pueden valorar listas, mas adelante se añaden artistas álbumes etc
	Comentarios en listas
	Reproducir la playlist desde nuestra web
	Listas con tags (categorías) para el foro
	Análisis de listas (grafica con porcentajes sobre géneros etc)
	Noticias que vayan apareciendo en pantalla sobre otros usuarios
