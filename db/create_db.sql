-- CREATE DATABASE musicLifeDatabase;

-- TABLE DELETION
DROP TABLE IF EXISTS USER;
DROP TABLE IF EXISTS PLAYLIST;
DROP TABLE IF EXISTS RATING;
DROP TABLE IF EXISTS TOKENS;

-- TABLE CREATION

-- USER
-- EL ID SE AUTOINCREMENTA
CREATE TABLE USER(
    ID INT(6) PRIMARY KEY AUTO_INCREMENT,
    NAME VARCHAR(26) NOT NULL,
    EMAIL VARCHAR(50) NOT NULL UNIQUE,
    PASSWORD VARCHAR(20) NOT NULL
);

-- PLAYLIST
CREATE TABLE PLAYLIST(
  ID_PL VARCHAR(30) PRIMARY KEY,
  NAME VARCHAR(26) NOT NULL,
  --CREATOR_ID INT(6) NOT NULL, 
  LINK VARCHAR(20) NOT NULL
  -- FOREIGN KEY (CREATOR_ID) REFERENCES USER(ID) ON DELETE CASCADE no tiene sentido guardar el creator id si no podemos crear desde nuestra web.
);

CREATE TABLE TOKENS (
    ID INT(11) UNSIGNED AUTO_INCREMENT NOT NULL,
    TOKEN CHAR(60),
    USERID VARCHAR(50) NOT NULL,
    EXPIRES DATE, 
    TIPO ENUM('ACTIVATE', 'REMEMBER', 'RECOVERY') NOT NULL, -- REMEMBER es el recuerdame ACTIVATE es activar user y recovery para recuperar psswd
    PRIMARY KEY (ID)
);

CREATE TABLE RATING(
    RATING_ID INT(6) NOT NULL,
    PLAYLIST_ID VARCHAR(30) NOT NULL,
    USER_ID INT(6),
    SCORE DECIMAL(2,1) NOT NULL,
    COMMENT VARCHAR(600),
    DATE TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (PLAYLIST_ID) REFERENCES PLAYLIST(ID_PL) ON DELETE CASCADE,
    FOREIGN KEY (USER_ID) REFERENCES USER(ID) ON DELETE SET NULL,
    PRIMARY KEY(RATING_ID,PLAYLIST_ID,USER_ID)
);