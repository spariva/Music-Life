				---------------------------------
				--	**** PROCEDIMIENTOS  ****  --
				---------------------------------

-- 1. Crear un usuario (depende si quitamos o no la secuencia, haría falta la línea del max(id) + 1):
CREATE OR REPLACE PROCEDURE INTRODUCIR_USUARIO(
	V_NOMBRE USUARIO.NOMBRE%TYPE, V_NICK USUARIO.NICK_NAME%TYPE,
	V_EMAIL USUARIO.EMAIL%TYPE, V_PASSWORD USUARIO.CONTRASENA%TYPE)
IS
  v_id USUARIO.ID%TYPE;
BEGIN
  SELECT MAX(ID) + 1 INTO v_id FROM USUARIO;
  
  INSERT INTO USUARIO (ID, NOMBRE, NICK_NAME, EMAIL, CONTRASENA)
  VALUES (v_id, V_NOMBRE, V_NICK, V_EMAIL, V_PASSWORD);
  
  COMMIT;
END;
/

-- 2. Actualizar el nombre de un usuario en la tabla USUARIOS:
CREATE OR REPLACE PROCEDURE CAMBIO_NOMBRE_USUARIO(
  v_usuario_id USUARIO.ID%TYPE,
  v_nuevo_nombre USUARIO.NOMBRE%TYPE)
IS
BEGIN
  UPDATE USUARIO
  SET NOMBRE = v_nuevo_nombre
  WHERE ID = v_usuario_id;
  DBMS_OUTPUT.PUT_LINE('Usuario con identificador ' || v_usuario_id || ' cambiado su nombre por ' || v_nuevo_nombre);
  COMMIT;
END;
/

-- 3. Eliminar un usuario de la tabla USUARIOS y sus playlists relacionadas:
CREATE OR REPLACE PROCEDURE ELIMINAR_USUARIO_PLAYLIST(
	v_usuario_id USUARIO.ID%TYPE)
IS
BEGIN

  DELETE FROM PLAYLIST
  WHERE CREADOR_ID = v_usuario_id;
  
  DELETE FROM USUARIO
  WHERE ID = v_usuario_id;
  
  DBMS_OUTPUT.PUT_LINE('Listas del usuario con identificador ' || v_usuario_id || ' eliminadas junto con el usuario.');
  
  COMMIT;
END;
/

-- 4. Crear una playlist en la tabla PLAYLIST:
CREATE OR REPLACE PROCEDURE INTRODUCIR_PLAYLIST(
	V_NOMBRE PLAYLIST.NOMBRE%TYPE, V_CREADOR PLAYLIST.CREADOR_ID%TYPE)
IS
  v_id PLAYLIST.ID_PL%TYPE;
BEGIN
  SELECT MAX(ID_PL) + 1 INTO v_id FROM PLAYLIST;
  
  INSERT INTO PLAYLIST (ID_PL, NOMBRE, CREADOR_ID)
  VALUES (v_id, V_NOMBRE, V_CREADOR);
  DBMS_OUTPUT.PUT_LINE('La lista: ' || V_NOMBRE || ' es creada con identificador ' || v_id);
  
  COMMIT;
END;
/

-- 5. Eliminar una playlist en la tabla PLAYLIST:
CREATE OR REPLACE PROCEDURE ELIMINAR_PLAYLIST(
	V_CREADOR PLAYLIST.CREADOR_ID%TYPE, V_PLAYLIST PLAYLIST.ID_PL%TYPE)
IS
  V_NOMBRE PLAYLIST.NOMBRE%TYPE;
BEGIN
  SELECT NOMBRE INTO V_NOMBRE FROM PLAYLIST
  WHERE V_PLAYLIST = ID_PL
  AND V_CREADOR = CREADOR_ID;
  DBMS_OUTPUT.PUT_LINE('La lista con identificador:  '|| V_PLAYLIST||' y nombre: ' || V_NOMBRE || ' seleccionada para eliminacion.');
  
  DELETE FROM PLAYLIST
  WHERE CREADOR_ID = V_CREADOR
  AND V_PLAYLIST = ID_PL;
  DBMS_OUTPUT.PUT_LINE('Lista ' || V_NOMBRE ||'  eliminada.');
  
  COMMIT;
END;
/


-- 6. Insertar un nuevo comentario en la tabla COMENTARIOS:
CREATE OR REPLACE PROCEDURE INTRODUCIR_COMENTARIO_PLAYLIST(
	V_COMENTARIO COMENTARIO.CADENA_TEXTO%TYPE, V_USUARIO COMENTARIO.USUARIO_ID%TYPE,
	V_PLAYLIST COMENTARIO.PLAYLIST_ID%TYPE)
IS
  v_comentario_id COMENTARIO.COMENTARIO_ID%TYPE;
BEGIN
  SELECT MAX(COMENTARIO_ID) + 1 INTO v_comentario_id FROM COMENTARIO;
  
  INSERT INTO COMENTARIO (COMENTARIO_ID, CADENA_TEXTO, USUARIO_ID, PLAYLIST_ID)
  VALUES (v_comentario_id, V_COMENTARIO, V_USUARIO, V_PLAYLIST); -- Usuario_ID y Playlist_ID de ejemplo
  
  COMMIT;
END;
/

-- 7. Eliminar un comentario de la tabla COMENTARIOS:
CREATE OR REPLACE PROCEDURE ELIMINAR_COMENTARIO(
	V_USUARIO COMENTARIO.USUARIO_ID%TYPE, V_PLAYLIST COMENTARIO.PLAYLIST_ID%TYPE)
IS
	V_COMENTARIO COMENTARIO.COMENTARIO_ID%TYPE;
BEGIN
  SELECT COMENTARIO_ID INTO V_COMENTARIO FROM COMENTARIO
  WHERE PLAYLIST_ID = V_PLAYLIST
  AND USUARIO_ID = V_USUARIO;
  
  DELETE FROM COMENTARIO
  WHERE USUARIO_ID = V_USUARIO
  AND PLAYLIST_ID = V_PLAYLIST;
  DBMS_OUTPUT.PUT_LINE('Comentario con identificador: ' || V_COMENTARIO ||' eliminado.');
  
  COMMIT;
END;
/

--8. Moderar/editar un comentario de la tabla COMENTARIOS:
CREATE OR REPLACE PROCEDURE MODERAR_COMENTARIO(
	V_PLAYLIST COMENTARIO.PLAYLIST_ID%TYPE, V_USUARIO COMENTARIO.USUARIO_ID%TYPE,
	V_TEXTO_NUEVO COMENTARIO.CADENA_TEXTO%TYPE)
IS
--V_CONTENIDO_MODERADO VARCHAR2(40);
BEGIN

  UPDATE COMENTARIO
  SET CADENA_TEXTO = V_TEXTO_NUEVO
  WHERE PLAYLIST_ID = V_PLAYLIST
  AND USUARIO_ID = V_USUARIO;

  DBMS_OUTPUT.PUT_LINE('Comentario del usuario con identificador ' || V_USUARIO || ' modificado.');
  COMMIT;
--		*** otra opcion ***
--  V_CONTENIDO_MODERADO := 'El mensaje ha sido moderado.';
--
--  UPDATE COMENTARIO
--  SET CADENA_TEXTO = V_CONTENIDO_MODERADO
--  WHERE PLAYLIST_ID = V_PLAYLIST
--  AND USUARIO_ID = V_USUARIO;
--  DBMS_OUTPUT.PUT_LINE('El usuario: ' || V_USUARIO || ' ha sido moderado en la playlist: ' || V_PLAYLIST);

END;
  
--9. Calcular la media de una lista
CREATE OR REPLACE PROCEDURE MEDIA_PLAYLIST(
	V_PLAYLIST PLAYLIST.ID_PL%TYPE)
IS
V_PROMEDIO_PUNTUACION NUMBER(2,1);
BEGIN
	SELECT AVG(PUNTUACION) INTO V_PROMEDIO_PUNTUACION
	FROM VALORACION
	WHERE VALORACION.PLAYLIST_ID = V_PLAYLIST;
END;
/

--10. Todos los comentarios listados por usuario
CREATE OR REPLACE PROCEDURE OBTENER_COMENTARIOS_POR_USUARIO(
  V_USUARIO_ID USUARIO.ID%TYPE)
IS
  V_NICK_NAME USUARIO.NICK_NAME%TYPE;
  V_CADENA_TEXTO COMENTARIO.CADENA_TEXTO%TYPE;
  V_CONTADOR NUMBER(1) := 1;
BEGIN
  
  SELECT NICK_NAME INTO V_NICK_NAME
  FROM USUARIO
  WHERE ID = V_USUARIO_ID;
  
  DBMS_OUTPUT.PUT_LINE('Usuario: ' || V_NICK_NAME);
  
  -- Obtener y mostrar todos los comentarios del usuario
  FOR FILA_COMENTARIO IN (
    SELECT CADENA_TEXTO
    FROM COMENTARIO
    WHERE USUARIO_ID = V_USUARIO_ID
  )
  LOOP
    V_CADENA_TEXTO := FILA_COMENTARIO.CADENA_TEXTO;
    DBMS_OUTPUT.PUT_LINE('Comentario ' || V_CONTADOR || ': ' || V_CADENA_TEXTO);
    V_CONTADOR := V_CONTADOR + 1; -- Incrementa el contador
  END LOOP;

  EXCEPTION
    WHEN NO_DATA_FOUND THEN
      DBMS_OUTPUT.PUT_LINE('No se encontraron comentarios para el usuario: ' || V_NICK_NAME);
END;
/

--11. Filtrar comentarios por fecha
CREATE OR REPLACE PROCEDURE FILTRAR_COMENTARIOS_POR_FECHA(
  V_FECHA_INICIO DATE)
IS
  OLD_FECHA_COMENTARIO DATE;
  OLD_NOMBRE PLAYLIST.NOMBRE%TYPE;
  OLD_NICK_NAME USUARIO.NICK_NAME%TYPE;
BEGIN
  OLD_FECHA_COMENTARIO := NULL;
  OLD_NOMBRE := NULL;
  OLD_NICK_NAME := NULL;

  FOR FILAS_COMENTARIO IN (
    SELECT
      COMENTARIO.FECHA_COMENTARIO,
      (SELECT NOMBRE FROM PLAYLIST WHERE ID_PL = COMENTARIO.PLAYLIST_ID) AS NOMBRE,
      (SELECT NICK_NAME FROM USUARIO WHERE ID = COMENTARIO.USUARIO_ID) AS NICK_NAME,
      COMENTARIO.CADENA_TEXTO
    FROM COMENTARIO
    WHERE COMENTARIO.FECHA_COMENTARIO >= V_FECHA_INICIO
    ORDER BY COMENTARIO.FECHA_COMENTARIO, NOMBRE, NICK_NAME
  )
  LOOP
    IF FILAS_COMENTARIO.FECHA_COMENTARIO != OLD_FECHA_COMENTARIO THEN
      DBMS_OUTPUT.PUT_LINE('Fecha: ' || FILAS_COMENTARIO.FECHA_COMENTARIO);
      DBMS_OUTPUT.PUT_LINE('  Playlist: ' || FILAS_COMENTARIO.NOMBRE);
      DBMS_OUTPUT.PUT_LINE('    Usuario: ' || FILAS_COMENTARIO.NICK_NAME);
      DBMS_OUTPUT.PUT_LINE('      Comentario: ' || FILAS_COMENTARIO.CADENA_TEXTO);
    ELSIF FILAS_COMENTARIO.NOMBRE != OLD_NOMBRE THEN
      DBMS_OUTPUT.PUT_LINE('  Playlist: ' || FILAS_COMENTARIO.NOMBRE);
      DBMS_OUTPUT.PUT_LINE('    Usuario: ' || FILAS_COMENTARIO.NICK_NAME);
      DBMS_OUTPUT.PUT_LINE('      Comentario: ' || FILAS_COMENTARIO.CADENA_TEXTO);
    ELSIF FILAS_COMENTARIO.NICK_NAME != OLD_NICK_NAME THEN
      DBMS_OUTPUT.PUT_LINE('    Usuario: ' || FILAS_COMENTARIO.NICK_NAME);
      DBMS_OUTPUT.PUT_LINE('      Comentario: ' || FILAS_COMENTARIO.CADENA_TEXTO);
    ELSE
      DBMS_OUTPUT.PUT_LINE('      Comentario: ' || FILAS_COMENTARIO.CADENA_TEXTO);
    END IF;
    OLD_FECHA_COMENTARIO := FILAS_COMENTARIO.FECHA_COMENTARIO;
    OLD_NOMBRE := FILAS_COMENTARIO.NOMBRE;
    OLD_NICK_NAME := FILAS_COMENTARIO.NICK_NAME;
  END LOOP;
END;
/
				----------------------------
				--	**** FUNCIONES  ****  --
				----------------------------

--1. Funcion que consulta para buscar una playlist por su ID, si no existe, genera una excepción, NO_DATA_FOUND. Si la encuentra te devuelve el nombre de la playlist.
CREATE OR REPLACE FUNCTION BUSCAR_PLAYLIST(
	V_PLAYLIST PLAYLIST.ID_PL%TYPE)
RETURN VARCHAR2
DECLARE
  v_NOMBRE_playlist PLAYLIST.NOMBRE%TYPE;
BEGIN
  SELECT NOMBRE INTO v_NOMBRE_playlist
  FROM PLAYLIST
  WHERE ID_PL = V_PLAYLIST;
    
  DBMS_OUTPUT.PUT_LINE('La playlist con ID ' || V_PLAYLIST || ' tiene el nombre: ' || v_NOMBRE_playlist);
  RETURN v_NOMBRE_playlist;

EXCEPTION
  WHEN NO_DATA_FOUND THEN
	  DBMS_OUTPUT.PUT_LINE('No se ha encontrado la playlist con el ID ' || V_PLAYLIST);
	  RETURN NULL; -- La funcion debe devolver algo, aunque sea null
END;
/
--2. Funcion que busca usuarios por su nombre
CREATE OR REPLACE FUNCTION BUSCAR_USUARIOS_POR_NOMBRE(
	V_NOMBRE USUARIO.NOMBRE%TYPE)
RETURN VARCHAR2
IS
	V_RESULTADO VARCHAR2(400);
BEGIN
  V_RESULTADO := 'Usuarios con el nombre ' || V_NOMBRE || ':\n';

  FOR FILA_USUARIO IN (
    SELECT ID, NOMBRE
    FROM USUARIO
    WHERE NOMBRE = V_NOMBRE
  )
  LOOP
    V_RESULTADO := V_RESULTADO || FILA_USUARIO.ID || ': ' || FILA_USUARIO.NOMBRE || '\n';
  END LOOP;

  IF V_RESULTADO = 'Usuarios con el nombre ' || V_NOMBRE || ':\n' THEN
    RAISE_APPLICATION_ERROR(-404, 'No se encontraron usuarios con nombre ' || V_NOMBRE);-- valor negativo no provoca conflico con errores de oracle
  END IF;

  RETURN V_RESULTADO;
END;
/

				---------------------------
				--	**** TRIGGERS  ****  --
				---------------------------

--1. Para tener seguimiento de usuarios eliminados, actualizados o insertados, se crea una tabla AUDITORIA_USUARIOS y un trigger que se ejecuta antes de cada operación de inserción, actualización o eliminación en la tabla USUARIO.
DROP TABLE AUDITORIA_USUARIOS CASCADE CONSTRAINTS;
CREATE TABLE AUDITORIA_USUARIOS(
    COL1 VARCHAR(200)
);

CREATE OR REPLACE TRIGGER AUDITAR_USUARIOS
   BEFORE INSERT OR UPDATE OR DELETE ON USUARIO
   FOR EACH ROW
BEGIN
   IF INSERTING THEN
      INSERT INTO AUDITORIA_USUARIOS VALUES('Usuario insertado ' || :NEW.ID || ' nombre: ' || :NEW.NOMBRE);
   ELSIF UPDATING THEN
      INSERT INTO AUDITORIA_USUARIOS VALUES('Usuario actualizado ' || :NEW.ID || ': antiguo nombre: ' || :OLD.NOMBRE || ', nuevo nombre: ' || :NEW.NOMBRE);
   ELSIF DELETING THEN
      INSERT INTO AUDITORIA_USUARIOS VALUES('Usuario eliminado ' || :OLD.ID || ' nombre: ' || :OLD.NOMBRE);
   END IF;
END;
/

--2. Para tener seguimiento de comentarios eliminados, actualizados o insertados, se crea una tabla AUDITORIA_COMENTARIOS y un trigger que se ejecuta antes de cada operación de inserción, actualización o eliminación en la tabla COMENTARIO.
DROP TABLE AUDITORIA_COMENTARIOS CASCADE CONSTRAINTS;
CREATE TABLE AUDITORIA_COMENTARIOS(
    COL1 VARCHAR(200)
);

CREATE OR REPLACE TRIGGER AUDITAR_COMENTARIOS
   BEFORE INSERT OR UPDATE OR DELETE ON COMENTARIO
   FOR EACH ROW
BEGIN
    IF INSERTING THEN
        INSERT INTO AUDITORIA_COMENTARIOS VALUES('Comentario insertado ' || :NEW.COMENTARIO_ID || ' comentario: ' || :NEW.CADENA_TEXTO);
    ELSIF UPDATING THEN
        INSERT INTO AUDITORIA_COMENTARIOS VALUES('Comentario actualizado ' || :NEW.COMENTARIO_ID || ': antiguo comentario: ' || :OLD.CADENA_TEXTO || ', nuevo comentario: ' || :NEW.CADENA_TEXTO);
    ELSIF DELETING THEN
        INSERT INTO AUDITORIA_COMENTARIOS VALUES('Comentario eliminado ' || :OLD.COMENTARIO_ID || ' comentario: ' || :OLD.CADENA_TEXTO);
    END IF;
END;
/
--3. Para tener seguimiento de valoraciones eliminadas, actualizadas o insertadas, se crea una tabla AUDITORIA_VALORACIONES y un trigger que se ejecuta antes de cada operación de inserción, actualización o eliminación en la tabla VALORACION.
DROP TABLE AUDITORIA_VALORACIONES CASCADE CONSTRAINTS;
CREATE TABLE AUDITORIA_VALORACIONES (
    VALORACION_ID NUMBER(6),
    ACCION VARCHAR2(100),
    USUARIO_ID NUMBER(6),
    PLAYLIST_ID NUMBER(6),
    FECHA_VALORACION DATE
);
CREATE OR REPLACE TRIGGER AUDITAR_VALORACIONES
  BEFORE INSERT OR UPDATE OR DELETE ON VALORACION
  FOR EACH ROW
BEGIN

  IF INSERTING THEN
    INSERT INTO AUDITORIA_VALORACIONES (VALORACION_ID, ACCION, USUARIO_ID, PLAYLIST_ID, FECHA_VALORACION)
    VALUES (:NEW.VALORACION_ID, 'Valoracion insertada', :NEW.USUARIO_ID, :NEW.PLAYLIST_ID, SYSDATE);
    
  ELSIF UPDATING THEN
    INSERT INTO AUDITORIA_VALORACIONES (VALORACION_ID, ACCION, USUARIO_ID, PLAYLIST_ID, FECHA_VALORACION)
    VALUES (:NEW.VALORACION_ID, 'Valoracion actualizada', :NEW.USUARIO_ID, :NEW.PLAYLIST_ID, SYSDATE);
    
  ELSIF DELETING THEN
    INSERT INTO AUDITORIA_VALORACIONES (VALORACION_ID, ACCION, USUARIO_ID, PLAYLIST_ID, FECHA_VALORACION)
    VALUES (:OLD.VALORACION_ID, 'Valoracion eliminada', :OLD.USUARIO_ID, :OLD.PLAYLIST_ID, SYSDATE);
  END IF;
  
END;
/