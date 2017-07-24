## Proyecto EMERGENTE

Proyecto para empresa de arquitectura 

**Tiempo estimado: ** 1 mes y 15 dias

### Como descargar este proyecto

Primero que todo debemos abrir la consola de git o de window y movernos desde la misma hacia el directorio en donde queremos rescargarlo con el comando `cd`

** Ejemplo **

```markdown
$ cd c:/xampp/htdocs/
```

** Nota: se recomienda usar la consola de git ya hay comandos de git que la consola de windows no reconoce **

El siguiente paso, despues de habernos movido con la consola hacia el directorio deseado, seria descargar el proyecto con el comando `git clone [url]`, la url la obtendremos desde la pestaña de fondo verde Clone or donwload

** Comando para clonar el proyecto **

```markdown
$ git clone https://github.com/JeshuaOfficial/DeveloperSpace.git master
```


Primero que todo debemos movernos hacia el directorio 

### Como subir a github con git

** Nota: para poder realizar estos pasos primero debemos movernos hacia el directorio del proyecto con la consola de git o de windows y haberlo descargado anteriormente desde este repositorio **

Para poder subir el proyecto desde local a git se deben seguir los siguientes comandos

**Paso 1:** Revisamos el estado de los archivos con `git status` para poder ver los cambios que realizamos, lo pintado en fondo rojo son los archivos en los cuales se realizaron cambios.

```markdown
$ git status
```

**Paso 2:** Preparamos los archivos con el comando `git add .` ó `git add -A` para ser agregados a un commit.

```markdown
$ git commit .

// Alternativo
$ git commit -A
```

**Paso 3:** Añadimos el archivo a un commit con el comando `git commit -m "descripcion"`, lo cual es necesario cada vez que se suba un cambio al repositorio

```markdown
$ git commit -m "Inicios del proyecto"
```

**Paso 4:** Por último quedaria solo subir el commit realizado hacia el repositorio con el comando `git push [url] master`, en este caso [url] la obtenemos en la pestaña "Clone or donwload" del repositorio

```markdown
$ git push https://github.com/JeshuaOfficial/DeveloperSpace.git master
```