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
  "vigencia_desde" text not null,
  "vigencia_hasta" text not null,
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
  "vigencia_desde" text not null,
  "vigencia_hasta" text not null,
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
  "vigencia_desde" text not null,
  "vigencia_hasta" text not null,
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
  "vigencia_desde" text not null,
  "vigencia_hasta" text not null,
  PRIMARY KEY("id")
);
CREATE TABLE IF NOT EXISTS "ccp_20_autorizaciones_naviero"(
  "id" text not null,
  "vigencia_desde" text not null,
  "vigencia_hasta" text not null,
  PRIMARY KEY("id")
);
CREATE TABLE IF NOT EXISTS "ccp_20_claves_unidades"(
  "id" text not null,
  "texto" text not null,
  "descripcion" text not null,
  "nota" text not null,
  "vigencia_desde" text not null,
  "vigencia_hasta" text not null,
  "simbolo" text not null,
  "bandera" text not null,
  PRIMARY KEY("id")
);
CREATE TABLE IF NOT EXISTS "ccp_20_codigos_transporte_aereo"(
  "id" text not null,
  "nacionalidad" text not null,
  "texto" text not null,
  "designador_oaci" text not null,
  "vigencia_desde" text not null,
  "vigencia_hasta" text not null,
  PRIMARY KEY("id")
);
CREATE TABLE IF NOT EXISTS "ccp_20_colonias"(
  "colonia" text not null,
  "codigo_postal" text not null,
  "texto" text not null,
  PRIMARY KEY("colonia", "codigo_postal")
);
CREATE TABLE IF NOT EXISTS "ccp_20_configuraciones_autotransporte"(
  "id" text not null,
  "texto" text not null,
  "numero_de_ejes" int not null,
  "numero_de_llantas" int not null,
  "remolque" text not null,
  "vigencia_desde" text not null,
  "vigencia_hasta" text not null,
  PRIMARY KEY("id")
);
CREATE TABLE IF NOT EXISTS "ccp_20_configuraciones_maritimas"(
  "id" text not null,
  "texto" text not null,
  "vigencia_desde" text not null,
  "vigencia_hasta" text not null,
  PRIMARY KEY("id")
);
CREATE TABLE IF NOT EXISTS "ccp_20_contenedores_maritimos"(
  "id" text not null,
  "texto" text not null,
  "vigencia_desde" text not null,
  "vigencia_hasta" text not null,
  PRIMARY KEY("id")
);
CREATE TABLE IF NOT EXISTS "ccp_20_contenedores"(
  "id" text not null,
  "texto" text not null,
  "descripcion" text not null,
  "vigencia_desde" text not null,
  "vigencia_hasta" text not null,
  PRIMARY KEY("id")
);
CREATE TABLE IF NOT EXISTS "ccp_20_derechos_de_paso"(
  "id" text not null,
  "texto" text not null,
  "entre" text not null,
  "hasta" text not null,
  "otorga_recibe" text not null,
  "concesionario" text not null,
  "vigencia_desde" text not null,
  "vigencia_hasta" text not null,
  PRIMARY KEY("id")
);
CREATE TABLE IF NOT EXISTS "ccp_20_estaciones"(
  "id" text not null,
  "texto" text not null,
  "clave_transporte" text not null,
  "nacionalidad" text not null,
  "designador_iata" text not null,
  "linea_ferrea" text not null,
  "vigencia_desde" text not null,
  "vigencia_hasta" text not null,
  PRIMARY KEY("id")
);
CREATE TABLE IF NOT EXISTS "ccp_20_figuras_transporte"(
  "id" text not null,
  "texto" text not null,
  "vigencia_desde" text not null,
  "vigencia_hasta" text not null,
  PRIMARY KEY("id")
);
CREATE TABLE IF NOT EXISTS "ccp_20_localidades"(
  "localidad" text not null,
  "estado" text not null,
  "texto" text not null,
  "vigencia_desde" text not null,
  "vigencia_hasta" text not null,
  PRIMARY KEY("localidad", "estado")
);
CREATE TABLE IF NOT EXISTS "ccp_20_materiales_peligrosos"(
  "id" text not null,
  "texto" text not null,
  "clase_o_div" text not null,
  "peligro_secundario" text not null,
  "nombre_tecnico" text not null,
  "vigencia_desde" text not null,
  "vigencia_hasta" text not null
);
CREATE TABLE IF NOT EXISTS "ccp_20_municipios"(
  "municipio" text not null,
  "estado" text not null,
  "texto" text not null,
  "vigencia_desde" text not null,
  "vigencia_hasta" text not null,
  PRIMARY KEY("municipio", "estado")
);
CREATE TABLE IF NOT EXISTS "ccp_20_partes_transporte"(
  "id" text not null,
  "texto" text not null,
  "vigencia_desde" text not null,
  "vigencia_hasta" text not null,
  PRIMARY KEY("id")
);
CREATE TABLE IF NOT EXISTS "ccp_20_productos_servicios"(
  "id" text not null,
  "texto" text not null,
  "similares" text not null,
  "material_peligroso" text not null,
  "vigencia_desde" text not null,
  "vigencia_hasta" text not null,
  PRIMARY KEY("id")
);
CREATE TABLE IF NOT EXISTS "ccp_20_tipos_carga"(
  "id" text not null,
  "texto" text not null,
  "vigencia_desde" text not null,
  "vigencia_hasta" text not null,
  PRIMARY KEY("id")
);
CREATE TABLE IF NOT EXISTS "ccp_20_tipos_carro"(
  "id" text not null,
  "texto" text not null,
  "contenedor" text not null,
  "vigencia_desde" text not null,
  "vigencia_hasta" text not null,
  PRIMARY KEY("id")
);
CREATE TABLE IF NOT EXISTS "ccp_20_tipos_embalaje"(
  "id" text not null,
  "texto" text not null,
  "vigencia_desde" text not null,
  "vigencia_hasta" text not null,
  PRIMARY KEY("id")
);
CREATE TABLE IF NOT EXISTS "ccp_20_tipos_estacion"(
  "id" text not null,
  "texto" text not null,
  "claves_transportes" text not null,
  "vigencia_desde" text not null,
  "vigencia_hasta" text not null,
  PRIMARY KEY("id")
);
CREATE TABLE IF NOT EXISTS "ccp_20_tipos_permiso"(
  "id" text not null,
  "texto" text not null,
  "clave_transporte" text not null,
  "vigencia_desde" text not null,
  "vigencia_hasta" text not null,
  PRIMARY KEY("id")
);
CREATE TABLE IF NOT EXISTS "ccp_20_tipos_remolque"(
  "id" text not null,
  "texto" text not null,
  "vigencia_desde" text not null,
  "vigencia_hasta" text not null,
  PRIMARY KEY("id")
);
CREATE TABLE IF NOT EXISTS "ccp_20_tipos_servicio"(
  "id" text not null,
  "texto" text not null,
  "contenedor" text not null,
  "vigencia_desde" text not null,
  "vigencia_hasta" text not null,
  PRIMARY KEY("id")
);
CREATE TABLE IF NOT EXISTS "ccp_20_tipos_trafico"(
  "id" text not null,
  "texto" text not null,
  "vigencia_desde" text not null,
  "vigencia_hasta" text not null,
  PRIMARY KEY("id")
);
CREATE TABLE IF NOT EXISTS "ccp_20_transportes"(
  "id" text not null,
  "texto" text not null,
  "vigencia_desde" text not null,
  "vigencia_hasta" text not null,
  PRIMARY KEY("id")
);
CREATE TABLE IF NOT EXISTS "cfdi_40_aduanas"(
  "id" text not null,
  "texto" text not null,
  "vigencia_desde" text not null,
  "vigencia_hasta" text not null,
  PRIMARY KEY("id")
);
CREATE TABLE IF NOT EXISTS "cfdi_40_claves_unidades"(
  "id" text not null,
  "texto" text not null,
  "descripcion" text not null,
  "notas" text not null,
  "vigencia_desde" text not null,
  "vigencia_hasta" text not null,
  "simbolo" text not null,
  PRIMARY KEY("id")
);
CREATE TABLE IF NOT EXISTS "cfdi_40_codigos_postales"(
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
CREATE TABLE IF NOT EXISTS "cfdi_40_colonias"(
  "colonia" text not null,
  "codigo_postal" text not null,
  "texto" text not null,
  PRIMARY KEY("colonia", "codigo_postal")
);
CREATE TABLE IF NOT EXISTS "cfdi_40_estados"(
  "estado" text not null,
  "pais" text not null,
  "texto" text not null,
  "vigencia_desde" text not null,
  "vigencia_hasta" text not null,
  PRIMARY KEY("estado", "pais")
);
CREATE TABLE IF NOT EXISTS "cfdi_40_exportaciones"(
  "id" text not null,
  "texto" text not null,
  "vigencia_desde" text not null,
  "vigencia_hasta" text not null,
  PRIMARY KEY("id")
);
CREATE TABLE IF NOT EXISTS "cfdi_40_formas_pago"(
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
CREATE TABLE IF NOT EXISTS "cfdi_40_impuestos"(
  "id" text not null,
  "texto" text not null,
  "retencion" int not null,
  "traslado" int not null,
  "ambito" text not null,
  "vigencia_desde" text not null,
  "vigencia_hasta" text not null,
  PRIMARY KEY("id")
);
CREATE TABLE IF NOT EXISTS "cfdi_40_localidades"(
  "localidad" text not null,
  "estado" text not null,
  "texto" text not null,
  "vigencia_desde" text not null,
  "vigencia_hasta" text not null,
  PRIMARY KEY("localidad", "estado")
);
CREATE TABLE IF NOT EXISTS "cfdi_40_meses"(
  "id" text not null,
  "texto" text not null,
  "vigencia_desde" text not null,
  "vigencia_hasta" text not null,
  PRIMARY KEY("id")
);
CREATE TABLE IF NOT EXISTS "cfdi_40_metodos_pago"(
  "id" text not null,
  "texto" text not null,
  "vigencia_desde" text not null,
  "vigencia_hasta" text not null,
  PRIMARY KEY("id")
);
CREATE TABLE IF NOT EXISTS "cfdi_40_monedas"(
  "id" text not null,
  "texto" text not null,
  "decimales" int not null,
  "porcentaje_variacion" int not null,
  "vigencia_desde" text not null,
  "vigencia_hasta" text not null,
  PRIMARY KEY("id")
);
CREATE TABLE IF NOT EXISTS "cfdi_40_municipios"(
  "municipio" text not null,
  "estado" text not null,
  "texto" text not null,
  "vigencia_desde" text not null,
  "vigencia_hasta" text not null,
  PRIMARY KEY("municipio", "estado")
);
CREATE TABLE IF NOT EXISTS "cfdi_40_numeros_pedimento_aduana"(
  "aduana" text not null,
  "patente" text not null,
  "ejercicio" int not null,
  "cantidad" int not null,
  "vigencia_desde" text not null,
  "vigencia_hasta" text not null
);
CREATE TABLE IF NOT EXISTS "cfdi_40_objetos_impuestos"(
  "id" text not null,
  "texto" text not null,
  "vigencia_desde" text not null,
  "vigencia_hasta" text not null,
  PRIMARY KEY("id")
);
CREATE TABLE IF NOT EXISTS "cfdi_40_paises"(
  "id" text not null,
  "texto" text not null,
  "patron_codigo_postal" text not null,
  "patron_identidad_tributaria" text not null,
  "validacion_identidad_tributaria" text not null,
  "agrupaciones" text not null,
  PRIMARY KEY("id")
);
CREATE TABLE IF NOT EXISTS "cfdi_40_patentes_aduanales"(
  "id" text not null,
  "vigencia_desde" text not null,
  "vigencia_hasta" text not null,
  PRIMARY KEY("id")
);
CREATE TABLE IF NOT EXISTS "cfdi_40_periodicidades"(
  "id" text not null,
  "texto" text not null,
  "vigencia_desde" text not null,
  "vigencia_hasta" text not null,
  PRIMARY KEY("id")
);
CREATE TABLE IF NOT EXISTS "cfdi_40_productos_servicios"(
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
CREATE TABLE IF NOT EXISTS "cfdi_40_regimenes_fiscales"(
  "id" text not null,
  "texto" text not null,
  "aplica_fisica" int not null,
  "aplica_moral" int not null,
  "vigencia_desde" text not null,
  "vigencia_hasta" text not null,
  PRIMARY KEY("id")
);
CREATE TABLE IF NOT EXISTS "cfdi_40_reglas_tasa_cuota"(
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
CREATE TABLE IF NOT EXISTS "cfdi_40_tipos_comprobantes"(
  "id" text not null,
  "texto" text not null,
  "valor_maximo" text not null,
  "vigencia_desde" text not null,
  "vigencia_hasta" text not null,
  PRIMARY KEY("id")
);
CREATE TABLE IF NOT EXISTS "cfdi_40_tipos_factores"(
  "id" text not null,
  "vigencia_desde" text not null,
  "vigencia_hasta" text not null,
  PRIMARY KEY("id")
);
CREATE TABLE IF NOT EXISTS "cfdi_40_tipos_relaciones"(
  "id" text not null,
  "texto" text not null,
  "vigencia_desde" text not null,
  "vigencia_hasta" text not null,
  PRIMARY KEY("id")
);
CREATE TABLE IF NOT EXISTS "cfdi_40_usos_cfdi"(
  "id" text not null,
  "texto" text not null,
  "aplica_fisica" int not null,
  "aplica_moral" int not null,
  "vigencia_desde" text not null,
  "vigencia_hasta" text not null,
  "regimenes_fiscales_receptores" text not null,
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
  "vigencia_desde" text not null,
  "vigencia_hasta" text not null,
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
INSERT INTO cfdi_monedas VALUES('USD','Dólar americano',2,5,'2017-08-14','');
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
INSERT INTO cfdi_reglas_tasa_cuota VALUES('Rango','0.000000','59.144900','IEPS','Cuota',1,1,'2022-01-01','');
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
INSERT INTO cfdi_usos_cfdi VALUES('G01','Adquisición de mercancías',1,1,'2017-01-01','');
INSERT INTO cfdi_usos_cfdi VALUES('G02','Devoluciones, descuentos o bonificaciones',1,1,'2017-01-01','');
INSERT INTO cfdi_usos_cfdi VALUES('G03','Gastos en general',1,1,'2017-01-01','');
INSERT INTO cfdi_40_aduanas VALUES('24','NUEVO LAREDO, NUEVO LAREDO, TAMAULIPAS.','2022-01-01','');
INSERT INTO cfdi_40_colonias VALUES('2793','04510','Universidad Nacional Autónoma de México');
INSERT INTO cfdi_40_colonias VALUES('0001','86000','Portal Del Agua');
INSERT INTO cfdi_40_colonias VALUES('0002','86000','Villahermosa Centro');
INSERT INTO cfdi_40_colonias VALUES('0009','86008','Secretaria de La Reforma Agraria');
INSERT INTO cfdi_40_colonias VALUES('1477','86000','Centro Delegacional 6');
INSERT INTO cfdi_40_claves_unidades VALUES('MTK','Metro cuadrado','Es la unidad básica de superficie en el Sistema Internacional de Unidades. Si a esta unidad se antepone un prefijo del Sistema Internacional se crea un múltiplo o submúltiplo de esta.','','2022-01-01','','m²');
INSERT INTO cfdi_40_codigos_postales VALUES('52000','MEX','051','','','2022-01-01','','Tiempo del Centro','Abril','Primer domingo','02:00','-5','Octubre','Último domingo','02:00','-6');
INSERT INTO cfdi_40_estados VALUES('MEX','MEX','Estado de México','2022-01-01','');
INSERT INTO cfdi_40_estados VALUES('MIC','MEX','Michoacán','2022-01-01','');
INSERT INTO cfdi_40_estados VALUES('MOR','MEX','Morelos','2022-01-01','');
INSERT INTO cfdi_40_estados VALUES('ME','USA','Maine','2022-01-01','');
INSERT INTO cfdi_40_estados VALUES('MD','USA','Maryland','2022-01-01','');
INSERT INTO cfdi_40_estados VALUES('MA','USA','Massachusetts','2022-01-01','');
INSERT INTO cfdi_40_estados VALUES('MI','USA','Míchigan','2022-01-01','');
INSERT INTO cfdi_40_estados VALUES('MN','USA','Minnesota','2022-01-01','');
INSERT INTO cfdi_40_estados VALUES('MS','USA','Misisipi','2022-01-01','');
INSERT INTO cfdi_40_estados VALUES('MO','USA','Misuri','2022-01-01','');
INSERT INTO cfdi_40_estados VALUES('MT','USA','Montana','2022-01-01','');
INSERT INTO cfdi_40_estados VALUES('MB','CAN','Manitoba','2022-01-01','');
INSERT INTO cfdi_40_exportaciones VALUES('01','No aplica','2022-01-01','');
INSERT INTO cfdi_40_exportaciones VALUES('02','Definitiva con clave A1','2022-01-01','');
INSERT INTO cfdi_40_exportaciones VALUES('03','Temporal','2022-01-01','');
INSERT INTO cfdi_40_exportaciones VALUES('04','Definitiva con clave distinta a A1 o cuando no existe enajenación en términos del CFF','2022-02-25','');
INSERT INTO cfdi_40_formas_pago VALUES('03','Transferencia electrónica de fondos',1,'',1,1,'[0-9]{10}|[0-9]{16}|[0-9]{18}',1,1,'[0-9]{10}|[0-9]{18}',1,1,'2022-01-01','');
INSERT INTO cfdi_40_impuestos VALUES('002','IVA',1,1,'Federal','2022-01-01','');
INSERT INTO cfdi_40_meses VALUES('01','Enero','2022-01-01','');
INSERT INTO cfdi_40_metodos_pago VALUES('PUE','Pago en una sola exhibición','2022-01-01','');
INSERT INTO cfdi_40_metodos_pago VALUES('PPD','Pago en parcialidades o diferido','2022-01-01','');
INSERT INTO cfdi_40_monedas VALUES('CLP','Peso chileno',0,5,'2022-01-01','');
INSERT INTO cfdi_40_monedas VALUES('MXN','Peso Mexicano',2,5,'2022-01-01','');
INSERT INTO cfdi_40_monedas VALUES('USD','Dólar americano',2,5,'2022-01-01','');
INSERT INTO cfdi_40_monedas VALUES('XXX','Los códigos asignados para las transacciones en que intervenga ninguna moneda',0,0,'2022-01-01','');
INSERT INTO cfdi_40_municipios VALUES('210','OAX','San Juan Ñumí','2022-01-01','');
INSERT INTO cfdi_40_municipios VALUES('210','PUE','Zapotitlán de Méndez','2022-01-01','');
INSERT INTO cfdi_40_municipios VALUES('210','VER','Uxpanapa','2022-01-01','');
INSERT INTO cfdi_40_municipios VALUES('001','BCN','Ensenada','2022-01-01','');
INSERT INTO cfdi_40_municipios VALUES('002','BCN','Mexicali','2022-01-01','');
INSERT INTO cfdi_40_municipios VALUES('003','BCN','Tecate','2022-01-01','');
INSERT INTO cfdi_40_municipios VALUES('004','BCN','Tijuana','2022-01-01','');
INSERT INTO cfdi_40_municipios VALUES('005','BCN','Playas de Rosarito','2022-01-01','');
INSERT INTO cfdi_40_localidades VALUES('55','JAL','Acatlán de Juárez','2022-01-01','');
INSERT INTO cfdi_40_localidades VALUES('55','OAX','Santo Domingo Tehuantepec','2022-01-01','');
INSERT INTO cfdi_40_localidades VALUES('55','VER','Tihuatlán','2022-01-01','');
INSERT INTO cfdi_40_localidades VALUES('01','QUE','Querétaro','2022-01-01','');
INSERT INTO cfdi_40_localidades VALUES('02','QUE','San Juan del Rio','2022-01-01','');
INSERT INTO cfdi_40_localidades VALUES('04','QUE','El Pueblito','2022-01-01','');
INSERT INTO cfdi_40_numeros_pedimento_aduana VALUES('43','3420',2018,999999,'2018-01-03','');
INSERT INTO cfdi_40_objetos_impuestos VALUES('01','No objeto de impuesto.','2022-01-01','');
INSERT INTO cfdi_40_objetos_impuestos VALUES('02','Sí objeto de impuesto.','2022-01-01','');
INSERT INTO cfdi_40_objetos_impuestos VALUES('03','Sí objeto del impuesto y no obligado al desglose.','2022-01-01','');
INSERT INTO cfdi_40_paises VALUES('CHL','Chile','','','','');
INSERT INTO cfdi_40_paises VALUES('MEX','México','[0-9]{5}','[A-Z&Ñ]{3,4}[0-9]{2}(0[1-9]|1[012])(0[1-9]|[12][0-9]|3[01])[A-Z0-9]{2}[0\n-9A]','Lista del SAT','TLCAN');
INSERT INTO cfdi_40_paises VALUES('USA','Estados Unidos (los)','[0-9]{5}(-[0-9]{4})?','[0-9]{9}','','TLCAN');
INSERT INTO cfdi_40_patentes_aduanales VALUES('9039','2002-08-12','');
INSERT INTO cfdi_40_periodicidades VALUES('01','Diario','2022-01-01','');
INSERT INTO cfdi_40_periodicidades VALUES('02','Semanal','2022-01-01','');
INSERT INTO cfdi_40_periodicidades VALUES('03','Quincenal','2022-01-01','');
INSERT INTO cfdi_40_periodicidades VALUES('04','Mensual','2022-01-01','');
INSERT INTO cfdi_40_periodicidades VALUES('05','Bimestral','2022-01-01','');
INSERT INTO cfdi_40_productos_servicios VALUES('10101511','Cerdos','','','','2022-01-01','',1,'Cerdo montés, Chanchos, Chanchos almizcleros, Chanchos de monte, Cochinillos, Cochinos, Cochinos de monte, Cuche, Cuinos, Gorrinos, Jabalíes americanos, Lechones, Cochinos de monte, Pecaríes, Porcinos, Puercos, Puercos de monte, Tayatos');
INSERT INTO cfdi_40_productos_servicios VALUES('10122101','Comida para cerdos','','','','2022-01-01','',1,'Comida para chanchos, Comida para cochinillos, Comida para cochinos, Comida para cuche, Comida para cuinos, Comida para gorrinos, Comida para lechones, Comida para marranos, Comida para porcinos, Comida para puercos, Comida para lechones');
INSERT INTO cfdi_40_productos_servicios VALUES('43231500','Software funcional específico de la empresa','','','','2022-01-01','','','');
INSERT INTO cfdi_40_regimenes_fiscales VALUES('601','General de Ley Personas Morales','',1,'2022-01-01','');
INSERT INTO cfdi_40_reglas_tasa_cuota VALUES('Fijo','','0.000000','IVA','Tasa',1,'','2022-01-01','');
INSERT INTO cfdi_40_reglas_tasa_cuota VALUES('Fijo','','0.160000','IVA','Tasa',1,'','2022-01-01','');
INSERT INTO cfdi_40_reglas_tasa_cuota VALUES('Rango','0.000000','59.144900','IEPS','Cuota',1,1,'2022-01-01','');
INSERT INTO cfdi_40_reglas_tasa_cuota VALUES('Rango','0.000000','0.350000','ISR','Tasa','',1,'2022-01-01','');
INSERT INTO cfdi_40_tipos_comprobantes VALUES('I','Ingreso','999999999999999999.999999','2022-01-01','');
INSERT INTO cfdi_40_tipos_comprobantes VALUES('E','Egreso','999999999999999999.999999','2022-01-01','');
INSERT INTO cfdi_40_tipos_comprobantes VALUES('T','Traslado','0','2022-01-01','');
INSERT INTO cfdi_40_tipos_comprobantes VALUES('N','Nómina','999999999999999999.999999','','');
INSERT INTO cfdi_40_tipos_comprobantes VALUES('P','Pago','999999999999999999.999999','2022-01-01','');
INSERT INTO cfdi_40_tipos_factores VALUES('Tasa','2022-01-01','');
INSERT INTO cfdi_40_tipos_factores VALUES('Cuota','2022-01-01','');
INSERT INTO cfdi_40_tipos_factores VALUES('Exento','2022-01-01','');
INSERT INTO cfdi_40_tipos_relaciones VALUES('05','Traslados de mercancías facturados previamente','2022-01-01','');
INSERT INTO cfdi_40_usos_cfdi VALUES('G01','Adquisición de mercancías.',1,1,'2022-01-01','','601, 603, 606, 612, 620, 621, 622, 623, 624, 625,626');
INSERT INTO cfdi_40_usos_cfdi VALUES('G02','Devoluciones, descuentos o bonificaciones.',1,1,'2022-01-01','','601, 603, 606, 612, 620, 621, 622, 623, 624, 625,626');
INSERT INTO cfdi_40_usos_cfdi VALUES('G03','Gastos en general.',1,1,'2022-01-01','','601, 603, 606, 612, 620, 621, 622, 623, 624, 625, 626');
INSERT INTO nomina_bancos VALUES('002','BANAMEX','Banco Nacional de México, S.A., Institución de Banca Múltiple, Grupo Financiero Banamex','2017-01-01','');
INSERT INTO nomina_bancos VALUES('006','BANCOMEXT','Banco Nacional de Comercio Exterior, Sociedad Nacional de Crédito, Institución de Banca de Desarrollo','2017-01-01','');
INSERT INTO nomina_bancos VALUES('009','BANOBRAS','Banco Nacional de Obras y Servicios Públicos, Sociedad Nacional de Crédito, Institución de Banca de Desarrollo','2017-01-01','');
INSERT INTO nomina_estados VALUES('MEX','MEX','Estado de México','2017-01-01','');
INSERT INTO nomina_estados VALUES('MIC','MEX','Michoacán','2017-01-01','');
INSERT INTO nomina_estados VALUES('MOR','MEX','Morelos','2017-01-01','');
INSERT INTO nomina_estados VALUES('ME','USA','Maine','2017-01-01','');
INSERT INTO nomina_estados VALUES('MD','USA','Maryland','2017-01-01','');
INSERT INTO nomina_estados VALUES('MA','USA','Massachusetts','2017-01-01','');
INSERT INTO nomina_estados VALUES('MI','USA','Míchigan','2017-01-01','');
INSERT INTO nomina_estados VALUES('MN','USA','Minnesota','2017-01-01','');
INSERT INTO nomina_estados VALUES('MS','USA','Misisipi','2017-01-01','');
INSERT INTO nomina_estados VALUES('MO','USA','Misuri','2017-01-01','');
INSERT INTO nomina_estados VALUES('MT','USA','Montana','2017-01-01','');
INSERT INTO nomina_estados VALUES('MB','CAN','Manitoba','2017-01-01','');
INSERT INTO nomina_origenes_recursos VALUES('IP','Ingresos propios.');
INSERT INTO nomina_origenes_recursos VALUES('IF','Ingreso federales.');
INSERT INTO nomina_origenes_recursos VALUES('IM','Ingresos mixtos.');
INSERT INTO nomina_periodicidades_pagos VALUES('01','Diario','2016-11-01','');
INSERT INTO nomina_periodicidades_pagos VALUES('04','Quincenal','2016-11-01','');
INSERT INTO nomina_riesgos_puestos VALUES('1','Clase I','2017-01-01','');
INSERT INTO nomina_riesgos_puestos VALUES('2','Clase II','2017-01-01','');
INSERT INTO nomina_riesgos_puestos VALUES('3','Clase III','2017-01-01','');
INSERT INTO nomina_riesgos_puestos VALUES('4','Clase IV','2017-01-01','');
INSERT INTO nomina_riesgos_puestos VALUES('5','Clase V','2017-01-01','');
INSERT INTO nomina_riesgos_puestos VALUES('99','No aplica','2017-08-13','');
INSERT INTO nomina_tipos_deducciones VALUES('001','Seguridad social','2016-11-01','');
INSERT INTO nomina_tipos_deducciones VALUES('002','ISR','2016-11-01','');
INSERT INTO nomina_tipos_deducciones VALUES('003','Aportaciones a retiro, cesantía en edad avanzada y vejez.','2016-11-01','');
INSERT INTO nomina_tipos_deducciones VALUES('004','Otros','2016-11-01','');
INSERT INTO nomina_tipos_deducciones VALUES('005','Aportaciones a Fondo de vivienda','2016-11-01','');
INSERT INTO nomina_tipos_deducciones VALUES('006','Descuento por incapacidad','2016-11-01','');
INSERT INTO nomina_tipos_deducciones VALUES('007','Pensión alimenticia','2016-11-01','');
INSERT INTO nomina_tipos_deducciones VALUES('008','Renta','2016-11-01','');
INSERT INTO nomina_tipos_deducciones VALUES('009','Préstamos provenientes del Fondo Nacional de la Vivienda para los Trabajadores','2016-11-01','');
INSERT INTO nomina_tipos_horas VALUES('01','Dobles');
INSERT INTO nomina_tipos_horas VALUES('02','Triples');
INSERT INTO nomina_tipos_horas VALUES('03','Simples');
INSERT INTO nomina_tipos_incapacidades VALUES('01','Riesgo de trabajo.');
INSERT INTO nomina_tipos_incapacidades VALUES('02','Enfermedad en general.');
INSERT INTO nomina_tipos_incapacidades VALUES('03','Maternidad.');
INSERT INTO nomina_tipos_incapacidades VALUES('04','Licencia por cuidados médicos de hijos diagnosticados con cáncer.');
INSERT INTO nomina_tipos_jornadas VALUES('01','Diurna');
INSERT INTO nomina_tipos_jornadas VALUES('02','Nocturna');
INSERT INTO nomina_tipos_nominas VALUES('O','Nómina ordinaria');
INSERT INTO nomina_tipos_nominas VALUES('E','Nómina extraordinaria');
INSERT INTO nomina_tipos_otros_pagos VALUES('001','Reintegro de ISR pagado en exceso (siempre que no haya sido enterado al SAT).','2017-01-01','');
INSERT INTO nomina_tipos_otros_pagos VALUES('999','Pagos distintos a los listados y que no deben considerarse como ingreso por sueldos, salarios o ingresos asimilados.','2017-01-01','');
INSERT INTO nomina_tipos_percepciones VALUES('001','Sueldos, Salarios  Rayas y Jornales','2016-11-01','');
INSERT INTO nomina_tipos_percepciones VALUES('050','Viáticos','2017-01-06','');
INSERT INTO nomina_tipos_regimenes VALUES('02','Sueldos (Incluye ingresos señalados en la fracción I del artículo 94 de LISR)','2017-01-01','');
INSERT INTO nomina_tipos_regimenes VALUES('99','Otro Regimen','2017-01-01','');
INSERT INTO nomina_tipos_contratos VALUES('01','Contrato de trabajo por tiempo indeterminado');
INSERT INTO nomina_tipos_contratos VALUES('99','Otro contrato');
COMMIT;
