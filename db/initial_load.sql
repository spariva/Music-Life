-- Insert Usuarios
INSERT INTO USER (NAME, EMAIL, PASSWORD) VALUES('Sergio','email1@mail.es','1234');
INSERT INTO USER (NAME, EMAIL, PASSWORD) VALUES('Maki','email2@mail.es','1234');
INSERT INTO USER (NAME, EMAIL, PASSWORD) VALUES('Miguel','email3@mail.es','1234');
INSERT INTO USER (NAME, EMAIL, PASSWORD) VALUES('Spotify','spotify@mail.es','1234');

COMMIT;

-- --INSERT PLAYLIST PRUEBA
-- INSERT INTO PLAYLIST_PRUEBA VALUES (001,'DUA_LIPA',123456,'https://open.spotify.com/embed/playlist/37i9dQZF1DX3fRquEp6m8D?utm_source=generator');
-- INSERT INTO PLAYLIST_PRUEBA VALUES (002,'ANA_MENA',123456,'https://open.spotify.com/embed/playlist/37i9dQZF1DZ06evO3Jtnqm?utm_source=generator');
-- INSERT INTO PLAYLIST_PRUEBA VALUES (003,'BELEN_AGUILERA',123456,'https://open.spotify.com/embed/playlist/37i9dQZF1DZ06evO35iRfG?utm_source=generator');

-- -- Insert Playlists
-- INSERT INTO PLAYLISTS (ID_PL, NAME, CREADOR_ID) VALUES (123456, 'Top 50 Mundial', '000001');
-- INSERT INTO PLAYLISTS (ID_PL, NAME, CREADOR_ID) VALUES (123456, 'Top 50 España', '000002');
-- INSERT INTO PLAYLISTS (ID_PL, NAME, CREADOR_ID) VALUES (123456, 'Lunes de lluvia', '000003');
-- INSERT INTO PLAYLISTS (ID_PL, NAME, CREADOR_ID) VALUES (123456, 'Juernes fiestero', '000003');
-- COMMIT;

-- Insert Comentarios

COMMIT;

-- Insert Canciones
--INSERT INTO CANCIONES (1223462, column2, column3) VALUES ('value1', 'value2', 'value3');
--INSERT INTO CANCIONES (1223463, column2, column3) VALUES ('value4', 'value5', 'value6');
--INSERT INTO CANCIONES (1223465, column2, column3) VALUES ('value7', 'value8', 'value9');
--COMMIT;

--estas seran las de por defecto del index
INSERT INTO PLAYLIST VALUES("https://open.spotify.com/embed/playlist/37i9dQZF1DX5KpP2LN299J", "spotify");
INSERT INTO PLAYLIST VALUES("https://open.spotify.com/embed/playlist/37i9dQZF1DX2apWzyECwyZ", "spotify");
INSERT INTO PLAYLIST VALUES("https://open.spotify.com/embed/playlist/37i9dQZF1DX6bnzK9KPvrz", "spotify");
INSERT INTO PLAYLIST VALUES("https://open.spotify.com/embed/playlist/37i9dQZF1DX1LUyBs1uGpN", "spotify");
INSERT INTO PLAYLIST VALUES("https://open.spotify.com/embed/playlist/37i9dQZF1DZ06evO4e5iLu", "spotify");
INSERT INTO PLAYLIST VALUES("https://open.spotify.com/embed/playlist/37i9dQZF1DX3rxVfibe1L0", "spotify");
INSERT INTO PLAYLIST VALUES("https://open.spotify.com/embed/playlist/37i9dQZF1DX4sWSpwq3LiO", "spotify");
INSERT INTO PLAYLIST VALUES("https://open.spotify.com/embed/playlist/37i9dQZF1DX4dyzvuaRJ0n", "spotify");
INSERT INTO PLAYLIST VALUES("https://open.spotify.com/embed/playlist/37i9dQZF1DXcBWIGoYBM5M", "spotify");
INSERT INTO PLAYLIST VALUES("https://open.spotify.com/embed/playlist/37i9dQZF1DXcF6B6QPhFDv", "spotify");
INSERT INTO PLAYLIST VALUES("https://open.spotify.com/embed/playlist/37i9dQZF1DX0XUsuxWHRQd", "spotify");
INSERT INTO PLAYLIST VALUES("https://open.spotify.com/embed/playlist/37i9dQZF1DX1lVhptIYRda", "spotify");
INSERT INTO PLAYLIST VALUES("https://open.spotify.com/embed/playlist/37i9dQZF1DX10zKzsJ2jva", "spotify");
INSERT INTO PLAYLIST VALUES("https://open.spotify.com/embed/playlist/37i9dQZF1DX4JAvHpjipBk", "spotify");
INSERT INTO PLAYLIST VALUES("https://open.spotify.com/embed/playlist/37i9dQZF1DX4E3UdUs7fUx", "spotify");
INSERT INTO PLAYLIST VALUES("https://open.spotify.com/embed/playlist/37i9dQZF1DX4SBhb3fqCJd", "spotify");
INSERT INTO PLAYLIST VALUES("https://open.spotify.com/embed/playlist/37i9dQZF1DXcZDD7cfEKhW", "spotify");
INSERT INTO PLAYLIST VALUES("https://open.spotify.com/embed/playlist/37i9dQZF1DX4WYpdgoIcn6", "spotify");
INSERT INTO PLAYLIST VALUES("https://open.spotify.com/embed/playlist/37i9dQZF1DXcRXFNfZr7Tp", "spotify");

INSERT INTO COMENTARIOS (COMENTARIO, AUTOR, LINK) VALUES ('Genial playlist', 'Sergio', 'https://open.spotify.com/embed/playlist/37i9dQZF1DX5KpP2LN299J');
INSERT INTO COMENTARIOS (COMENTARIO, AUTOR, LINK) VALUES ('Qué buena playlist', 'Maki', 'https://open.spotify.com/embed/playlist/37i9dQZF1DX5KpP2LN299J');
INSERT INTO COMENTARIOS (COMENTARIO, AUTOR, LINK) VALUES ('Qué buena playlist', 'Maki', 'https://open.spotify.com/embed/playlist/37i9dQZF1DX2apWzyECwyZ');
INSERT INTO COMENTARIOS (COMENTARIO, AUTOR, LINK) VALUES ('Lo mejor que he escuchado en años.', 'Miguel', 'https://open.spotify.com/embed/playlist/37i9dQZF1DX2apWzyECwyZ');
