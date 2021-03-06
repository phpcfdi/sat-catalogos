CREATE TABLE IF NOT EXISTS "cce_claves_pedimentos"(
  "id" text not null,
  "texto" text not null,
  PRIMARY KEY("id")
);
CREATE TABLE IF NOT EXISTS "cce_colonias"(
  "colonia" text not null,
  "codigo_postal" text not null,
  "asentamiento" text not null,
  PRIMARY KEY("colonia", "codigo_postal")
);
CREATE TABLE IF NOT EXISTS "cce_estados"(
  "estado" text not null,
  "pais" text not null,
  "texto" text not null,
  PRIMARY KEY("estado", "pais")
);
CREATE TABLE IF NOT EXISTS "cce_fracciones_arancelarias"(
  "fraccion" text not null,
  "texto" text not null,
  "vigencia_desde" text not null,
  "vigencia_hasta" text not null,
  "unidad" text not null,
  PRIMARY KEY("fraccion")
);
CREATE TABLE IF NOT EXISTS "cce_incoterms"(
  "id" text not null,
  "texto" text not null,
  "vigencia_desde" text not null,
  "vigencia_hasta" text not null,
  PRIMARY KEY("id")
);
CREATE TABLE IF NOT EXISTS "cce_localidades"(
  "localidad" text not null,
  "estado" text not null,
  "texto" text not null,
  PRIMARY KEY("localidad", "estado")
);
CREATE TABLE IF NOT EXISTS "cce_motivos_traslado"(
  "id" text not null,
  "texto" text not null,
  PRIMARY KEY("id")
);
CREATE TABLE IF NOT EXISTS "cce_municipios"(
  "municipio" text not null,
  "estado" text not null,
  "texto" text not null,
  PRIMARY KEY("municipio", "estado")
);
CREATE TABLE IF NOT EXISTS "cce_tipos_operacion"(
  "id" text not null,
  "texto" text not null,
  PRIMARY KEY("id")
);
CREATE TABLE IF NOT EXISTS "cce_unidades_medida"(
  "id" text not null,
  "texto" text not null,
  PRIMARY KEY("id")
);
CREATE TABLE IF NOT EXISTS "cfdi_aduanas"(
  "id" text not null,
  "texto" text not null,
  "vigencia_desde" text not null,
  "vigencia_hasta" text not null,
  PRIMARY KEY("id")
);
CREATE TABLE IF NOT EXISTS "cfdi_claves_unidades"(
  "id" text not null,
  "texto" text not null,
  "descripcion" text not null,
  "notas" text not null,
  "vigencia_desde" text not null,
  "vigencia_hasta" text not null,
  "simbolo" text not null,
  PRIMARY KEY("id")
);
CREATE TABLE IF NOT EXISTS "cfdi_codigos_postales"(
  "id" text not null,
  "estado" text not null,
  "municipio" text not null,
  "localidad" text not null,
  "estimulo_frontera" int not null,
  "vigencia_desde" text not null,
  "vigencia_hasta" text not null,
  "huso_descripcion" text not null,
  "huso_verano_mes_inicio" text not null,
  "huso_verano_dia_inicio" text not null,
  "huso_verano_hora_inicio" text not null,
  "huso_verano_diferencia" text not null,
  "huso_invierno_mes_inicio" text not null,
  "huso_invierno_dia_inicio" text not null,
  "huso_invierno_hora_inicio" text not null,
  "huso_invierno_diferencia" text not null,
  PRIMARY KEY("id")
);
CREATE TABLE IF NOT EXISTS "cfdi_formas_pago"(
  "id" text not null,
  "texto" text not null,
  "es_bancarizado" int not null,
  "requiere_numero_operacion" int not null,
  "permite_banco_ordenante_rfc" int not null,
  "permite_cuenta_ordenante" int not null,
  "patron_cuenta_ordenante" text not null,
  "permite_banco_beneficiario_rfc" int not null,
  "permite_cuenta_beneficiario" int not null,
  "patron_cuenta_beneficiario" text not null,
  "permite_tipo_cadena_pago" int not null,
  "requiere_banco_ordenante_nombre_ext" int not null,
  "vigencia_desde" text not null,
  "vigencia_hasta" text not null,
  PRIMARY KEY("id")
);
CREATE TABLE IF NOT EXISTS "cfdi_impuestos"(
  "id" text not null,
  "texto" text not null,
  "retencion" int not null,
  "traslado" int not null,
  "ambito" text not null,
  "entidad" text not null,
  PRIMARY KEY("id")
);
CREATE TABLE IF NOT EXISTS "cfdi_metodos_pago"(
  "id" text not null,
  "texto" text not null,
  "vigencia_desde" text not null,
  "vigencia_hasta" text not null,
  PRIMARY KEY("id")
);
CREATE TABLE IF NOT EXISTS "cfdi_monedas"(
  "id" text not null,
  "texto" text not null,
  "decimales" int not null,
  "porcentaje_variacion" int not null,
  "vigencia_desde" text not null,
  "vigencia_hasta" text not null,
  PRIMARY KEY("id")
);
CREATE TABLE IF NOT EXISTS "cfdi_numeros_pedimento_aduana"(
  "aduana" text not null,
  "patente" text not null,
  "ejercicio" int not null,
  "cantidad" int not null,
  "vigencia_desde" text not null,
  "vigencia_hasta" text not null
);
CREATE TABLE IF NOT EXISTS "cfdi_paises"(
  "id" text not null,
  "texto" text not null,
  "patron_codigo_postal" text not null,
  "patron_identidad_tributaria" text not null,
  "validacion_identidad_tributaria" text not null,
  "agrupaciones" text not null,
  PRIMARY KEY("id")
);
CREATE TABLE IF NOT EXISTS "cfdi_patentes_aduanales"(
  "id" text not null,
  "vigencia_desde" text not null,
  "vigencia_hasta" text not null,
  PRIMARY KEY("id")
);
CREATE TABLE IF NOT EXISTS "cfdi_productos_servicios"(
  "id" text not null,
  "texto" text not null,
  "iva_trasladado" int not null,
  "ieps_trasladado" int not null,
  "complemento" text not null,
  "vigencia_desde" text not null,
  "vigencia_hasta" text not null,
  "estimulo_frontera" int not null,
  "similares" text not null,
  PRIMARY KEY("id")
);
CREATE TABLE IF NOT EXISTS "cfdi_regimenes_fiscales"(
  "id" text not null,
  "texto" text not null,
  "aplica_fisica" int not null,
  "aplica_moral" int not null,
  "vigencia_desde" text not null,
  "vigencia_hasta" text not null,
  PRIMARY KEY("id")
);
CREATE TABLE IF NOT EXISTS "cfdi_reglas_tasa_cuota"(
  "tipo" text not null,
  "minimo" text not null,
  "valor" text not null,
  "impuesto" text not null,
  "factor" text not null,
  "traslado" int not null,
  "retencion" int not null,
  "vigencia_desde" text not null,
  "vigencia_hasta" text not null
);
CREATE TABLE IF NOT EXISTS "cfdi_tipos_comprobantes"(
  "id" text not null,
  "texto" text not null,
  "valor_maximo" text not null,
  "vigencia_desde" text not null,
  "vigencia_hasta" text not null,
  PRIMARY KEY("id")
);
CREATE TABLE IF NOT EXISTS "cfdi_tipos_factores"("id" text not null, PRIMARY KEY("id"));
CREATE TABLE IF NOT EXISTS "cfdi_tipos_relaciones"(
  "id" text not null,
  "texto" text not null,
  "vigencia_desde" text not null,
  "vigencia_hasta" text not null,
  PRIMARY KEY("id")
);
CREATE TABLE IF NOT EXISTS "cfdi_usos_cfdi"(
  "id" text not null,
  "texto" text not null,
  "aplica_fisica" int not null,
  "aplica_moral" int not null,
  "vigencia_desde" text not null,
  "vigencia_hasta" text not null,
  PRIMARY KEY("id")
);
CREATE TABLE IF NOT EXISTS "nomina_bancos"(
  "id" text not null,
  "texto" text not null,
  "razon_social" text not null,
  "vigencia_desde" text not null,
  "vigencia_hasta" text not null,
  PRIMARY KEY("id")
);
CREATE TABLE IF NOT EXISTS "nomina_estados"(
  "estado" text not null,
  "pais" text not null,
  "texto" text not null,
  PRIMARY KEY("estado", "pais")
);
CREATE TABLE IF NOT EXISTS "nomina_origenes_recursos"(
  "id" text not null,
  "texto" text not null,
  PRIMARY KEY("id")
);
CREATE TABLE IF NOT EXISTS "nomina_periodicidades_pagos"(
  "id" text not null,
  "texto" text not null,
  "vigencia_desde" text not null,
  "vigencia_hasta" text not null,
  PRIMARY KEY("id")
);
CREATE TABLE IF NOT EXISTS "nomina_riesgos_puestos"(
  "id" text not null,
  "texto" text not null,
  "vigencia_desde" text not null,
  "vigencia_hasta" text not null,
  PRIMARY KEY("id")
);
CREATE TABLE IF NOT EXISTS "nomina_tipos_contratos"(
  "id" text not null,
  "texto" text not null,
  PRIMARY KEY("id")
);
CREATE TABLE IF NOT EXISTS "nomina_tipos_deducciones"(
  "id" text not null,
  "texto" text not null,
  "vigencia_desde" text not null,
  "vigencia_hasta" text not null,
  PRIMARY KEY("id")
);
CREATE TABLE IF NOT EXISTS "nomina_tipos_horas"(
  "id" text not null,
  "texto" text not null,
  PRIMARY KEY("id")
);
CREATE TABLE IF NOT EXISTS "nomina_tipos_incapacidades"(
  "id" text not null,
  "texto" text not null,
  PRIMARY KEY("id")
);
CREATE TABLE IF NOT EXISTS "nomina_tipos_jornadas"(
  "id" text not null,
  "texto" text not null,
  PRIMARY KEY("id")
);
CREATE TABLE IF NOT EXISTS "nomina_tipos_nominas"(
  "id" text not null,
  "texto" text not null,
  PRIMARY KEY("id")
);
CREATE TABLE IF NOT EXISTS "nomina_tipos_otros_pagos"(
  "id" text not null,
  "texto" text not null,
  "vigencia_desde" text not null,
  "vigencia_hasta" text not null,
  PRIMARY KEY("id")
);
CREATE TABLE IF NOT EXISTS "nomina_tipos_percepciones"(
  "id" text not null,
  "texto" text not null,
  "vigencia_desde" text not null,
  "vigencia_hasta" text not null,
  PRIMARY KEY("id")
);
CREATE TABLE IF NOT EXISTS "nomina_tipos_regimenes"(
  "id" text not null,
  "texto" text not null,
  "vigencia_desde" text not null,
  "vigencia_hasta" text not null,
  PRIMARY KEY("id")
);
CREATE TABLE IF NOT EXISTS "pagos_tipos_cadena_pago"(
  "id" text not null,
  "texto" text not null,
  PRIMARY KEY("id")
);
BEGIN;
INSERT INTO cfdi_aduanas VALUES('24','NUEVO LAREDO, NUEVO LAREDO, TAMAULIPAS.','2017-01-01','');
INSERT INTO cfdi_claves_unidades VALUES('MTK','Metro cuadrado','Es la unidad básica de superficie en el Sistema Internacional de Unidades. Si a esta unidad se antepone un prefijo del Sistema Internacional se crea un múltiplo o submúltiplo de esta.','','2017-01-01','','m²');
INSERT INTO cfdi_codigos_postales VALUES('52000','MEX','051','','','2019-01-07','','Tiempo del Centro','Abril','Primer domingo','02:00','-5','Octubre','Último domingo','02:00','-6');
INSERT INTO cfdi_formas_pago VALUES('03','Transferencia electrónica de fondos',1,'',1,1,'[0-9]{10}|[0-9]{16}|[0-9]{18}',1,1,'[0-9]{10}|[0-9]{18}',1,1,'2017-01-01','');
INSERT INTO cfdi_impuestos VALUES('002','IVA',1,1,'Federal','');
INSERT INTO cfdi_metodos_pago VALUES('PUE','Pago en una sola exhibición','2017-01-01','');
INSERT INTO cfdi_metodos_pago VALUES('PPD','Pago en parcialidades o diferido','2017-01-01','');
INSERT INTO cfdi_monedas VALUES('CLP','Peso chileno',0,5,'2017-08-14','');
INSERT INTO cfdi_monedas VALUES('MXN','Peso Mexicano',2,5,'2017-08-14','');
INSERT INTO cfdi_monedas VALUES('USD','Dolar americano',2,5,'2017-08-14','');
INSERT INTO cfdi_monedas VALUES('XXX','Los códigos asignados para las transacciones en que intervenga ninguna moneda',0,0,'2017-08-14','');
INSERT INTO cfdi_numeros_pedimento_aduana VALUES('43','3420',2018,999999,'2018-01-03','');
INSERT INTO cfdi_paises VALUES('CHL','Chile','','','','');
INSERT INTO cfdi_paises VALUES('MEX','México','[0-9]{5}','[A-Z&Ñ]{3,4}[0-9]{2}(0[1-9]|1[012])(0[1-9]|[12][0-9]|3[01])[A-Z0-9]{2}[0\n-9A]','Lista del SAT','TLCAN');
INSERT INTO cfdi_paises VALUES('USA','Estados Unidos (los)','[0-9]{5}(-[0-9]{4})?','[0-9]{9}','','TLCAN');
INSERT INTO cfdi_patentes_aduanales VALUES('9039','2002-08-12','');
INSERT INTO cfdi_productos_servicios VALUES('10101511','Cerdos','','','','2019-01-07','',1,'Cerdo montés, Chanchos, Chanchos almizcleros, Chanchos de monte, Cochinillos, Cochinos, Cochinos de monte, Cuche, Cuinos, Gorrinos, Jabalíes americanos, Lechones, Cochinos de monte, Pecaríes, Porcinos, Puercos, Puercos de monte, Tayatos');
INSERT INTO cfdi_productos_servicios VALUES('10122101','Comida para cerdos','','','','2019-01-07','',1,'Comida para chanchos, Comida para cochinillos, Comida para cochinos, Comida para cuche, Comida para cuinos, Comida para gorrinos, Comida para lechones, Comida para marranos, Comida para porcinos, Comida para puercos, Comida para lechones');
INSERT INTO cfdi_productos_servicios VALUES('43231500','Software funcional específico de la empresa','','','','2019-01-07','','','');
INSERT INTO cfdi_regimenes_fiscales VALUES('601','General de Ley Personas Morales','',1,'2016-11-12','');
INSERT INTO cfdi_reglas_tasa_cuota VALUES('Fijo','','0.000000','IVA','Tasa',1,'','2017-01-01','');
INSERT INTO cfdi_reglas_tasa_cuota VALUES('Fijo','','0.160000','IVA','Tasa',1,'','2017-01-01','');
INSERT INTO cfdi_reglas_tasa_cuota VALUES('Rango','0.000000','50.320000','IEPS','Cuota',1,1,'2020-01-01','');
INSERT INTO cfdi_reglas_tasa_cuota VALUES('Rango','0.000000','0.350000','ISR','Tasa','',1,'2017-01-01','');
INSERT INTO cfdi_tipos_comprobantes VALUES('I','Ingreso','999999999999999999.999999','2017-07-29','');
INSERT INTO cfdi_tipos_comprobantes VALUES('E','Egreso','999999999999999999.999999','2017-07-29','');
INSERT INTO cfdi_tipos_comprobantes VALUES('T','Traslado','0','2017-01-01','');
INSERT INTO cfdi_tipos_comprobantes VALUES('N','Nómina','999999999999999999.999999','','');
INSERT INTO cfdi_tipos_comprobantes VALUES('P','Pago','999999999999999999.999999','2017-07-29','');
INSERT INTO cfdi_tipos_factores VALUES('Tasa');
INSERT INTO cfdi_tipos_factores VALUES('Cuota');
INSERT INTO cfdi_tipos_factores VALUES('Exento');
INSERT INTO cfdi_tipos_relaciones VALUES('05','Traslados de mercancias facturados previamente','2017-01-01','');
INSERT INTO cfdi_usos_cfdi VALUES('G01','Adquisición de mercancias',1,1,'2017-01-01','');
INSERT INTO cfdi_usos_cfdi VALUES('G02','Devoluciones, descuentos o bonificaciones',1,1,'2017-01-01','');
INSERT INTO cfdi_usos_cfdi VALUES('G03','Gastos en general',1,1,'2017-01-01','');
COMMIT;
