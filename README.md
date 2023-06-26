# phpcfdi/sat-catalogos

[![Source Code][badge-source]][source]
[![Latest Version][badge-release]][release]
[![Software License][badge-license]][license]
[![Build Status][badge-build]][build]
[![Scrutinizer][badge-quality]][quality]
[![Coverage Status][badge-coverage]][coverage]
[![Total Downloads][badge-downloads]][downloads]

> Catálogos de SAT para CFDI 3.3, CFDI 4.0 y Nómina 1.2.

Esta librería permite usar los catálogos del SAT para:
  - CFDI 3.3.
  - CFDI 4.0.
  - Nómina 1.2.

Vea la [Información general de catálogos](docs/Catalogos.md) para mayor información.

## Instalación

Utiliza composer [composer](https://getcomposer.org/):

```shell
composer require phpcfdi/sat-catalogos
```

También vas a requerir la base de datos relacionada con los catálogos, que puedes obtener
desde el proyecto [phpcfdi/resources-sat-catalogs](https://github.com/phpcfdi/resources-sat-catalogs).
O ejecutando desde Linux o MAC o MS Windows con WSL:

```shell
bash bin/create-catalogs-database catalogs.db
```

## Uso básico

```php
<?php
declare(strict_types=1);

use PhpCfdi\SatCatalogos\Factory;

$dsn = sprintf('sqlite://%s/catalogos.db', __DIR__);
$factory = new Factory();
$satCatalogos = $factory->catalogosFromDsn($dsn);

$aduanas = $satCatalogos->aduanas();
$aduana = $aduanas->obtain('24');
echo $aduana->texto(); // NUEVO LAREDO, NUEVO LAREDO, TAMAULIPAS.
```

## Acerca de los catálogos y las entradas de los mismos

**Si usted sabe de algún cambio en los catálogos del SAT (CFDI, complementos o complemento de concepto) y
el cambio no se encuentra publicado por favor abra un nuevo Issue describiendo lo encontrado**

Los catálogos en realidad son objetos que permiten obtener entradas.
Hay catálogos cuyas entradas son mínimas, pero hay catálogos que tienen miles de registros.

Usted no debería modificar la base de datos, esto equivale a modificar el código fuente.

Esta librería no contiene métodos para manipular la base de datos.
La base de datos es simplemente un repositorio de datos de lectura.
Bien podría tratarse de datos en formato JSON, sin embargo, al desarrollar la librería
no encontramos una forma ágil y de pocos recursos para leer en un formato diferente.

## Versionado de la librería

Esta librería incrementará de versión siguiendo el concepto de *semantic versioning* en donde:

- Se modifica la versión mayor si hay un cambio en la API que requiere que usted tenga que cambiar el código fuente.
- También se hacen cambios mayores si la estructura de los datos publicados por el SAT cambia dramáticamente.
- Se modifica la versión menor si hay un cambio en la API que es compatible con versiones anteriores, como por ejemplo,
  que se agregue un nuevo catálogo o se agregue un nuevo campo a un catálogo ya existente.
- Se modifica la versión menor cuando hay alguna corrección.

## Actualización automatizada de catálogos

La actualización de los catálogos desde el SAT está fuera de los límites de esta librería.

El repositorio [phpcfdi/resources-sat-catalogs](https://github.com/phpcfdi/resources-sat-catalogs)
contiene la información necesaria para que esta librería pueda trabajar.

A su vez, [phpcfdi/sat-catalogos-populate](https://github.com/phpcfdi/sat-catalogos-populate)
es la herramienta que utilizamos para mantener el recurso actualizado.

Para más información visita [PhpCfdi / Repositorios de recursos](https://www.phpcfdi.com/recursos/).

Se puede utilizar el script `bin/create-catalogs-database` para automatizar esta tarea.

## Soporte

Puedes obtener soporte abriendo un ticket en Github.

Adicionalmente, esta librería pertenece a la comunidad [PhpCfdi](https://www.phpcfdi.com), así que puedes usar los
mismos canales de comunicación para obtener ayuda de algún miembro de la comunidad.

## Compatibilidad

Esta librería se mantendrá compatible con al menos la versión con
[soporte activo de PHP](https://www.php.net/supported-versions.php) más reciente.

También utilizamos [Versionado Semántico 2.0.0](docs/SEMVER.md)
por lo que puedes usar esta librería sin temor a romper tu aplicación.

## Contribuciones

Las contribuciones son bienvenidas. Por favor lee [CONTRIBUTING][] para más detalles
y recuerda revisar el archivo de tareas pendientes [TODO][] y el archivo [CHANGELOG][].

## Copyright and License

The `phpcfdi/catalogos` library is copyright © [PhpCfdi](https://www.phpcfdi.com)
and licensed for use under the MIT License (MIT). Please see [LICENSE][] for more information.

[contributing]: https://github.com/phpcfdi/sat-catalogos/blob/master/CONTRIBUTING.md
[changelog]: https://github.com/phpcfdi/sat-catalogos/blob/master/docs/CHANGELOG.md
[todo]: https://github.com/phpcfdi/sat-catalogos/blob/master/docs/TODO.md

[source]: https://github.com/phpcfdi/sat-catalogos
[release]: https://github.com/phpcfdi/sat-catalogos/releases
[license]: https://github.com/phpcfdi/sat-catalogos/blob/master/LICENSE
[build]: https://github.com/phpcfdi/sat-catalogos/actions/workflows/build.yml?query=branch:master
[quality]: https://scrutinizer-ci.com/g/phpcfdi/sat-catalogos/
[coverage]: https://scrutinizer-ci.com/g/phpcfdi/sat-catalogos/code-structure/master/code-coverage
[downloads]: https://packagist.org/packages/phpcfdi/sat-catalogos

[badge-source]: https://img.shields.io/badge/source-phpcfdi/sat--catalogos-blue?style=flat-square
[badge-release]: https://img.shields.io/github/release/phpcfdi/sat-catalogos?style=flat-square
[badge-license]: https://img.shields.io/github/license/phpcfdi/sat-catalogos?style=flat-square
[badge-build]: https://img.shields.io/github/actions/workflow/status/phpcfdi/sat-catalogos/build.yml?branch=master&style=flat-square
[badge-quality]: https://img.shields.io/scrutinizer/g/phpcfdi/sat-catalogos/master?style=flat-square
[badge-coverage]: https://img.shields.io/scrutinizer/coverage/g/phpcfdi/sat-catalogos/master?style=flat-square
[badge-downloads]: https://img.shields.io/packagist/dt/phpcfdi/sat-catalogos?style=flat-square
