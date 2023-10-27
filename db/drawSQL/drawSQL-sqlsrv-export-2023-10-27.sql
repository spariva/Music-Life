CREATE TABLE "Canciones"(
    "Cancion_id" INT NOT NULL,
    "Titulo" VARCHAR(255) NOT NULL,
    "Artista" VARCHAR(255) NOT NULL
);
ALTER TABLE
    "Canciones" ADD CONSTRAINT "canciones_cancion_id_primary" PRIMARY KEY("Cancion_id");
CREATE TABLE "Playlists"(
    "id" INT NOT NULL,
    "Nombre" VARCHAR(255) NOT NULL,
    "Creador_id" INT NOT NULL,
    "Cancion_id" INT NOT NULL
);
ALTER TABLE
    "Playlists" ADD CONSTRAINT "playlists_id_primary" PRIMARY KEY("id");
CREATE TABLE "Usuarios"(
    "id" INT NOT NULL,
    "Nombre" VARCHAR(255) NOT NULL,
    "Email" VARCHAR(255) NOT NULL,
    "Contrasena" VARCHAR(255) NOT NULL
);
ALTER TABLE
    "Usuarios" ADD CONSTRAINT "usuarios_id_primary" PRIMARY KEY("id");
CREATE UNIQUE INDEX "usuarios_email_unique" ON
    "Usuarios"("Email");
CREATE TABLE "Comentarios"(
    "id" INT NOT NULL,
    "Comentario" VARCHAR(255) NOT NULL,
    "Usuario_id" INT NOT NULL,
    "Playlist_id" INT NOT NULL
);
ALTER TABLE
    "Comentarios" ADD CONSTRAINT "comentarios_id_primary" PRIMARY KEY("id");
ALTER TABLE
    "Comentarios" ADD CONSTRAINT "comentarios_playlist_id_foreign" FOREIGN KEY("Playlist_id") REFERENCES "Playlists"("id");
ALTER TABLE
    "Playlists" ADD CONSTRAINT "playlists_cancion_id_foreign" FOREIGN KEY("Cancion_id") REFERENCES "Canciones"("Cancion_id");
ALTER TABLE
    "Comentarios" ADD CONSTRAINT "comentarios_playlist_id_foreign" FOREIGN KEY("Playlist_id") REFERENCES "Playlists"("id");
ALTER TABLE
    "Playlists" ADD CONSTRAINT "playlists_creador_id_foreign" FOREIGN KEY("Creador_id") REFERENCES "Usuarios"("id");
ALTER TABLE
    "Comentarios" ADD CONSTRAINT "comentarios_usuario_id_foreign" FOREIGN KEY("Usuario_id") REFERENCES "Usuarios"("id");
ALTER TABLE
    "Playlists" ADD CONSTRAINT "playlists_cancion_id_foreign" FOREIGN KEY("Cancion_id") REFERENCES "Canciones"("Cancion_id");