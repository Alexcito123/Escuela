# Botón del escritorio: abrir Escuelita EduClub

Guía para abrir la aplicación local desde un acceso directo del escritorio.

---

## Qué hace el botón

1. Revisa si Laravel (puerto 8000) ya está corriendo; si no, lo inicia con PHP 8.2.
2. Espera unos segundos a que el servidor esté listo.
3. Abre en el navegador la página:

```
http://127.0.0.1:8000
```

> Si el servidor ya estaba encendido, el botón solo abre la página.

---

## Pasos para crear el botón

### 1. Verificar la ruta del proyecto

El proyecto está instalado en:

```
C:\xampp\htdocs\xampp\Educlub
```

Si la ruta cambia, ajusta las variables `PROJECT` y `PHP` del archivo `.bat`.

### 2. Crear el archivo `.bat` en el escritorio

En el escritorio crea un archivo de texto llamado:

```
Abrir Escuelita EduClub.bat
```

El archivo ya fue creado en el Escritorio. Si se crea manualmente, usa la extensión `.bat`.

### 3. Pegar este contenido

El archivo del Escritorio inicia `php artisan serve` desde `C:\xampp\htdocs\xampp\Educlub` usando PHP 8.2 y abre `http://127.0.0.1:8000`.

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

- La aplicación usa SQLite, por lo que no necesita MySQL para funcionar.
- Laravel 12 requiere PHP 8.2 o superior; no uses el PHP 8.0 de XAMPP para iniciar esta aplicación.
- Para detener el servidor, cierra la ventana minimizada de Laravel o termina el proceso `php artisan serve`.
- Para que el botón tenga un icono bonito, crea un acceso directo (.lnk) apuntando al `.bat` y cambia su icono desde Propiedades.