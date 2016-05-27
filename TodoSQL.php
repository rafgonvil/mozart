<?php session_start(); ?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>Proyecto Mozart</title>
		<link type="text/css" rel="stylesheet" href="css/cssBase.css">
	</head>
	<body>
		<?php
		include_once ("CabeceraGenerica.php");
		?>
<div id="contenidoPag">
		<h1>Todo El Código SQL</h1>
		<div id="codSql">
<textarea name="code" class="sql:nogutter"rows="50" cols="100">
<!--
	
DROP TABLE TIENE;
DROP TABLE REALIZA;
DROP TABLE POSEE;
DROP TABLE NOTA;
DROP TABLE HORARIO;
DROP TABLE ASIGNATURA;
DROP TABLE MATRICULA;
DROP TABLE TIENE_ASIGNADO;
DROP TABLE SE_RESPONSABILIZA_DE;
DROP TABLE TUTOR;
DROP TABLE ALUMNO;
DROP TABLE PROFESOR;
DROP TABLE PERSONA;
DROP TABLE ESPECIALIDAD;

/*--------------------------TABLAS---------------------------------------*/

CREATE TABLE ESPECIALIDAD (
  OID_E             	  INTEGER         PRIMARY KEY     NOT NULL,
  NOMBRE		            VARCHAR2(50)    NOT NULL
);

CREATE TABLE PERSONA (
  OID_P                   INTEGER             PRIMARY KEY,
  DNI                     VARCHAR2(9)         NOT NULL, 
  NOMBRE                  VARCHAR2(50)        NOT NULL,
  FECHA_NACIMIENTO        DATE                NOT NULL,
  TELEFONO                CHAR(9),
  EMAIL                   VARCHAR2(50)
);

CREATE TABLE PROFESOR (
  OID_P             INTEGER       REFERENCES PERSONA ON DELETE CASCADE,
  PRIMARY KEY (OID_P)
);

CREATE TABLE ALUMNO (
  OID_P             INTEGER       REFERENCES PERSONA ON DELETE CASCADE,
  EDAD              INTEGER       NOT NULL,
  PRIMARY KEY (OID_P)
);

CREATE TABLE TUTOR (
  OID_P             INTEGER       REFERENCES PERSONA ON DELETE CASCADE,
  PRIMARY KEY (OID_P)
);

CREATE TABLE SE_RESPONSABILIZA_DE(
  OID_SR            INTEGER       PRIMARY KEY,
  TUTOR             INTEGER       REFERENCES TUTOR(OID_P) ON DELETE CASCADE,
  ALUMNO            INTEGER       REFERENCES ALUMNO(OID_P) ON DELETE CASCADE
);

CREATE TABLE TIENE_ASIGNADO (
  OID_TA            INTEGER        PRIMARY KEY,
  PROFESOR          INTEGER        REFERENCES PROFESOR(OID_P) ON DELETE CASCADE,
  ESPECIALIDAD      INTEGER        REFERENCES ESPECIALIDAD(OID_E) ON DELETE CASCADE 
);

CREATE TABLE MATRICULA (
  OID_M             INTEGER       PRIMARY KEY,
  A�O               INTEGER       NOT NULL,
  CURSO             VARCHAR2(50)  NOT NULL,
  PRECIO            NUMBER(4,2)   NOT NULL,
  ALUMNO            INTEGER       REFERENCES ALUMNO(OID_P) ON DELETE CASCADE NOT NULL
);

CREATE TABLE ASIGNATURA (
  OID_A             INTEGER       PRIMARY KEY,
  NOMBRE	          VARCHAR2(50)  NOT NULL,
  PROFESOR          INTEGER       REFERENCES PROFESOR(OID_P),
  MATRICULA         INTEGER       REFERENCES MATRICULA(OID_M)ON DELETE CASCADE,
  ESPECIALIDAD      INTEGER       REFERENCES ESPECIALIDAD(OID_E) ON DELETE CASCADE
);

CREATE TABLE HORARIO (
  OID_H             INTEGER       PRIMARY KEY NOT NULL,
  DIA               VARCHAR2(50),
  HORAINICIO        VARCHAR2(50),
  DURACION	        NUMBER(4,2)
);

CREATE TABLE NOTA (
  ALUMNO            INTEGER       REFERENCES ALUMNO(OID_P) ON DELETE CASCADE,
  OID_A             INTEGER       REFERENCES ASIGNATURA ON DELETE CASCADE,
  PRIMARY KEY(ALUMNO, OID_A),
  VALOR             NUMBER(4,2)   NOT NULL,
  CONVOCATORIA	    VARCHAR2(50)  CHECK ( CONVOCATORIA IN ('PRIMERA_CONVOCATORIA','SEGUNDA_CONVOCATORIA','TERCERA_CONVOCATORIA')),	
  PROFESOR          INTEGER       REFERENCES PROFESOR(OID_P)
);

CREATE TABLE POSEE (
  OID_PO            INTEGER       PRIMARY KEY NOT NULL,
  OID_H             INTEGER       REFERENCES HORARIO ON DELETE CASCADE,
  OID_A             INTEGER       REFERENCES ASIGNATURA ON DELETE CASCADE
);

CREATE TABLE REALIZA (
  OID_R		          INTEGER	  PRIMARY KEY NOT NULL,
  ALUMNO	          INTEGER	  REFERENCES ALUMNO(OID_P) ON DELETE CASCADE,
  ASIGNATURA	      INTEGER	  REFERENCES ASIGNATURA(OID_A) ON DELETE CASCADE
);

CREATE TABLE TIENE (
  OID_T		          INTEGER	  PRIMARY KEY NOT NULL,
  ESPECIALIDAD	    INTEGER	  REFERENCES ESPECIALIDAD(OID_E) ON DELETE CASCADE,
  ALUMNO	          INTEGER	  REFERENCES ALUMNO(OID_P) ON DELETE CASCADE
);

/*--------------------SECUENCIAS-----------------------------*/

  DROP SEQUENCE SEC_TUTOR;
  DROP SEQUENCE SEC_TIENE_ASIGNADO;
  DROP SEQUENCE SEC_TIENE;
  DROP SEQUENCE SEC_SE_RESPONSABILIZA_DE;
  DROP SEQUENCE SEC_REALIZA;
  DROP SEQUENCE SEC_PROFESOR;
  DROP SEQUENCE SEC_POSEE;
  DROP SEQUENCE SEC_MATRICULA;
  DROP SEQUENCE SEC_HORARIO;
  DROP SEQUENCE SEC_ESPECIALIDAD;
  DROP SEQUENCE SEC_ASIGNATURA;
  DROP SEQUENCE SEC_ALUMNO;

  CREATE SEQUENCE  SEC_ALUMNO  MINVALUE 1 MAXVALUE 2500 INCREMENT BY 1 START WITH 1 CACHE 20 NOORDER  NOCYCLE ;
  CREATE SEQUENCE  SEC_ASIGNATURA  MINVALUE 1 MAXVALUE 9999999999999999999999999999 INCREMENT BY 1 START WITH 1 CACHE 20 NOORDER  NOCYCLE ;
  CREATE SEQUENCE  SEC_ESPECIALIDAD  MINVALUE 1 MAXVALUE 9999999999999999999999999999 INCREMENT BY 1 START WITH 1 CACHE 20 NOORDER  NOCYCLE ;
  CREATE SEQUENCE  SEC_HORARIO  MINVALUE 1 MAXVALUE 9999999999999999999999999999 INCREMENT BY 1 START WITH 1 CACHE 20 NOORDER  NOCYCLE ;
  CREATE SEQUENCE  SEC_MATRICULA  MINVALUE 1 MAXVALUE 9999999999999999999999999999 INCREMENT BY 1 START WITH 1 CACHE 20 NOORDER  NOCYCLE ;
  CREATE SEQUENCE  SEC_POSEE  MINVALUE 1 MAXVALUE 9999999999999999999999999999 INCREMENT BY 1 START WITH 1 CACHE 20 NOORDER  NOCYCLE ;
  CREATE SEQUENCE  SEC_PROFESOR  MINVALUE 2501 MAXVALUE 3000 INCREMENT BY 1 START WITH 2501 CACHE 20 NOORDER  NOCYCLE ;
  CREATE SEQUENCE  SEC_REALIZA  MINVALUE 1 MAXVALUE 9999999999999999999999999999 INCREMENT BY 1 START WITH 1 CACHE 20 NOORDER  NOCYCLE ;
  CREATE SEQUENCE  SEC_SE_RESPONSABILIZA_DE  MINVALUE 1 MAXVALUE 9999999999999999999999999999 INCREMENT BY 1 START WITH 1 CACHE 20 NOORDER  NOCYCLE ;
  CREATE SEQUENCE  SEC_TIENE  MINVALUE 1 MAXVALUE 9999999999999999999999999999 INCREMENT BY 1 START WITH 1 CACHE 20 NOORDER  NOCYCLE ;
  CREATE SEQUENCE  SEC_TIENE_ASIGNADO  MINVALUE 1 MAXVALUE 9999999999999999999999999999 INCREMENT BY 1 START WITH 1 CACHE 20 NOORDER  NOCYCLE ;
  CREATE SEQUENCE  SEC_TUTOR  MINVALUE 3001 MAXVALUE 3500 INCREMENT BY 1 START WITH 3001 CACHE 20 NOORDER  NOCYCLE ;
  
/*----------------------------------PROCEDURES--------------------------------*/  

create or replace PROCEDURE INSERTAR_ALUMNO(
  W_DNI               PERSONA.DNI%TYPE,
  W_NOMBRE            PERSONA.NOMBRE%TYPE,
  W_FECHA_NACIMIENTO  PERSONA.FECHA_NACIMIENTO%TYPE,
  W_TELEFONO          PERSONA.TELEFONO%TYPE,
  W_EMAIL             PERSONA.EMAIL%TYPE
) AS      
        edad INTEGER;
        a�o  DATE;
        sec INTEGER;
BEGIN

  INSERT INTO PERSONA VALUES (SEC_ALUMNO.NEXTVAL,W_DNI,W_NOMBRE,W_FECHA_NACIMIENTO,W_TELEFONO,W_EMAIL);
  sec := SEC_AlUMNO.CURRVAL;
  SELECT FECHA_NACIMIENTO INTO a�o FROM PERSONA WHERE OID_P = sec;
  SELECT TRUNC(MONTHS_BETWEEN(SYSDATE,A�O)/12) INTO edad FROM DUAL;
  INSERT INTO ALUMNO VALUES (sec,edad);
  COMMIT WORK;
  
END INSERTAR_ALUMNO;

/

create or replace PROCEDURE INSERTAR_ASIGNATURA(
W_NOMBRE          ASIGNATURA.NOMBRE%TYPE,
W_PROFESOR        ASIGNATURA.PROFESOR%TYPE,
W_MATRICULA       ASIGNATURA.MATRICULA%TYPE,
W_ESPECIALIDAD    ASIGNATURA.ESPECIALIDAD%TYPE
)AS 
BEGIN
  INSERT INTO ASIGNATURA VALUES(SEC_ASIGNATURA.NEXTVAL,W_NOMBRE,W_PROFESOR, W_MATRICULA, W_ESPECIALIDAD);
  COMMIT WORK;
END INSERTAR_ASIGNATURA;

/

create or replace PROCEDURE INSERTAR_ESPECIALIDAD (
  W_NOMBRE        ESPECIALIDAD.NOMBRE%TYPE,
  W_PERSONA       PERSONA.OID_P%TYPE
  )
AS
BEGIN
  IF(W_PERSONA <= 2500 AND W_PERSONA >= 1)
    THEN
  INSERT INTO ESPECIALIDAD VALUES(SEC_ESPECIALIDAD.NEXTVAL,W_NOMBRE);
  INSERT INTO TIENE VALUES(SEC_TIENE.NEXTVAL, SEC_ESPECIALIDAD.CURRVAL, W_PERSONA);
  ELSIF(W_PERSONA <= 3000 AND W_PERSONA >=2501)
    THEN
  INSERT INTO ESPECIALIDAD VALUES(SEC_ESPECIALIDAD.NEXTVAL,W_NOMBRE);
  INSERT INTO TIENE_ASIGNADO VALUES(SEC_TIENE.NEXTVAL, SEC_ESPECIALIDAD.CURRVAL, W_PERSONA);
  
  END IF;

  COMMIT WORK;
END INSERTAR_ESPECIALIDAD;

/

create or replace PROCEDURE INSERTAR_HORARIO(
  W_DIA                 HORARIO.DIA%TYPE,
  W_FECHA               HORARIO.HORAINICIO%TYPE,
  W_DURACION            HORARIO.DURACION%TYPE
  )AS 
  HORA VARCHAR2(50);
BEGIN
  INSERT INTO HORARIO VALUES(SEC_HORARIO.NEXTVAL,W_DIA,W_FECHA,W_DURACION);
  COMMIT WORK;
END INSERTAR_HORARIO;

/

create or replace PROCEDURE INSERTAR_NOTA( 
  W_ALUMNO          NOTA.ALUMNO%TYPE,
  W_OID_A           NOTA.OID_A%TYPE,
  W_VALOR           NOTA.VALOR%TYPE,
  W_CONVOCATORIA    NOTA.CONVOCATORIA%TYPE,
  W_PROFESOR        NOTA.PROFESOR%TYPE

)AS 
BEGIN

  INSERT INTO NOTA VALUES (W_ALUMNO,W_OID_A, W_VALOR,W_CONVOCATORIA,W_PROFESOR);
  COMMIT WORK;

END INSERTAR_NOTA;

/

create or replace PROCEDURE INSERTAR_POSEE (
W_OID_H                 POSEE.OID_H%TYPE,
W_OID_A                 POSEE.OID_A%TYPE)
AS 
BEGIN
  INSERT INTO POSEE VALUES (SEC_POSEE.NEXTVAL,W_OID_H,W_OID_A);
  COMMIT WORK;
END INSERTAR_POSEE;
  
/  
  
create or replace PROCEDURE INSERTAR_PROFESOR(
  W_DNI               PERSONA.DNI%TYPE,
  W_NOMBRE            PERSONA.NOMBRE%TYPE,
  W_FECHA_NACIMIENTO  PERSONA.FECHA_NACIMIENTO%TYPE,
  W_TELEFONO          PERSONA.TELEFONO%TYPE,
  W_EMAIL             PERSONA.EMAIL%TYPE
) AS 
BEGIN
  INSERT INTO PERSONA VALUES (SEC_PROFESOR.NEXTVAL,W_DNI,W_NOMBRE,W_FECHA_NACIMIENTO,W_TELEFONO,W_EMAIL);
  INSERT INTO PROFESOR VALUES (SEC_PROFESOR.CURRVAL);
  COMMIT WORK;
  
END INSERTAR_PROFESOR;

/

create or replace PROCEDURE INSERTAR_REALIZA(
W_OID_P                 REALIZA.ALUMNO%TYPE,
W_OID_A                 REALIZA.ASIGNATURA%TYPE)
AS 
BEGIN
  
  INSERT INTO REALIZA VALUES (SEC_REALIZA.NEXTVAL,W_OID_P,W_OID_A);
  COMMIT WORK;
  
END INSERTAR_REALIZA;

/

create or replace PROCEDURE INSERTAR_SE_RESPONSABILIZA_DE(
W_TUTOR             SE_RESPONSABILIZA_DE.TUTOR%TYPE,
W_ALUMNO            SE_RESPONSABILIZA_DE.ALUMNO%TYPE

)AS 
BEGIN

  INSERT INTO SE_RESPONSABILIZA_DE VALUES (SEC_SE_RESPONSABILIZA_DE.NEXTVAL, W_TUTOR,W_ALUMNO);
  COMMIT WORK;

END INSERTAR_SE_RESPONSABILIZA_DE;

/

create or replace PROCEDURE INSERTAR_TUTOR(
  W_DNI               PERSONA.DNI%TYPE,
  W_NOMBRE            PERSONA.NOMBRE%TYPE,
  W_FECHA_NACIMIENTO  PERSONA.FECHA_NACIMIENTO%TYPE,
  W_TEL�FONO          PERSONA."TELEFONO"%TYPE,
  W_EMAIL             PERSONA.EMAIL%TYPE
) AS 
BEGIN
  INSERT INTO PERSONA VALUES (SEC_TUTOR.NEXTVAL,W_DNI,W_NOMBRE,W_FECHA_NACIMIENTO,W_TEL�FONO,W_EMAIL);
  INSERT INTO TUTOR VALUES (SEC_TUTOR.CURRVAL);
  COMMIT WORK;
  
END INSERTAR_TUTOR;

/

create or replace PROCEDURE INSERTAR_MATRICULA (
W_A�O               MATRICULA.A�O%TYPE,
W_CURSO             MATRICULA.CURSO%TYPE,
W_ALUMNO            MATRICULA.ALUMNO%TYPE,
W_NOMBRE            ESPECIALIDAD.NOMBRE%TYPE
)AS 
numIn INTEGER;
seq INTEGER;
BEGIN 
SELECT COUNT(*) INTO numIn FROM TIENE WHERE TIENE.ALUMNO = W_ALUMNO;
IF(W_CURSO = 'MUSICA Y MOVIMIENTO 1')
  THEN INSERT INTO MATRICULA VALUES(SEC_MATRICULA.NEXTVAL,W_A�O,W_CURSO,30,W_ALUMNO);
      INSERTAR_PROFESOR('123456789','Virginia P�rez','01/03/1987','685811394','vir_2004@hotmail.com');
      INSERTAR_ASIGNATURA('INICIACI�N MUSICAL',SEC_PROFESOR.CURRVAL,SEC_MATRICULA.CURRVAL, null);
      INSERTAR_HORARIO('LUNES','01/01/2000 16:00:00',2);
      INSERTAR_POSEE(SEC_HORARIO.CURRVAL,SEC_ASIGNATURA.CURRVAL);
  COMMIT WORK;
ELSIF(W_CURSO = 'MUSICA Y MOVIMIENTO 2')
  THEN INSERT INTO MATRICULA VALUES(SEC_MATRICULA.NEXTVAL,W_A�O,W_CURSO,30,W_ALUMNO);
    INSERTAR_PROFESOR('123456789','Virginia P�rez','01/03/1987','685811394','vir_2004@hotmail.com');
    INSERTAR_ASIGNATURA('INICIACI�N MUSICAL',SEC_PROFESOR.CURRVAL,SEC_MATRICULA.CURRVAL, null);
    INSERTAR_HORARIO('MARTES','01/01/2000 16:00:00',2);
    INSERTAR_POSEE(SEC_HORARIO.CURRVAL,SEC_ASIGNATURA.CURRVAL);
  COMMIT WORK;
ELSIF(W_CURSO = 'MUSICA Y MOVIMIENTO 3')
  THEN INSERT INTO MATRICULA VALUES(SEC_MATRICULA.NEXTVAL,W_A�O,W_CURSO,35,W_ALUMNO);
    INSERTAR_ESPECIALIDAD(W_NOMBRE, W_ALUMNO);

   INSERTAR_PROFESOR('123456789','Virginia P�rez','01/03/1987','685811394','vir_2004@hotmail.com');
   INSERTAR_ASIGNATURA('INICIACI�N MUSICAL',SEC_PROFESOR.CURRVAL,SEC_MATRICULA.CURRVAL, SEC_ESPECIALIDAD.CURRVAL);
   INSERTAR_HORARIO('MI�RCOLES','01/01/2000 16:00:00',2.30);
   INSERTAR_POSEE(SEC_HORARIO.CURRVAL,SEC_ASIGNATURA.CURRVAL);
  COMMIT WORK;
ELSIF(W_CURSO = 'PREPARATORIO 1')
  THEN INSERT INTO MATRICULA VALUES(SEC_MATRICULA.NEXTVAL,W_A�O,W_CURSO,40,W_ALUMNO);
    INSERTAR_ESPECIALIDAD(W_NOMBRE, W_ALUMNO);

  seq:= SEC_MATRICULA.CURRVAL;
  if(numIn >  1)
   THEN UPDATE MATRICULA SET PRECIO=60 WHERE oid_M=seq;
  END IF;
  INSERTAR_PROFESOR('123456789','Virginia P�rez','01/03/1987','685811394','vir_2004@hotmail.com');
  INSERTAR_ASIGNATURA('LENGUAJE MUSICAL',SEC_PROFESOR.CURRVAL,SEC_MATRICULA.CURRVAL, SEC_ESPECIALIDAD.CURRVAL);
  INSERTAR_HORARIO('LUNES','01/01/2000 17:00:00',2);
  INSERTAR_POSEE(SEC_HORARIO.CURRVAL,SEC_ASIGNATURA.CURRVAL);
  
  INSERTAR_PROFESOR('123456789','Benito Vega','01/03/1987','685811394','benitoElputas@gmail.com');
  INSERTAR_ASIGNATURA('CORO',SEC_PROFESOR.CURRVAL,SEC_MATRICULA.CURRVAL, SEC_ESPECIALIDAD.CURRVAL);
  INSERTAR_HORARIO('MARTES','01/01/2000 17:00:00',1);
  INSERTAR_POSEE(SEC_HORARIO.CURRVAL,SEC_ASIGNATURA.CURRVAL);
   
  INSERTAR_PROFESOR('123456789','Amparo Vega Cabrera','01/03/1987','685811394','vegamparo@hotmail.com');
  INSERTAR_ASIGNATURA('INSTRUMENTO COLECTIVO',SEC_PROFESOR.CURRVAL,SEC_MATRICULA.CURRVAL, SEC_ESPECIALIDAD.CURRVAL);
  INSERTAR_HORARIO('MI�RCOLES','01/01/2000 17:00:00',1);
  INSERTAR_POSEE(SEC_HORARIO.CURRVAL,SEC_ASIGNATURA.CURRVAL);
  COMMIT WORK;
ELSIF(W_CURSO = 'PREPARATORIO 2')
  THEN INSERT INTO MATRICULA VALUES(SEC_MATRICULA.NEXTVAL,W_A�O,W_CURSO,40,W_ALUMNO);
    INSERTAR_ESPECIALIDAD(W_NOMBRE, W_ALUMNO);

   seq:= SEC_MATRICULA.CURRVAL;
  if(numIn >  1)
   THEN UPDATE MATRICULA SET PRECIO=60 WHERE oid_M=seq;
  END IF;
  INSERTAR_PROFESOR('123456789','Virginia P�rez','01/03/1987','685811394','vir_2004@hotmail.com');
  INSERTAR_ASIGNATURA('LENGUAJE MUSICAL',SEC_PROFESOR.CURRVAL,SEC_MATRICULA.CURRVAL, SEC_ESPECIALIDAD.CURRVAL);
  INSERTAR_HORARIO('LUNES','01/01/2000 19:00:00',2);
  INSERTAR_POSEE(SEC_HORARIO.CURRVAL,SEC_ASIGNATURA.CURRVAL);
  
  INSERTAR_PROFESOR('123456789','Benito Vega','01/03/1987','685811394','benitoElputas@gmail.com');
  INSERTAR_ASIGNATURA('CORO',SEC_PROFESOR.CURRVAL,SEC_MATRICULA.CURRVAL, SEC_ESPECIALIDAD.CURRVAL);
  INSERTAR_HORARIO('MARTES','01/01/2000 18:00:00',1);
  INSERTAR_POSEE(SEC_HORARIO.CURRVAL,SEC_ASIGNATURA.CURRVAL);
   
  INSERTAR_PROFESOR('123456789','Amparo Vega Cabrera','01/03/1987','685811394','vegamparo@hotmail.com');
  INSERTAR_ASIGNATURA('INSTRUMENTO COLECTIVO',SEC_PROFESOR.CURRVAL,SEC_MATRICULA.CURRVAL, SEC_ESPECIALIDAD.CURRVAL);
  INSERTAR_HORARIO('MI�RCOLES','01/01/2000 18:00:00',1);
  INSERTAR_POSEE(SEC_HORARIO.CURRVAL,SEC_ASIGNATURA.CURRVAL);
    
  COMMIT WORK;
ELSIF(W_CURSO = 'PRIMERO ELEMENTAL')
  THEN INSERT INTO MATRICULA VALUES(SEC_MATRICULA.NEXTVAL,W_A�O,W_CURSO,45,W_ALUMNO);
    INSERTAR_ESPECIALIDAD(W_NOMBRE, W_ALUMNO);

   seq:= SEC_MATRICULA.CURRVAL;
  if(numIn >  1)
   THEN UPDATE MATRICULA SET PRECIO=60 WHERE oid_M=seq;
  END IF;
  INSERTAR_PROFESOR('123456789','Virginia P�rez','01/03/1987','685811394','vir_2004@hotmail.com');
  INSERTAR_ASIGNATURA('LENGUAJE MUSICAL',SEC_PROFESOR.CURRVAL,SEC_MATRICULA.CURRVAL, SEC_ESPECIALIDAD.CURRVAL);
  INSERTAR_HORARIO('LUNES','01/01/2000 17:00:00',2);
  INSERTAR_POSEE(SEC_HORARIO.CURRVAL,SEC_ASIGNATURA.CURRVAL);
  
  INSERTAR_PROFESOR('123456789','Benito Vega','01/03/1987','685811394','benitoElputas@gmail.com');
  INSERTAR_ASIGNATURA('CORO',SEC_PROFESOR.CURRVAL,SEC_MATRICULA.CURRVAL, SEC_ESPECIALIDAD.CURRVAL);
  INSERTAR_HORARIO('MARTES','01/01/2000 17:00:00',1);
  INSERTAR_POSEE(SEC_HORARIO.CURRVAL,SEC_ASIGNATURA.CURRVAL);
   
  INSERTAR_PROFESOR('123456789','Amparo Vega Cabrera','01/03/1987','685811394','vegamparo@hotmail.com');
  INSERTAR_ASIGNATURA('INSTRUMENTO INDIVIDUAL',SEC_PROFESOR.CURRVAL,SEC_MATRICULA.CURRVAL, SEC_ESPECIALIDAD.CURRVAL);
  INSERTAR_HORARIO('MI�RCOLES','01/01/2000 17:00:00',1);
  INSERTAR_POSEE(SEC_HORARIO.CURRVAL,SEC_ASIGNATURA.CURRVAL);
  
  COMMIT WORK;
ELSIF(W_CURSO = 'SEGUNDO ELEMENTAL')
  THEN INSERT INTO MATRICULA VALUES(SEC_MATRICULA.NEXTVAL,W_A�O,W_CURSO,45,W_ALUMNO);
    INSERTAR_ESPECIALIDAD(W_NOMBRE, W_ALUMNO);

    seq:= SEC_MATRICULA.CURRVAL;
  if(numIn >  1)
   THEN UPDATE MATRICULA SET PRECIO=60 WHERE oid_M=seq;
  END IF;
  INSERTAR_PROFESOR('123456789','Virginia P�rez','01/03/1987','685811394','vir_2004@hotmail.com');
  INSERTAR_ASIGNATURA('LENGUAJE MUSICAL',SEC_PROFESOR.CURRVAL,SEC_MATRICULA.CURRVAL, SEC_ESPECIALIDAD.CURRVAL);
  INSERTAR_HORARIO('LUNES','01/01/2000 17:00:00',2);
  INSERTAR_POSEE(SEC_HORARIO.CURRVAL,SEC_ASIGNATURA.CURRVAL);
  
  INSERTAR_PROFESOR('123456789','Benito Vega','01/03/1987','685811394','benitoElputas@gmail.com');
  INSERTAR_ASIGNATURA('CORO',SEC_PROFESOR.CURRVAL,SEC_MATRICULA.CURRVAL, SEC_ESPECIALIDAD.CURRVAL);
  INSERTAR_HORARIO('MARTES','01/01/2000 17:00:00',1);
  INSERTAR_POSEE(SEC_HORARIO.CURRVAL,SEC_ASIGNATURA.CURRVAL);
   
  INSERTAR_PROFESOR('123456789','Amparo Vega Cabrera','01/03/1987','685811394','vegamparo@hotmail.com');
  INSERTAR_ASIGNATURA('INSTRUMENTO COLECTIVO',SEC_PROFESOR.CURRVAL,SEC_MATRICULA.CURRVAL, SEC_ESPECIALIDAD.CURRVAL);
  INSERTAR_HORARIO('MI�RCOLES','01/01/2000 17:00:00',1);
  INSERTAR_POSEE(SEC_HORARIO.CURRVAL,SEC_ASIGNATURA.CURRVAL);
  
  INSERTAR_PROFESOR('123456789','Virginia P�rez','01/03/1987','685811394','vegamparo@hotmail.com');
  INSERTAR_ASIGNATURA('BANDA',SEC_PROFESOR.CURRVAL,SEC_MATRICULA.CURRVAL, SEC_ESPECIALIDAD.CURRVAL);
  INSERTAR_HORARIO('VIERNES','01/01/2000 20:00:00',1);
  INSERTAR_POSEE(SEC_HORARIO.CURRVAL,SEC_ASIGNATURA.CURRVAL);
  COMMIT WORK;
 ELSIF(W_CURSO = 'TERCERO ELEMENTAL')
  THEN INSERT INTO MATRICULA VALUES(SEC_MATRICULA.NEXTVAL,W_A�O,W_CURSO,45,W_ALUMNO);
    INSERTAR_ESPECIALIDAD(W_NOMBRE, W_ALUMNO);

   seq:= SEC_MATRICULA.CURRVAL;
  if(numIn >  1)
   THEN UPDATE MATRICULA SET PRECIO=60 WHERE oid_M=seq;
  END IF;
  INSERTAR_PROFESOR('123456789','Cristina Guzm�n','01/03/1987','685811394','vir_2004@hotmail.com');
  INSERTAR_ASIGNATURA('LENGUAJE MUSICAL',SEC_PROFESOR.CURRVAL,SEC_MATRICULA.CURRVAL, SEC_ESPECIALIDAD.CURRVAL);
  INSERTAR_HORARIO('LUNES','01/01/2000 17:00:00',2);
  INSERTAR_POSEE(SEC_HORARIO.CURRVAL,SEC_ASIGNATURA.CURRVAL);
  
  INSERTAR_PROFESOR('123456789','Benito Vega','01/03/1987','685811394','benitoElputas@gmail.com');
  INSERTAR_ASIGNATURA('CORO',SEC_PROFESOR.CURRVAL,SEC_MATRICULA.CURRVAL, SEC_ESPECIALIDAD.CURRVAL);
  INSERTAR_HORARIO('MARTES','01/01/2000 17:00:00',1);
  INSERTAR_POSEE(SEC_HORARIO.CURRVAL,SEC_ASIGNATURA.CURRVAL);
   
  INSERTAR_PROFESOR('123456789','Amparo Vega Cabrera','01/03/1987','685811394','vegamparo@hotmail.com');
  INSERTAR_ASIGNATURA('INSTRUMENTO INDIVIDUAL',SEC_PROFESOR.CURRVAL,SEC_MATRICULA.CURRVAL, SEC_ESPECIALIDAD.CURRVAL);
  INSERTAR_HORARIO('MI�RCOLES','01/01/2000 17:00:00',0.50);
  INSERTAR_POSEE(SEC_HORARIO.CURRVAL,SEC_ASIGNATURA.CURRVAL);
  
  INSERTAR_PROFESOR('123456789','Virginia P�rez','01/03/1987','685811394','vegamparo@hotmail.com');
  INSERTAR_ASIGNATURA('BANDA',SEC_PROFESOR.CURRVAL,SEC_MATRICULA.CURRVAL, SEC_ESPECIALIDAD.CURRVAL);
  INSERTAR_HORARIO('VIERNES','01/01/2000 20:00:00',1);
  INSERTAR_POSEE(SEC_HORARIO.CURRVAL,SEC_ASIGNATURA.CURRVAL);
  
  INSERTAR_PROFESOR('123456789','Carlos Fern�ndez','01/03/1987','685811394','vegamparo@hotmail.com');
  INSERTAR_ASIGNATURA('BANDA',SEC_PROFESOR.CURRVAL,SEC_MATRICULA.CURRVAL, SEC_ESPECIALIDAD.CURRVAL);
  INSERTAR_HORARIO('VIERNES','01/01/2000 20:00:00',1);
  INSERTAR_POSEE(SEC_HORARIO.CURRVAL,SEC_ASIGNATURA.CURRVAL);
  COMMIT WORK;
ELSIF(W_CURSO = 'CUARTO ELEMENTAL')
  THEN INSERT INTO MATRICULA VALUES(SEC_MATRICULA.NEXTVAL,W_A�O,W_CURSO,45,W_ALUMNO);
    INSERTAR_ESPECIALIDAD(W_NOMBRE, W_ALUMNO);

   seq:= SEC_MATRICULA.CURRVAL;
  if(numIn >  1)
   THEN UPDATE MATRICULA SET PRECIO=60 WHERE oid_M=seq;
  END IF;
  INSERTAR_PROFESOR('123456789','Cristina Guzm�n','01/03/1987','685811394','vir_2004@hotmail.com');
  INSERTAR_ASIGNATURA('LENGUAJE MUSICAL',SEC_PROFESOR.CURRVAL,SEC_MATRICULA.CURRVAL, SEC_ESPECIALIDAD.CURRVAL);
  INSERTAR_HORARIO('LUNES','01/01/2000 17:00:00',2);
  INSERTAR_POSEE(SEC_HORARIO.CURRVAL,SEC_ASIGNATURA.CURRVAL);
  
  INSERTAR_PROFESOR('123456789','Benito Vega','01/03/1987','685811394','vir_2004@gmail.com');
  INSERTAR_ASIGNATURA('CORO',SEC_PROFESOR.CURRVAL,SEC_MATRICULA.CURRVAL, SEC_ESPECIALIDAD.CURRVAL);
  INSERTAR_HORARIO('MARTES','01/01/2000 17:00:00',1);
  INSERTAR_POSEE(SEC_HORARIO.CURRVAL,SEC_ASIGNATURA.CURRVAL);
   
  INSERTAR_PROFESOR('123456789','Amparo Vega Cabrera','01/03/1987','685811394','vegamparo@hotmail.com');
  INSERTAR_ASIGNATURA('INSTRUMENTO INDIVIDUAL',SEC_PROFESOR.CURRVAL,SEC_MATRICULA.CURRVAL, SEC_ESPECIALIDAD.CURRVAL);
  INSERTAR_HORARIO('MI�RCOLES','01/01/2000 17:00:00',0.75);
  INSERTAR_POSEE(SEC_HORARIO.CURRVAL,SEC_ASIGNATURA.CURRVAL);
  
  INSERTAR_PROFESOR('123456789','Virginia P�rez','01/03/1987','685811394','vegamparo@hotmail.com');
  INSERTAR_ASIGNATURA('BANDA',SEC_PROFESOR.CURRVAL,SEC_MATRICULA.CURRVAL, SEC_ESPECIALIDAD.CURRVAL);
  INSERTAR_HORARIO('VIERNES','01/01/2000 20:00:00',1);
  INSERTAR_POSEE(SEC_HORARIO.CURRVAL,SEC_ASIGNATURA.CURRVAL);
  
  INSERTAR_PROFESOR('123456789','Carlos Fern�ndez','01/03/1987','685811394','vegamparo@hotmail.com');
  INSERTAR_ASIGNATURA('BANDA',SEC_PROFESOR.CURRVAL,SEC_MATRICULA.CURRVAL, SEC_ESPECIALIDAD.CURRVAL);
  INSERTAR_HORARIO('VIERNES','01/01/2000 20:00:00',1);
  INSERTAR_POSEE(SEC_HORARIO.CURRVAL,SEC_ASIGNATURA.CURRVAL);
  COMMIT WORK;
ELSIF(W_CURSO = 'ADULTOS')
  THEN INSERT INTO MATRICULA VALUES(SEC_MATRICULA.NEXTVAL,W_A�O,W_CURSO,45,W_ALUMNO);
    INSERTAR_ESPECIALIDAD(W_NOMBRE, W_ALUMNO);

   seq:= SEC_MATRICULA.CURRVAL;
  if(numIn >  1)
   THEN UPDATE MATRICULA SET PRECIO=60 WHERE oid_M=seq;
  END IF;
  INSERTAR_PROFESOR('123456789','Virginia P�rez','01/03/1987','685811394','vegamparo@hotmail.com');
  INSERTAR_ASIGNATURA('BANDA',SEC_PROFESOR.CURRVAL,SEC_MATRICULA.CURRVAL, SEC_ESPECIALIDAD.CURRVAL);
  INSERTAR_HORARIO('VIERNES','01/01/2000 20:00:00',1);
  INSERTAR_POSEE(SEC_HORARIO.CURRVAL,SEC_ASIGNATURA.CURRVAL);
  
  INSERTAR_PROFESOR('123456789','Carlos Fern�ndez','01/03/1987','685811394','vegamparo@hotmail.com');
  INSERTAR_ASIGNATURA('BANDA',SEC_PROFESOR.CURRVAL,SEC_MATRICULA.CURRVAL, SEC_ESPECIALIDAD.CURRVAL);
  INSERTAR_HORARIO('VIERNES','01/01/2000 20:00:00',1);
  INSERTAR_POSEE(SEC_HORARIO.CURRVAL,SEC_ASIGNATURA.CURRVAL);
  COMMIT WORK;
ELSIF(W_CURSO = 'SOLO INSTRUMENTO')
  THEN INSERT INTO MATRICULA VALUES(SEC_MATRICULA.NEXTVAL,W_A�O,W_CURSO,45,W_ALUMNO);
    INSERTAR_ESPECIALIDAD(W_NOMBRE, W_ALUMNO);

  INSERTAR_PROFESOR('123456789','Virginia P�rez','01/03/1987','685811394','vegamparo@hotmail.com');
  INSERTAR_ASIGNATURA('LENGUAJE MUSICAL',SEC_PROFESOR.CURRVAL,SEC_MATRICULA.CURRVAL, SEC_ESPECIALIDAD.CURRVAL);
  INSERTAR_HORARIO('VIERNES','01/01/2000 20:00:00',1.50);
  INSERTAR_POSEE(SEC_HORARIO.CURRVAL,SEC_ASIGNATURA.CURRVAL);
  
  INSERTAR_PROFESOR('123456789','Carlos Fern�ndez','01/03/1987','685811394','vegamparo@hotmail.com');
  INSERTAR_ASIGNATURA('INSTRUMENTO INDIVIDUAL',SEC_PROFESOR.CURRVAL,SEC_MATRICULA.CURRVAL, SEC_ESPECIALIDAD.CURRVAL);
  INSERTAR_HORARIO('VIERNES','01/01/2000 20:00:00',1);
  INSERTAR_POSEE(SEC_HORARIO.CURRVAL,SEC_ASIGNATURA.CURRVAL);
  COMMIT WORK;
ELSE
  raise_application_error(-20600,'El curso introducido no es correcto');

END IF;



END INSERTAR_MATRICULA;

/

CREATE OR REPLACE PROCEDURE ACTUALIZAR_ALUMNO 
  (w_telefono PERSONA.TELEFONO%TYPE,
  w_email PERSONA.EMAIL%TYPE,
  w_oid_p PERSONA.OID_P%TYPE) AS
  A�O PERSONA.FECHA_NACIMIENTO%TYPE;
  var_edad ALUMNO.EDAD%TYPE;
  
BEGIN
  SELECT FECHA_NACIMIENTO INTO a�o FROM PERSONA WHERE oid_p=w_oid_p;
  SELECT TRUNC(MONTHS_BETWEEN(SYSDATE,A�O)/12) INTO var_edad FROM DUAL;
  UPDATE ALUMNO SET edad=var_edad WHERE oid_p=w_oid_p;
  UPDATE PERSONA SET telefono=w_telefono WHERE oid_p=w_oid_p;
  UPDATE PERSONA SET email=w_email WHERE oid_p=w_oid_p;
  
END ACTUALIZAR_ALUMNO;

/

CREATE OR REPLACE PROCEDURE ACTUALIZAR_PROFESOR
  (w_telefono PERSONA.TELEFONO%TYPE,
  w_email PERSONA.EMAIL%TYPE,
  w_oid_p PERSONA.OID_P%TYPE) AS
BEGIN
  UPDATE PERSONA SET telefono=w_telefono WHERE oid_p=w_oid_p;
  UPDATE PERSONA SET email=w_email WHERE oid_p=w_oid_p;
END ACTUALIZAR_PROFESOR;
/

CREATE OR REPLACE PROCEDURE ACTUALIZAR_TUTOR
  (w_telefono PERSONA.TELEFONO%TYPE,
  w_email PERSONA.EMAIL%TYPE,
  w_oid_p PERSONA.OID_P%TYPE) AS
BEGIN
  UPDATE PERSONA SET telefono=w_telefono WHERE oid_p=w_oid_p;
  UPDATE PERSONA SET email=w_email WHERE oid_p=w_oid_p;
END ACTUALIZAR_TUTOR;
/

CREATE OR REPLACE PROCEDURE ELIMINA_ALUMNO(
  w_oid_p     ALUMNO.OID_P%TYPE)
  AS
  BEGIN
  DELETE FROM TUTOR WHERE EXISTS(SELECT TUTOR FROM SE_RESPONSABILIZA_DE WHERE SE_RESPONSABILIZA_DE.ALUMNO = w_oid_p); 
  DELETE FROM ALUMNO WHERE(OID_P = w_oid_p);
END ELIMINA_ALUMNO;
  
/

CREATE OR REPLACE PROCEDURE ELIMINA_PROFESOR(
  w_oid_p      PROFESOR.OID_P%TYPE)
  AS
  w_oid_a      ASIGNATURA.OID_A%TYPE;
  BEGIN
  SELECT OID_A INTO w_oid_a FROM ASIGNATURA WHERE PROFESOR = w_oid_p;
  ELIMINA_ASIGNATURA(w_oid_a);
  UPDATE NOTA SET PROFESOR=NULL WHERE PROFESOR=w_oid_p;
  DELETE FROM ESPECIALIDAD WHERE EXISTS(SELECT ESPECIALIDAD FROM TIENE_ASIGNADO WHERE TIENE_ASIGNADO.PROFESOR = w_oid_p); 
  DELETE FROM PROFESOR WHERE (OID_P = w_oid_p);
  
END ELIMINA_PROFESOR;

/

CREATE OR REPLACE PROCEDURE ELIMINA_ESPECIALIDAD(
  w_oid_e         ESPECIALIDAD.OID_E%TYPE)
  AS
  BEGIN
    DELETE FROM ESPECIALIDAD WHERE OID_E = w_oid_e;
  END ELIMINA_ESPECIALIDAD;
  
/  

CREATE OR REPLACE PROCEDURE ELIMINA_TUTOR
  (w_oid_p PERSONA.OID_P%TYPE)AS
BEGIN
  DELETE FROM PERSONA WHERE oid_p=w_oid_p;
END ELIMINA_TUTOR;
/

CREATE OR REPLACE PROCEDURE ELIMINA_ASIGNATURA
  (w_oid_a ASIGNATURA.OID_A%TYPE)AS
BEGIN
  DELETE FROM HORARIO WHERE EXISTS
  (SELECT OID_H FROM POSEE WHERE oid_a=w_oid_a);
  DELETE FROM ASIGNATURA WHERE oid_a=w_oid_a;
END ELIMINA_ASIGNATURA;
/

/*--------------------------------------TRIGGERS-----------------------------*/

create or replace TRIGGER EDAD_MUSYMOV
  BEFORE 
  INSERT ON MATRICULA 
  FOR EACH ROW
DECLARE
  alumno INTEGER; 
  edad INTEGER;
BEGIN
  alumno:= :NEW.ALUMNO;
  SELECT EDAD INTO edad FROM ALUMNO WHERE ALUMNO.OID_P = alumno;
  
  IF (edad < 6 AND edad > 2 AND NOT (:NEW.CURSO LIKE 'MUSICA Y MOVIMIENTO%'))
    THEN raise_application_error(-20600, :NEW.CURSO || 'Un alumno entre 3 y 5 a�os tiene que estar matriculado en MUSICA EN MOVIMIENTO');
  END IF;
  
END EDAD_MUSYMOV;
/

create or replace TRIGGER RESTRICCION_MUSMOV
  BEFORE INSERT ON TIENE
  FOR EACH ROW
DECLARE
  var5 MATRICULA.CURSO%TYPE;
BEGIN
  SELECT MATRICULA.CURSO INTO var5 FROM MATRICULA WHERE MATRICULA.ALUMNO = :NEW.ALUMNO;
  
IF(var5 = 'MUSICA Y MOVIMIENTO 1' OR var5 = 'MUSICA Y MOVIMIENTO 2') THEN
     raise_application_error(-20600,:NEW.ALUMNO||'un alumno no puede tener un instrumento hasta que no curse M�SICA Y MOVIMIENTO 3');
  END IF;
END RESTRICCION_MUSMOV;
/

CREATE OR REPLACE TRIGGER RESTRICCION_PREP
  BEFORE INSERT ON MATRICULA
  FOR EACH ROW
DECLARE
  edad ALUMNO.EDAD%TYPE;
BEGIN
  SELECT EDAD INTO edad FROM ALUMNO WHERE :NEW.ALUMNO=OID_P;
  IF((edad>5 AND edad<8) AND NOT(:NEW.CURSO LIKE 'CURSO PREPARATORIO%'))
    THEN
    raise_application_error(-20600,'un alumno entre 6 y 7 a�os solo puede matricularse en CURSO PREPARATORIO');
  END IF;
END RESTRICCION_PREP;
/

create or replace TRIGGER RESTRICCION_ELEMEN
  BEFORE INSERT ON MATRICULA
  FOR EACH ROW
DECLARE
  edad ALUMNO.EDAD%TYPE;
BEGIN
  SELECT EDAD INTO edad FROM ALUMNO WHERE ALUMNO.OID_P=:NEW.ALUMNO;
  IF(:NEW.CURSO LIKE '%ELEMENTAL' AND NOT edad > 7)
    THEN
    raise_application_error(-20600,'solo pueden matricularse en GRADO ELEMENTAL aquellos alumnos con 8 a�os o m�s');
  END IF;
END RESTRICCION_ELEMEN;
/

CREATE OR REPLACE TRIGGER RESTRICCION_NUM_INSTRU
  BEFORE INSERT ON TIENE
  FOR EACH ROW
DECLARE
  numero INTEGER;
  edad ALUMNO.EDAD%TYPE;
BEGIN
  SELECT count(*) INTO numero FROM TIENE WHERE :NEW.ALUMNO=TIENE.ALUMNO;
  SELECT EDAD INTO edad FROM ALUMNO WHERE ALUMNO.OID_P=:NEW.ALUMNO;
  IF(numero > 0 AND edad < 8)
    THEN
    raise_application_error(-20600, 'un alumno menor de 7 a�os de edad no puede tocar m�s de un instrumento');
  END IF;
END RESTRICCION_NUM_INSTRU;
/

CREATE OR REPLACE TRIGGER RESTRICCION_ELEM_INSTR
  BEFORE INSERT ON MATRICULA
  FOR EACH ROW
DECLARE
  var1_curso MATRICULA.CURSO%TYPE := 'CUARTO ELEMENTAL';
  var2_curso MATRICULA.CURSO%TYPE := 'SOLO INSTRUMENTO';
  cursor c is select curso from matricula where matricula.alumno = :new.alumno;
  EXISTE BOOLEAN  := FALSE;
BEGIN
  IF(:NEW.CURSO = var2_curso) THEN 
  for c1 in c loop
    if(c1.curso=var1_curso)THEN
    EXISTE := TRUE;
  END IF;
  END LOOP;
  IF(EXISTE = FALSE)
  THEN  raise_application_error(-20600,:NEW.ALUMNO||'un alumno no puede matricularse en SOLO INSTRUMENTO hasta que no haya cursado CUARTO ELEMENTAL');
  END IF;
  END IF;
END RESTRICCION_ELEM_INSTR;
/

CREATE OR REPLACE TRIGGER RESTRICCION_EDAD_MATR
  BEFORE INSERT ON ALUMNO
  FOR EACH ROW
BEGIN
  IF(:NEW.EDAD < 3)
  THEN
    raise_application_error(-20600,'No puede matricularse un alumno menor de 3 a�os');
  END IF;
END RESTRICCION_EDAD_MATR;
/

CREATE OR REPLACE TRIGGER RESTRICCION_EDAD_PROF
  BEFORE INSERT ON PROFESOR
  FOR EACH ROW
DECLARE
  edad INTEGER;
  a�o DATE;
BEGIN
  SELECT FECHA_NACIMIENTO INTO a�o FROM PERSONA WHERE :NEW.OID_P=PERSONA.OID_P;
  SELECT TRUNC(MONTHS_BETWEEN(SYSDATE,a�o)/12) INTO edad FROM DUAL;
  IF(edad < 18)
    THEN
    raise_application_error(-20600,'un profesor debe ser mayor de edad');
  END IF;
END RESTRICCION_EDAD_PROF;
/

CREATE OR REPLACE TRIGGER RESTRICCION_NUM_MATRICULAS
  BEFORE INSERT ON MATRICULA
  FOR EACH ROW
DECLARE
  existe BOOLEAN := FALSE;
  cursor c is select A�O from MATRICULA where MATRICULA.ALUMNO = :NEW.ALUMNO;
BEGIN
  FOR c1 IN c LOOP
    IF(c1.A�O = :NEW.A�O) THEN
      existe := true;
    END IF;
  END LOOP;
  
  IF(EXISTE = TRUE) THEN
    raise_application_error(-20600,:NEW.ALUMNO||'Un alumno no puede tener dos matr�culas en el mismo a�o');
  END IF;
END RESTRICCION_NUM_MATRICULAS;
/

CREATE OR REPLACE TRIGGER RESTRICCION_MATRICULA_HECHA
  BEFORE INSERT ON MATRICULA
  FOR EACH ROW
DECLARE
  existe BOOLEAN := FALSE;
  cursor c is select CURSO from MATRICULA where MATRICULA.ALUMNO = :NEW.ALUMNO;
BEGIN

IF(:NEW.CURSO = 'MUSICA Y MOVIMIENTO 1') THEN
  FOR c1 IN c LOOP
    IF(c1.CURSO = 'MUSICA Y MOVIMIENTO 2' OR c1.CURSO = 'MUSICA Y MOVIMIENTO 3' OR c1.CURSO = 'PREPARATORIO 1'OR
    c1.CURSO = 'PREPARATORIO 2' OR c1.CURSO = 'PRIMERO ELEMENTAL'  OR c1.CURSO = 'SEGUNDO ELEMENTAL'  OR c1.CURSO = 'TERCERO ELEMENTAL' 
     OR c1.CURSO = 'CUARTO ELEMENTAL'  OR c1.CURSO = 'SOLO INSTRUMENTO'  OR c1.CURSO = 'SOLO ADULTOS') THEN
      existe := true;
    END IF;
  END LOOP;
ELSIF (:NEW.CURSO = 'MUSICA Y MOVIMIENTO 2') THEN
FOR c1 IN c LOOP
    IF(c1.CURSO = 'MUSICA Y MOVIMIENTO 3' OR c1.CURSO = 'PREPARATORIO 1'OR
    c1.CURSO = 'PREPARATORIO 2' OR c1.CURSO = 'PRIMERO ELEMENTAL'  OR c1.CURSO = 'SEGUNDO ELEMENTAL'  OR c1.CURSO = 'TERCERO ELEMENTAL' 
     OR c1.CURSO = 'CUARTO ELEMENTAL'  OR c1.CURSO = 'SOLO INSTRUMENTO'  OR c1.CURSO = 'SOLO ADULTOS') THEN
      existe := true;
    END IF;
  END LOOP;
ELSIF (:NEW.CURSO = 'MUSICA Y MOVIMIENTO 3') THEN
FOR c1 IN c LOOP
    IF( c1.CURSO = 'PREPARATORIO 1'OR
    c1.CURSO = 'PREPARATORIO 2' OR c1.CURSO = 'PRIMERO ELEMENTAL'  OR c1.CURSO = 'SEGUNDO ELEMENTAL'  OR c1.CURSO = 'TERCERO ELEMENTAL' 
     OR c1.CURSO = 'CUARTO ELEMENTAL'  OR c1.CURSO = 'SOLO INSTRUMENTO'  OR c1.CURSO = 'SOLO ADULTOS') THEN
      existe := true;
    END IF;
  END LOOP;
ELSIF (:NEW.CURSO = 'PREPARATORIO 1') THEN
FOR c1 IN c LOOP
    IF(
    c1.CURSO = 'PREPARATORIO 2' OR c1.CURSO = 'PRIMERO ELEMENTAL'  OR c1.CURSO = 'SEGUNDO ELEMENTAL'  OR c1.CURSO = 'TERCERO ELEMENTAL' 
     OR c1.CURSO = 'CUARTO ELEMENTAL'  OR c1.CURSO = 'SOLO INSTRUMENTO'  OR c1.CURSO = 'SOLO ADULTOS') THEN
      existe := true;
    END IF;
  END LOOP;
ELSIF (:NEW.CURSO = 'PREPARATORIO 2') THEN
FOR c1 IN c LOOP
    IF( c1.CURSO = 'PRIMERO ELEMENTAL'  OR c1.CURSO = 'SEGUNDO ELEMENTAL'  OR c1.CURSO = 'TERCERO ELEMENTAL' 
     OR c1.CURSO = 'CUARTO ELEMENTAL'  OR c1.CURSO = 'SOLO INSTRUMENTO'  OR c1.CURSO = 'SOLO ADULTOS') THEN
      existe := true;
    END IF;
  END LOOP;
ELSIF (:NEW.CURSO = 'PRIMERO ELEMENTAL') THEN
FOR c1 IN c LOOP
    IF( c1.CURSO = 'SEGUNDO ELEMENTAL'  OR c1.CURSO = 'TERCERO ELEMENTAL' 
     OR c1.CURSO = 'CUARTO ELEMENTAL'  OR c1.CURSO = 'SOLO INSTRUMENTO'  OR c1.CURSO = 'SOLO ADULTOS') THEN
      existe := true;
    END IF;
  END LOOP;
ELSIF (:NEW.CURSO = 'SEGUNDO ELEMENTAL') THEN
FOR c1 IN c LOOP
    IF(c1.CURSO = 'TERCERO ELEMENTAL' OR c1.CURSO = 'CUARTO ELEMENTAL'  OR c1.CURSO = 'SOLO INSTRUMENTO'  OR c1.CURSO = 'SOLO ADULTOS') THEN
      existe := true;
    END IF;
  END LOOP;
ELSIF (:NEW.CURSO = 'TERCERO ELEMENTAL') THEN
FOR c1 IN c LOOP
    IF(c1.CURSO = 'CUARTO ELEMENTAL'  OR c1.CURSO = 'SOLO INSTRUMENTO'  OR c1.CURSO = 'SOLO ADULTOS') THEN
      existe := true;
    END IF;
  END LOOP;
ELSIF (:NEW.CURSO = 'CUARTO ELEMENTAL') THEN
FOR c1 IN c LOOP
    IF(c1.CURSO = 'SOLO INSTRUMENTO'  OR c1.CURSO = 'SOLO ADULTOS') THEN
      existe := true;
    END IF;
  END LOOP;
END IF;
  IF(EXISTE = TRUE) THEN
    raise_application_error(-20600,:NEW.ALUMNO||'El alumno ya ha superado el curso en el que se intenta matricular.');
  END IF;

END RESTRICCION_MATRICULA_HECHA;
/

CREATE OR REPLACE TRIGGER RESTRICCION_MATRICULA_A�O
  BEFORE INSERT ON MATRICULA
  FOR EACH ROW
DECLARE
  existe BOOLEAN := FALSE;
  cursor c is select a�o from MATRICULA where MATRICULA.ALUMNO = :NEW.ALUMNO;
BEGIN

FOR c1 IN c LOOP
    IF(c1.a�o > :new.a�o) THEN
      existe := true;
    END IF;
  END LOOP;
  IF(EXISTE = TRUE) THEN
    raise_application_error(-20600,:NEW.ALUMNO||'No tienes un DeLorean.');  
  END IF;

END RESTRICCION_MATRICULA_A�O;
/

CREATE OR REPLACE TRIGGER HORARIOS_PROFESOR
  BEFORE INSERT ON POSEE FOR EACH ROW
DECLARE
  existe BOOLEAN := FALSE;
  cursor c is select oid_h from POSEE where POSEE.OID_A = :NEW.OID_A;
BEGIN

FOR c1 IN c LOOP
    IF(c1.oid_h = :new.oid_h) THEN
      existe := true;
    END IF;
  END LOOP;
 IF(EXISTE = TRUE) THEN
    raise_application_error(-20600,:NEW.oid_h||'Ese profesor ya tiene un horario asignado');  
  END IF;
  
END HORARIOS_PROFESOR;
/

CREATE OR REPLACE TRIGGER DNI_CORRECTO
  BEFORE INSERT ON PERSONA FOR EACH ROW  
DECLARE
  letras_validas CHAR(23) := 'TRWAGMYFPDXBNJZSQVHLCKE';
  loquequiera VARCHAR2(8) := substr(:NEW.DNI, 1, 8);
  var1 INTEGER := TO_NUMBER(loquequiera,'99999999');
  resto INTEGER;
  letra CHAR := substr(:NEW.DNI, 9, 1);
  letra_correcta CHAR;
BEGIN
  resto := var1 mod 23;
  letra_correcta := substr(letras_validas, resto+1, 1);
  IF(letra_correcta <> letra OR length(:NEW.DNI)<>9) THEN
    raise_application_error(-20600, :NEW.DNI || 'El D.N.I. introducido no es correcto');
  END IF;
  
END DNI_CORRECTO;
/

/*--------------------------------------FUNCIONES-----------------------------*/
CREATE OR REPLACE FUNCTION ASSERT_EQUALS(salida BOOLEAN, salida_esperada BOOLEAN)
RETURN VARCHAR2 AS
BEGIN
  IF (salida = salida_esperada) THEN
    return 'EXITO';
  ELSE
    return 'FALLO';
  END IF;
END ASSERT_EQUALS;
/
	
-->
</textarea>
			
		</div>
</div>
	</body>
</html>