-- 1. Crear un usuario (depende si quitamos o no la secuencia, haría falta la línea del max(id) + 1):
DECLARE
  v_id NUMBER(6);
BEGIN
  SELECT MAX(ID) + 1 INTO v_id FROM USUARIOS;
  
  INSERT INTO USUARIOS (ID, NOMBRE, EMAIL, CONTRASENA)
  VALUES (v_id, 'NombreUsuario', 'correo@example.com', 'contrasena123');
  
  COMMIT;
END;
/

-- 2. Actualizar el nombre de un usuario en la tabla USUARIOS:
DECLARE
  v_usuario_id NUMBER(6) := 1; -- ID del usuario a actualizar
  v_nuevo_nombre VARCHAR2(26) := 'NuevoNombre';
BEGIN
  UPDATE USUARIOS
  SET NOMBRE = v_nuevo_nombre
  WHERE ID = v_usuario_id;
  
  COMMIT;
END;
/

--Eliminar un usuario de la tabla USUARIOS y sus playlists relacionadas:
DECLARE
  v_usuario_id NUMBER(6) := 1; -- ID del usuario a eliminar
BEGIN
  DELETE FROM PLAYLISTS
  WHERE CREADOR_ID = v_usuario_id;
  
  DELETE FROM USUARIOS
  WHERE ID = v_usuario_id;
  
  COMMIT;
END;
/

--Insertar un nuevo comentario en la tabla COMENTARIOS:
DECLARE
  v_comentario_id NUMBER(6);
BEGIN
  SELECT MAX(COMENTARIO_ID) + 1 INTO v_comentario_id FROM COMENTARIOS;
  
  INSERT INTO COMENTARIOS (COMENTARIO_ID, COMENTARIO, USUARIO_ID, PLAYLIST_ID)
  VALUES (v_comentario_id, 'Este es un comentario', 1, 1); -- Usuario_ID y Playlist_ID de ejemplo
  
  COMMIT;
END;
/

--Crea una consulta para buscar una playlist por su nombre, si no existe, genera una excepción, NO_DATA_FOUND. Si la encuentra te devuelve el ID de la playlist.
DECLARE
  v_NOMBRE_playlist VARCHAR2(26) := 'NombrePlaylist';
  v_playlist_id NUMBER(6); 
BEGIN
    SELECT PLAYLIST_ID INTO v_playlist_id
    FROM PLAYLISTS
    WHERE NOMBRE = v_NOMBRE_playlist;
    
    DBMS_OUTPUT.PUT_LINE('La playlist con nombre ' || v_NOMBRE_playlist || ' tiene el ID ' || v_playlist_id);
    RETURN v_playlist_id;

EXCEPTION
    WHEN NO_DATA_FOUND THEN
        DBMS_OUTPUT.PUT_LINE('No se ha encontrado la playlist con el nombre ' || v_NOMBRE_playlist);
    END;
/

--Para tener seguimiento de usuarios eliminados, actualizados o insertados, se crea una tabla AUDITAR_USUARIOS y un trigger que se ejecuta antes de cada operación de inserción, actualización o eliminación en la tabla USUARIOS.
DROP TABLE AUDITAR_USUARIOS CASCADE CONSTRAINTS;
CREATE TABLE AUDITAR_USUARIOS(
    COL1 VARCHAR(200)
);

CREATE OR REPLACE TRIGGER AUDITAR_USUARIOS
   BEFORE INSERT OR UPDATE OR DELETE ON USUARIOS
   FOR EACH ROW
BEGIN
   IF INSERTING OR UPDATING THEN
      INSERT INTO AUDITAR_USUARIOS VALUES('Usuario actualizado ' || :NEW.ID || ': antiguo previo: ' || :OLD.NOMBRE || ' nuevo nombre: ' || :NEW.NOMBRE);
   ELSIF DELETING THEN
      INSERT INTO AUDITAR_USUARIOS VALUES('Usuario eliminado ' || :OLD.ID || ' nombre: ' || :OLD.NOMBRE);
   END IF;
END;
/

--Para tener seguimiento de comentarios eliminados, actualizados o insertados, se crea una tabla AUDITAR_COMENTARIOS y un trigger que se ejecuta antes de cada operación de inserción, actualización o eliminación en la tabla COMENTARIOS.
DROP TABLE AUDITAR_COMENTARIOS CASCADE CONSTRAINTS;
CREATE TABLE AUDITAR_COMENTARIOS(
    COL1 VARCHAR(200)
);

CREATE OR REPLACE TRIGGER AUDITAR_COMENTARIOS
   BEFORE INSERT OR UPDATE OR DELETE ON COMENTARIOS
   FOR EACH ROW
BEGIN
    IF INSERTING OR UPDATING THEN
        INSERT INTO AUDITAR_COMENTARIOS VALUES('Comentario actualizado ' || :NEW.COMENTARIO_ID || ': antiguo previo: ' || :OLD.COMENTARIO || ' nuevo comentario: ' || :NEW.COMENTARIO);
    ELSIF DELETING THEN
        INSERT INTO AUDITAR_COMENTARIOS VALUES('Comentario eliminado ' || :OLD.COMENTARIO_ID || ' comentario: ' || :OLD.COMENTARIO);
    END IF;
END;
/