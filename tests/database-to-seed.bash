#!/usr/bin/env bash

#
# Command: database-to-seed <database.sql>
# Example: bash tests/database-to-seed.bash catalogos.sqlite3 > tests/database-seed.sql
# Extract from a catalogs database the whole structure and the INSERT INTO commands
# to create a dump that can be used to seed a memory database **for testing**
#


if [ -z "$1" ]; then
    echo "Set the database location as first and only argument" 1>&2
    exit 1
elif [ ! -f "$1" ]; then
    echo "Set the database file $1 does not exists" 1>&2
    exit 1
fi

function grep_insert_table_values()
{
    grep -P "^INSERT INTO.*?${1}.*?\(${2}" "$DUMPFILE"
}

DB="$1"
DUMPFILE="$(mktemp)"

sqlite3 $DB ".schema --indent"
sqlite3 $DB ".dump" > "$DUMPFILE"

echo "BEGIN;"
grep_insert_table_values cfdi_aduanas "'24'"
grep_insert_table_values cfdi_claves_unidades "'MTK'"
grep_insert_table_values cfdi_codigos_postales "'52000'"
grep_insert_table_values cfdi_formas_pago "'03'"
grep_insert_table_values cfdi_impuestos "'002'"
grep_insert_table_values cfdi_metodos_pago
grep_insert_table_values cfdi_monedas "'CLP'"
grep_insert_table_values cfdi_monedas "'MXN'"
grep_insert_table_values cfdi_monedas "'USD'"
grep_insert_table_values cfdi_monedas "'XXX'"
grep_insert_table_values cfdi_numeros_pedimento_aduana "'43','3420',2018"
grep_insert_table_values cfdi_paises "'CHL'"
grep_insert_table_values cfdi_paises "'MEX'"
grep_insert_table_values cfdi_paises "'USA'"
grep_insert_table_values cfdi_patentes_aduanales "'9039'"
grep_insert_table_values cfdi_productos_servicios "'10101511'"
grep_insert_table_values cfdi_productos_servicios "'10122101'"
grep_insert_table_values cfdi_productos_servicios "'43231500'"
grep_insert_table_values cfdi_regimenes_fiscales "'601'"
grep_insert_table_values cfdi_reglas_tasa_cuota "'Fijo'.*?'IVA'"
grep_insert_table_values cfdi_reglas_tasa_cuota "'Rango'.*?'IEPS'"
grep_insert_table_values cfdi_reglas_tasa_cuota "'Rango'.*?'ISR'"
grep_insert_table_values cfdi_tipos_comprobantes
grep_insert_table_values cfdi_tipos_factores
grep_insert_table_values cfdi_tipos_relaciones "'05'"
grep_insert_table_values cfdi_usos_cfdi "'G0.'"
grep_insert_table_values nomina_bancos "'00.'"
grep_insert_table_values nomina_estados "'M.*?','(MEX|USA|CAN)'"
grep_insert_table_values nomina_origenes_recursos
grep_insert_table_values nomina_periodicidades_pagos "'01'"
grep_insert_table_values nomina_periodicidades_pagos "'04'"
grep_insert_table_values nomina_riesgos_puestos
grep_insert_table_values nomina_tipos_deducciones "'00.'"
grep_insert_table_values nomina_tipos_horas
grep_insert_table_values nomina_tipos_incapacidades
grep_insert_table_values nomina_tipos_jornadas "'01'"
grep_insert_table_values nomina_tipos_jornadas "'02'"
grep_insert_table_values nomina_tipos_nominas
grep_insert_table_values nomina_tipos_otros_pagos "'001'"
grep_insert_table_values nomina_tipos_otros_pagos "'999'"
grep_insert_table_values nomina_tipos_percepciones "'001'"
grep_insert_table_values nomina_tipos_percepciones "'050'"
grep_insert_table_values nomina_tipos_regimenes "'02'"
grep_insert_table_values nomina_tipos_regimenes "'99'"
grep_insert_table_values nomina_tipos_contratos "'01'"
grep_insert_table_values nomina_tipos_contratos "'99'"
echo "COMMIT;"

rm -rf "$DUMPFILE"
