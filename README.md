# PhpCfdi/SatCatalogos

[![Source Code][badge-source]][source]
[![Latest Version][badge-release]][release]
[![Software License][badge-license]][license]
[![Build Status][badge-build]][build]
[![Scrutinizer][badge-quality]][quality]
[![Coverage Status][badge-coverage]][coverage]
[![Total Downloads][badge-downloads]][downloads]
[![SensioLabsInsight][badge-sensiolabs]][sensiolabs]

> Catálogos de SAT para CFDI 3.3 (spanish)

Esta librería permite usar los catálogos del SAT para CFDI version 3.3 publicados en
[http://www.sat.gob.mx/informacion_fiscal/factura_electronica/Paginas/Anexo_20_version3.3.aspx].

Los catálogos no solo son los que se publican directamente para CFDI, también están los catálogos de los complementos
y los complementos de conceptos.

Consulte el [wiki][] para mayor información.


## Instalación

Use [composer](https://getcomposer.org/), so please run
```shell
composer require phpcfdi/satcatalogos
```


## Uso básico

```php
<?php
$satCatalogos = new \PhpCfdi\SatCatalogos\SatCatalogos();
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

Esta librería es compatible con PHP versions 7.1 y superior.
Por favor, intente usar el mayor potencial del lenguaje.
La librería intenta seguir la compatibilidad de versiones con Debian/GNU Linux versión estable.


## Colaborar con este proyecto

¡Sus colaboraciones son bienvenidas!
Por favor, lea el documento [CONTRIBUTING][] (en inglés) para más detalles.
No olvide leer también la documentación de [TODO][] y el archivo de [CHANGELOG][].


## Licencia y derechos de autor

La librería PhpCfdi/SatCatalogos tiene copyright © [Carlos C Soto](http://eclipxe.com.mx)
y está publicada bajo la licencia MIT License (MIT). Lea el archivo [LICENSE][] para mayor información.

The PhpCfdi/SatCatalogos library is copyright © [Carlos C Soto](http://eclipxe.com.mx)
and licensed for use under the MIT License (MIT). Please see [LICENSE][] for more information.


[contributing]: https://github.com/phpCfdi/SatCatalogos/blob/master/CONTRIBUTING.md
[changelog]: https://github.com/phpCfdi/SatCatalogos/blob/master/docs/CHANGELOG.md
[todo]: https://github.com/phpCfdi/SatCatalogos/blob/master/docs/TODO.md

[wiki]: https://github.com/phpCfdi/SatCatalogos/wiki
[source]: https://github.com/phpCfdi/SatCatalogos
[release]: https://github.com/phpCfdi/SatCatalogos/releases
[license]: https://github.com/phpCfdi/SatCatalogos/blob/master/LICENSE
[build]: https://travis-ci.org/phpCfdi/SatCatalogos?branch=master
[quality]: https://scrutinizer-ci.com/g/phpCfdi/SatCatalogos/
[sensiolabs]: https://insight.sensiolabs.com/projects/:INSIGHT_UUID
[coverage]: https://scrutinizer-ci.com/g/phpCfdi/SatCatalogos/code-structure/master/code-coverage
[downloads]: https://packagist.org/packages/PhpCfdi/SatCatalogos

[badge-source]: http://img.shields.io/badge/source-phpCfdi/SatCatalogos-blue.svg?style=flat-square
[badge-release]: https://img.shields.io/github/release/phpCfdi/SatCatalogos.svg?style=flat-square
[badge-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[badge-build]: https://img.shields.io/travis/phpCfdi/SatCatalogos/master.svg?style=flat-square
[badge-quality]: https://img.shields.io/scrutinizer/g/phpCfdi/SatCatalogos/master.svg?style=flat-square
[badge-sensiolabs]: https://insight.sensiolabs.com/projects/:INSIGHT_UUID/mini.png
[badge-coverage]: https://img.shields.io/scrutinizer/coverage/g/phpCfdi/SatCatalogos/master.svg?style=flat-square
[badge-downloads]: https://img.shields.io/packagist/dt/PhpCfdi/SatCatalogos.svg?style=flat-square
