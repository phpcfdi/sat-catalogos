PRAGMA foreign_keys=OFF;
BEGIN TRANSACTION;

CREATE TABLE cfdi_aduanas (
  id text not null primary key,
  texto text not null,
  vigencia_desde text not null,
  vigencia_hasta text not null
);
INSERT INTO cfdi_aduanas VALUES('24','NUEVO LAREDO, NUEVO LAREDO, TAMAULIPAS.','2017-01-01','');

CREATE TABLE cfdi_productos_servicios (
  id text not null primary key,
  texto text not null,
  iva_trasladado int not null,
  ieps_trasladado int not null,
  complemento text not null,
  similares text not null,
  vigencia_desde text not null,
  vigencia_hasta text not null
);
INSERT INTO cfdi_productos_servicios VALUES
('10101511','Cerdos',0,0,'','Cerdo montés, Chanchos, Chanchos almizcleros, Chanchos de monte, Cochinillos, Cochinos, Cochinos de monte, Cuche, Cuinos, Gorrinos, Jabalíes americanos, Lechones, Cochinos de monte, Pecaríes, Porcinos, Puercos, Puercos de monte, Tayatos','2017-01-01','');

CREATE TABLE cfdi_codigos_postales (
  id text not null primary key,
  estado text not null,
  municipio text not null,
  localidad text not null
);
INSERT INTO cfdi_codigos_postales VALUES('52000','MEX','051','');

CREATE TABLE cfdi_claves_unidades (
  id text not null primary key,
  texto text not null,
  descripcion text not null,
  notas text not null,
  simbolo text not null,
  vigencia_desde text not null,
  vigencia_hasta text not null
);
INSERT INTO cfdi_claves_unidades VALUES
('MTK','Metro cuadrado','Es la unidad básica de superficie en el Sistema Internacional de Unidades. Si a esta unidad se antepone un prefijo del Sistema Internacional se crea un múltiplo o submúltiplo de esta.','','m²','2017-01-01','');

CREATE TABLE cfdi_impuestos (
  id text not null primary key,
  texto text not null,
  retencion int not null,
  traslado int not null,
  ambito text not null,
  entidad text not null
);
INSERT INTO cfdi_impuestos VALUES('002','IVA',1,1,'Federal','');

CREATE TABLE cfdi_formas_pago (
  id text not null primary key,
  texto text not null,
  es_bancarizado int not null,
  requiere_numero_operacion int not null,
  permite_banco_ordenante_rfc int not null,
  permite_cuenta_ordenante int not null,
  patron_cuenta_ordenante string not null,
  permite_banco_beneficiario_rfc int not null,
  permite_cuenta_beneficiario int not null,
  patron_cuenta_beneficiario string not null,
  permite_tipo_cadena_pago int not null,
  requiere_banco_ordenante_nombre_ext int not null,
  vigencia_desde text not null,
  vigencia_hasta text not null
);
INSERT INTO cfdi_formas_pago VALUES
('03','Transferencia electrónica de fondos',1,0,1,1,'[0-9]{10}|[0-9]{16}|[0-9]{18}',1,1,'[0-9]{10}|[0-9]{18}',1,1,'2017-01-01','');

CREATE TABLE cfdi_metodos_pago (
  id text not null primary key,
  texto text not null,
  vigencia_desde text not null,
  vigencia_hasta text not null
);
INSERT INTO cfdi_metodos_pago VALUES('PUE','Pago en una sola exhibición','2017-01-01','');

CREATE TABLE cfdi_monedas (
  id text not null primary key,
  texto text not null,
  decimales int not null,
  porcentaje_variacion int not null,
  vigencia_desde text not null,
  vigencia_hasta text not null
);
INSERT INTO cfdi_monedas VALUES('MXN','Peso Mexicano',2,500,'2017-01-01','');

CREATE TABLE cfdi_paises (
  id text not null primary key,
  texto text not null,
  patron_codigo_postal text not null,
  patron_identidad_tributaria text not null,
  validacion_identidad_tributaria text not null,
  agrupaciones text not null
);
INSERT INTO cfdi_paises VALUES('MEX','México','[0-9]{5}',replace('[A-Z&Ñ]{3,4}[0-9]{2}(0[1-9]|1[012])(0[1-9]|[12][0-9]|3[01])[A-Z0-9]{2}[0\n-9A]','\n',char(10)),'Lista del SAT','TLCAN');

CREATE TABLE cfdi_regimenes_fiscales (
  id text not null primary key,
  texto text not null,
  aplica_fisica boolean not null,
  aplica_moral boolean not null,
  vigencia_desde text not null,
  vigencia_hasta text not null
);
INSERT INTO cfdi_regimenes_fiscales VALUES('601','General de Ley Personas Morales',0,1,'2016-11-12','');

CREATE TABLE cfdi_usos_cfdi (
  id text not null primary key,
  texto text not null,
  aplica_fisica boolean not null,
  aplica_moral boolean not null,
  vigencia_desde text not null,
  vigencia_hasta text not null
);
INSERT INTO cfdi_usos_cfdi VALUES('G02','Devoluciones, descuentos o bonificaciones',1,1,'2017-01-01','');

CREATE TABLE cfdi_tipos_relaciones (
  id text not null primary key,
  texto text not null,
  vigencia_desde text not null,
  vigencia_hasta text not null
);
INSERT INTO cfdi_tipos_relaciones VALUES('05','Traslados de mercancias facturados previamente','2017-01-01','');

CREATE TABLE cfdi_tipos_factores (
  id text not null primary key
);
INSERT INTO cfdi_tipos_factores VALUES('Tasa');

CREATE TABLE cfdi_numeros_pedimento_aduana (
  aduana text not null,
  patente text not null,
  ejercicio int not null,
  cantidad int not null,
  vigencia_desde text not null,
  vigencia_hasta text not null,
  PRIMARY KEY (aduana, patente, ejercicio)
);
INSERT INTO cfdi_numeros_pedimento_aduana VALUES('43','3420',2018,999999,'2017-01-01','');

CREATE TABLE cfdi_reglas_tasa_cuota (
  tipo text not null,
  minimo text not null,
  valor text not null,
  impuesto text not null,
  factor text not null,
  traslado int not null,
  retencion int not null,
  vigencia_desde text not null,
  vigencia_hasta text not null
);
INSERT INTO cfdi_reglas_tasa_cuota VALUES
('Fijo', '', '0.000000', 'IVA', 'Tasa', 1, 0, '2017-01-01', ''),
('Fijo', '', '0.160000', 'IVA', 'Tasa', 1, 0, '2017-01-01', ''),
('Rango', '0.000000', '43.770000', 'IEPS', 'Cuota', 1, 1, '2017-01-01', ''),
('Rango', '0.000000', '0.350000', 'ISR', 'Tasa', 0, 1, '2017-01-01', '');

CREATE TABLE cfdi_patentes_aduanales (
  id text not null primary key,
  texto text not null,
  vigencia_desde text not null,
  vigencia_hasta text not null
);
INSERT INTO cfdi_patentes_aduanales VALUES('0000','0000','2000-01-01','');

CREATE TABLE cfdi_tipos_comprobantes (
  id text not null primary key,
  texto text not null,
  valor_maximo text not null,
  vigencia_desde text not null,
  vigencia_hasta text not null
);
INSERT INTO cfdi_tipos_comprobantes VALUES('I','Ingreso', '999999999999999999.999999', '2000-07-29','');

COMMIT;
