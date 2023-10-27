## ToDo:

Para el 27 entregar Pagina web y sql
Las querys, el modelo entidad relación, y las distintas páginas que vamos a mostrar html + css.

Juan Miguel: Retirar shadow-box del login
Maki: Cambiar modo oscuro en el login (que pase a verde oscuro en vez del azul), y terminar wireframe hasta donde estamos.
Sergio: I love :yum: discord =)

# Music-Life
Proyecto de DAW2, Entorno servidor. Una red social que conecta con la API de Spotify y permite conectar con otras personas a través de creación de playlists y críticas de álbums.

## Notas - Apuntes - Observaciones:
-Zona para incluir cualquier comentario u observación.  
-Propuesta para cambiar de nombre el archivo img por media.  
-Cuando conozcamos como comprobar los usuarios de la web vamos a necesitar otra página para la recuperacion de cuenta/contraseña 

### Estructura
config/
        init.php
public/ 
        index.php
        styles.css
        main.js
        resto.html
src/    
        clases.php
        data.php
doc/
bin/
    runserver.sh
db/
  create_db.sql
  initial_load.sql
  test_data.sql
  home.sql


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
