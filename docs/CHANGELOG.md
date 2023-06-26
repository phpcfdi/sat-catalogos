# CHANGELOG

## Acerca de SemVer

Usamos [Versionado Semántico 2.0.0](SEMVER.md) por lo que puedes usar esta librería sin temor a romper tu aplicación.

## Cambios no liberados en una versión

Pueden aparecer cambios no liberados que se integran a la rama principal pero no ameritan una nueva liberación de
versión aunque sí su incorporación en la rama principal de trabajo, generalmente se tratan de cambios en el desarrollo.

## Listado de cambios

### Mantenimimento 2023-06-26

- Actualizar archivo de licencia.
- Se corrige la insignia de construcción.

### Versión 0.3.0

Se integraron los catálogos de CFDI 4.0, gracias al esfuerzo de @AndreyPootMay.

Se mejoró y garantizó el control de tipos de datos leídos desde los catálogos
y utilizados para generar los objetos específicos.

Se actualizaron las dependencias de desarrollo y ahora se utiliza Phive para gestionarlas.
De igual forma, se hicieron muchos otros cambios al entorno de desarrollo para mejorar
el flujo de trabajo de GitHub y las herramientas de desarrollo.


### Versión 0.2.0

Se integraron los catálogos de Nómina, gracias al esfuerzo de @AndreyPootMay.

Se cambió la clase de entrada `SatCatalogos` para que los métodos no necesiten tener
exactamente el mismo nombre que sus clases.

Se agrega GitHub Actions y se deja de usar Travis-CI. ¡Gracias Travis!

Cambios al código en la rama principal desde 2021-01-13:

- Se incrementa el testeo sobre `HusoHorario` cuando no se le pasa un input de fecha correcta.
- Se devuelve una fecha con la zona horaria default del sistema cuando el huso horario carece de definición.
- Se incrementa el testeo agregando casos especiales y nuevos a:
  `PhpCfdi\SatCatalogos\Factory` y `PhpCfdi\SatCatalogos\Repository`.

Cambios al entorno de desarrollo en la rama principal desde 2021-01-13:

- Incluir PHP 8.0 en la matriz de construcción.
- Actualización del año en la licencia, feliz 2021 desde PhpCfdi.
- Agregar archivo `docs/SEMVER.md`.
- Versiones en español del código de conducta, guía de contribución, lista de tareas pendientes, versionado, etc.  
- Actualizar a PHPUnit 9.0
- Travis-CI: Actualización de composer, mejorar la instalación de dependencias, corregir la tubería de construcción.
- Scrutinizer: Actualizar comando de instalación de dependencias en composer
