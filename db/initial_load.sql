-- Insert Usuarios
INSERT INTO user (NAME, EMAIL, PASSWORD) VALUES('Sergio','email1@mail.es','1234');
INSERT INTO user (NAME, EMAIL, PASSWORD) VALUES('M','email2@mail.es','1234');
INSERT INTO user (NAME, EMAIL, PASSWORD) VALUES('Miguel','email3@mail.es','1234');
INSERT INTO user (NAME, EMAIL, PASSWORD) VALUES('Spotify','spotify@mail.es','1234');

COMMIT;

--estas seran las de por defecto del index
-- 

INSERT INTO playlist VALUES("https://open.spotify.com/embed/playlist/37i9dQZF1DX5KpP2LN299J", "spotify");
INSERT INTO playlist VALUES("https://open.spotify.com/embed/playlist/37i9dQZF1DX2apWzyECwyZ", "spotify");
INSERT INTO playlist VALUES("https://open.spotify.com/embed/playlist/37i9dQZF1DX6bnzK9KPvrz", "spotify");
INSERT INTO playlist VALUES("https://open.spotify.com/embed/playlist/37i9dQZF1DX1LUyBs1uGpN", "spotify");
INSERT INTO playlist VALUES("https://open.spotify.com/embed/playlist/37i9dQZF1DZ06evO4e5iLu", "spotify");
INSERT INTO playlist VALUES("https://open.spotify.com/embed/playlist/37i9dQZF1DX3rxVfibe1L0", "spotify");
INSERT INTO playlist VALUES("https://open.spotify.com/embed/playlist/37i9dQZF1DX4sWSpwq3LiO", "spotify");
INSERT INTO playlist VALUES("https://open.spotify.com/embed/playlist/37i9dQZF1DX4dyzvuaRJ0n", "spotify");
INSERT INTO playlist VALUES("https://open.spotify.com/embed/playlist/37i9dQZF1DXcBWIGoYBM5M", "spotify");
INSERT INTO playlist VALUES("https://open.spotify.com/embed/playlist/37i9dQZF1DXcF6B6QPhFDv", "spotify");
INSERT INTO playlist VALUES("https://open.spotify.com/embed/playlist/37i9dQZF1DX0XUsuxWHRQd", "spotify");
INSERT INTO playlist VALUES("https://open.spotify.com/embed/playlist/37i9dQZF1DX1lVhptIYRda", "spotify");
INSERT INTO playlist VALUES("https://open.spotify.com/embed/playlist/37i9dQZF1DX10zKzsJ2jva", "spotify");
INSERT INTO playlist VALUES("https://open.spotify.com/embed/playlist/37i9dQZF1DX4JAvHpjipBk", "spotify");
INSERT INTO playlist VALUES("https://open.spotify.com/embed/playlist/37i9dQZF1DX4E3UdUs7fUx", "spotify");
INSERT INTO playlist VALUES("https://open.spotify.com/embed/playlist/37i9dQZF1DX4SBhb3fqCJd", "spotify");
INSERT INTO playlist VALUES("https://open.spotify.com/embed/playlist/37i9dQZF1DXcZDD7cfEKhW", "spotify");
INSERT INTO playlist VALUES("https://open.spotify.com/embed/playlist/37i9dQZF1DX4WYpdgoIcn6", "spotify");
INSERT INTO playlist VALUES("https://open.spotify.com/embed/playlist/37i9dQZF1DXcRXFNfZr7Tp", "spotify");

INSERT INTO rating (TEXT, USER_NAME, LINK, SCORE) VALUES ('Genial playlist', 'Sergio', 'https://open.spotify.com/embed/playlist/37i9dQZF1DX5KpP2LN299J', 5);
INSERT INTO rating (TEXT, USER_NAME, LINK, SCORE) VALUES ('Qué buena playlist', 'M', 'https://open.spotify.com/embed/playlist/37i9dQZF1DX5KpP2LN299J', 4);
INSERT INTO rating (TEXT, USER_NAME, LINK, SCORE) VALUES ('Cool', 'M', 'https://open.spotify.com/embed/playlist/37i9dQZF1DX2apWzyECwyZ', 3);
INSERT INTO rating (TEXT, USER_NAME, LINK, SCORE) VALUES ('Lo mejor que he escuchado en años.', 'Miguel', 'https://open.spotify.com/embed/playlist/37i9dQZF1DX2apWzyECwyZ', 2);


-- INSERT INTO playlist VALUES("https://open.spotify.com/embed/playlist/6lHivMtxlldZdqEvpwGRxZ", "Maki");
-- INSERT INTO rating (TEXT, USER_NAME, LINK, SCORE) VALUES ('Desgarradora', 'Maki', 'https://open.spotify.com/embed/playlist/6lHivMtxlldZdqEvpwGRxZ', 5);