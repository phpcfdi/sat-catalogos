# PhpCfdi/SatCatalogos To Do List

- Poner docblocks en las clases a las que se tiene acceso

- Documentar cómo se interpretan los catálogos y los catálogos especiales

- Agregar catálogo PatenteAduanal (catálogo simple)

- Agregar catálogo TipoComprobante (catálogo simple, se omitirán los valores raros en tipo N - Nómina)

- Reorganizar el proyecto
    - Mover las interfaces, abstracts y traits. La única clase de primer nivel debe ser SatCatalogos
    - Mover los value object (objeto de entidad) a un nivel más abajo

- SatCatalogos no debe exponer el Repository.

- SatCatalogos no debe recibir el Repository,
  crear mejor una clase heredada en entorno de pruebas. 

- Revisar el resultado del issue https://github.com/phpstan/phpstan/issues/1065
  y modificar el código

- Agregar funciones especiales como por ejemplo, buscar productos por palabras similares
  Por ejemplo, ver la implementación de devolución de objetos en ReglasTasaCuota
