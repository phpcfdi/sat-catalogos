# `phpcfdi/sat-catalogos` lista de tareas pendientes

## Catálogos disponibles aún no implementados

- Catálogos del Complemento de Pagos.

- Catálogos del Complemento de Comercio Exterior.

## Tareas pendientes

- Verificar que todas las propiedades de los catálogos implementados se están exponiendo en sus clases.

- Poner phpdoc en las clases a las que se tiene acceso.

- Poner phpdoc a metodos tal como en `ProductosServicios`.

- Separar las clases de catálogos de las clases de entradas.

- Documentar cómo se interpretan los catálogos y los catálogos especiales.

- Revisar el resultado del issue https://github.com/phpstan/phpstan/issues/1065 y modificar el código.

- Agregar funciones especiales como buscar productos por palabras similares.
  Por ejemplo, ver la implementación de devolución de objetos en ReglasTasaCuota.

## Ideas a discutir

- Mover las interfaces, abstracts y traits. La única clase de primer nivel debe ser SatCatalogos.

- Mover los value object (objeto de entidad) a un nivel más abajo.

