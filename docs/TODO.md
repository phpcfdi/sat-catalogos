# PhpCfdi/SatCatalogos To Do List

- Reorganizar el proyecto
    - FormaDePagoBuilder debería estar en Helpers
    - La única clase de primer nivel debe ser SatCatalogos

- SatCatalogos no debe exponer el Repository.

- SatCatalogos no debe recibir el Repository,
  crear mejor una clase heredada para poderlo manipular
  en entorno de desarrollo. 

- Revisar el resultado del issue https://github.com/phpstan/phpstan/issues/1065
  y modificar el código
