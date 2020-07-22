# phpcfdi/sat-catalogos

[![Source Code][badge-source]][source]
[![Latest Version][badge-release]][release]
[![Software License][badge-license]][license]
[![Build Status][badge-build]][build]
[![Scrutinizer][badge-quality]][quality]
[![Coverage Status][badge-coverage]][coverage]
[![Total Downloads][badge-downloads]][downloads]

> Catálogos de SAT para CFDI 3.3

Esta librería permite usar los catálogos del SAT para CFDI version 3.3 publicados en
<http://omawww.sat.gob.mx/tramitesyservicios/Paginas/anexo_20_version3-3.htm>.

Los catálogos no solo son los que se publican directamente para CFDI, también están los catálogos de los complementos
y los complementos de conceptos.

Consulte el [wiki][] para mayor información.

## Instalación

Utiliza composer [composer](https://getcomposer.org/):

```shell
composer require phpcfdi/sat-catalogos
```

También vas a requerir la base de datos relacionada con los catálogos, que puedes obtener
desde el proyecto [phpcfdi/resources-sat-catalogs](https://github.com/phpcfdi/resources-sat-catalogs).

## Uso básico

```php
<?php
$dsn = sprintf('sqlite://%s/catalogos.db', __DIR__);
$factory = new \PhpCfdi\SatCatalogos\Factory();
$satCatalogos = $factory->catalogosFromDsn($dsn);
$aduanas = $satCatalogos->aduanas();
$aduana = $aduanas->obtain('24');
echo $aduana->texto(); // NUEVO LAREDO, NUEVO LAREDO, TAMAULIPAS.
```

## Acerca de los catálogos y las entradas de los mismos

**Si usted sabe de algún cambio en los catálogos del SAT (CFDI, complementos o complemento de concepto) y
el cambio no se encuentra publicado por favor abra un nuevo Issue describiendo lo encontrado**

Los catálogos en realidad son objetos que permiten obtener entradas.
Hay catálogos cuyas entradas con mínimas, pero hay catálogos que tienen miles de registros.
Por eso los catálogos son almacenados en una base de datos de sqlite.

Usted no debe modificar la base de datos de sqlite, esto equivale a modificar el código fuente.

Esta librería no contiene métodos para manipular la base de datos. Para esta librería la base de datos es simplemente
un repositorio de datos de lectura. Bien podría tratarse de datos en formato JSON, sin embargo al desarrolar la
aplicación no encontramos una forma ágil y de pocos recursos para leer en un formato diferente.

Esta librería incrementará de versión siguiendo el concepto de *semantic versioning* en donde:

- Se modifica la versión mayor si hay un cambio en la API que requiere que usted tenga que cambiar el código fuente.
- También se hacen cambios mayores si la estructura de los datos publicados por el SAT cambia dramáticamente.
- Se modifica la versión menor si hay un cambio en la API que es compatible con versiones anteriores, como por ejemplo,
  que se agregue un nuevo catálogo o se agregue un nuevo campo a un catálogo existente.
- Se modifica la versión menor cuando hay alguna corrección o bien hay una nueva publicación de los catálogos que
  respeta la estructura existente.
- Es probable que, en una nueva versión no cambie el código fuente pero sí el archivo de base de datos donde
  se almacenan los catálogos

## Actualización automatizada de catálogos

La actualización de los catálogos está fuera de los límites de esta librería.
La tarea de actualizar los catálogos estará en otro proyecto separado que:
- Revise periódicamente si las ligas de publicación de los catálogos no han cambiado.
    - Si cambiaron deberá generar una incidencia.
    - Si no han cambiado reportar sin cambios.
- Revise periódicamente si existe una nueva versión de los catálogos.
- Si hay un nuevo origen de datos con una versión diferente a la almacenada entonces
    - Reportar los cambios
    - Si el origen no es automatizable entonces se deberá generar una incidencia
    - Si el origen es automatizable entonces deberá proceder a actualizar
- Si al intentar actualizar
    - La estructura es la misma y los datos son los mismos, reportar sin cambios.
    - La estructura es la misma y los datos cambiarion, reportar los cambios.
    - La estructura cambió, generar una incidencia.
 
## Soporte de PHP

Esta librería es compatible con PHP versions 7.3 y superior.
Por favor, intente usar el mayor potencial del lenguaje.
La librería intenta seguir la compatibilidad de versiones con Debian/GNU Linux versión estable.

## Colaborar con este proyecto

¡Sus colaboraciones son bienvenidas!
Por favor, lea el documento [CONTRIBUTING][] (en inglés) para más detalles.
No olvide leer también la documentación de [TODO][] y el archivo de [CHANGELOG][].

## Licencia y derechos de autor

La librería `phpcfdi/sat-catalogos` tiene copyright © [PhpCfdi](https://www.phpcfdi.com)
y está publicada bajo la licencia MIT License (MIT). Lea el archivo [LICENSE][] para mayor información.

The `phpcfdi/sat-catalogos` library is copyright © [PhpCfdi](https://www.phpcfdi.com)
and licensed for use under the MIT License (MIT). Please see [LICENSE][] for more information.

[contributing]: https://github.com/phpcfdi/sat-catalogos/blob/master/CONTRIBUTING.md
[changelog]: https://github.com/phpcfdi/sat-catalogos/blob/master/docs/CHANGELOG.md
[todo]: https://github.com/phpcfdi/sat-catalogos/blob/master/docs/TODO.md

[wiki]: https://github.com/phpcfdi/sat-catalogos/wiki
[source]: https://github.com/phpcfdi/sat-catalogos
[release]: https://github.com/phpcfdi/sat-catalogos/releases
[license]: https://github.com/phpcfdi/sat-catalogos/blob/master/LICENSE
[build]: https://travis-ci.com/phpcfdi/sat-catalogos?branch=master
[quality]: https://scrutinizer-ci.com/g/phpcfdi/sat-catalogos/
[coverage]: https://scrutinizer-ci.com/g/phpcfdi/sat-catalogos/code-structure/master/code-coverage
[downloads]: https://packagist.org/packages/phpcfdi/sat-catalogos

[badge-source]: https://img.shields.io/badge/source-phpcfdi/sat--catalogos-blue?style=flat-square
[badge-release]: https://img.shields.io/github/release/phpcfdi/sat-catalogos?style=flat-square
[badge-license]: https://img.shields.io/github/license/phpcfdi/sat-catalogos?style=flat-square
[badge-build]: https://img.shields.io/travis/com/phpcfdi/sat-catalogos/master?style=flat-square
[badge-quality]: https://img.shields.io/scrutinizer/g/phpcfdi/sat-catalogos/master?style=flat-square
[badge-coverage]: https://img.shields.io/scrutinizer/coverage/g/phpCfdi/sat-catalogos/master?style=flat-square
[badge-downloads]: https://img.shields.io/packagist/dt/PhpCfdi/sat-catalogos?style=flat-square
