# Botón del escritorio: abrir Escuelita EduClub + iniciar XAMPP

Guía para crear en otra computadora un acceso directo en el escritorio que, al hacer doble clic, inicia Apache y MySQL (XAMPP) y abre la página del proyecto.

---

## Qué hace el botón

1. Revisa si **Apache** (puerto 80) ya está corriendo; si no, lo inicia.
2. Revisa si **MySQL** (puerto 3306) ya está corriendo; si no, lo inicia.
3. Espera unos segundos a que los servicios estén listos.
4. Abre en el navegador la página:

```
http://localhost/xampp/Escuelita_educlub/public
```

> Si los servicios ya estaban encendidos, el botón solo abre la página (no intenta iniciarlos de nuevo).

---

## Pasos para crear el botón

### 1. Verificar la ruta del proyecto

El proyecto debe estar en:

```
C:\xampp\htdocs\xampp\Escuelita_educlub
```

Si la ruta cambia en la otra computadora, ajusta la URL del paso 3 y las rutas de XAMPP del paso 2.

### 2. Crear el archivo `.bat` en el escritorio

En el escritorio crea un archivo de texto llamado:

```
Abrir Escuelita EduClub.bat
```

> Cámbiale la extensión de `.txt` a `.bat`. Si no ves las extensiones, actívalas desde el Explorador → Ver → "Extensiones de nombre de archivo".

### 3. Pegar este contenido

```bat
@echo off
title Abrir Escuelita EduClub
color 0A
echo ==============================================
echo  Escuelita EduClub
echo ==============================================

netstat -ano | findstr ":80 " | findstr "LISTENING" >nul 2>&1
if not errorlevel 1 (
    echo  - Apache ya esta en ejecucion.
) else (
    echo  - Iniciando Apache...
    start "" /min "C:\xampp\apache\bin\httpd.exe"
)

netstat -ano | findstr ":3306 " | findstr "LISTENING" >nul 2>&1
if not errorlevel 1 (
    echo  - MySQL ya esta en ejecucion.
) else (
    echo  - Iniciando MySQL...
    start "" /min "C:\xampp\mysql\bin\mysqld.exe" --defaults-file="C:\xampp\mysql\bin\my.ini" --standalone
)

echo Esperando a que los servicios esten listos...
timeout /t 8 /nobreak >nul

echo Abriendo la aplicacion...
start "" "http://localhost/xampp/Escuelita_educlub/public"
echo.
echo Listo! Puedes cerrar esta ventana.
exit
```

### 4. Guardar y probar

- Guarda el archivo y haz doble clic en él.
- Verás una ventana con el estado y se abrirá la página en el navegador.
- La ventana se puede cerrar con normalidad; **no afecta** a Apache ni MySQL (se inician como procesos separados).

---

## Cómo apagar XAMPP

Para detener los servicios usa el apagado oficial (no cierres a la fuerza):

```
C:\xampp\xampp_stop.exe
```

---

## Notas útiles

- **MySQL** se inicia con su archivo de configuración `my.ini` (`--standalone`), igual que hace `mysql_start.bat`.
- El aviso `Using unique option prefix 'key_buffer' ...` es una advertencia inofensiva de MySQL.
- Si Apache ya está instalado como servicio de Windows, puedes sustituir el inicio por `net start Apache2.4` y `net start mysql`.
- Para que el botón tenga un icono bonito, crea un acceso directo (.lnk) apuntando al `.bat` y cambia su icono desde Propiedades.