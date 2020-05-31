INSERT INTO encargado (oid_encargado,oid_dni,pass,nombre,edad,telefono) VALUES (1,'82228614A','antper','Antonio Perez',25,654389775);
INSERT INTO encargado (oid_encargado,oid_dni,pass,nombre,edad,telefono) VALUES (2,'31673388L','marcrissor','Maria-Cristina Soriano',36,646328751);
INSERT INTO encargado (oid_encargado,oid_dni,pass,nombre,edad,telefono) VALUES (3,'20931388P','virabe','Virtudes Abellan',33,648632198);

INSERT INTO mesas (oid_mesa,capacidad,disponibilidad,ubicacion) VALUES (1,2,3,1);
INSERT INTO mesas (oid_mesa,capacidad,disponibilidad,ubicacion) VALUES (2,2,1,1);
INSERT INTO mesas (oid_mesa,capacidad,disponibilidad,ubicacion) VALUES (3,4,1,1);
INSERT INTO mesas (oid_mesa,capacidad,disponibilidad,ubicacion) VALUES (4,4,3,2);

INSERT INTO inventario (oid_producto,cantidad) VALUES ('Coca-Cola',253);
INSERT INTO inventario (oid_producto,cantidad) VALUES ('Coca-Cola Zero',168);
INSERT INTO inventario (oid_producto,cantidad) VALUES ('Cerveza Cruzcampo',320);
INSERT INTO inventario (oid_producto,cantidad) VALUES ('Botella de agua',400);
INSERT INTO inventario (oid_producto,cantidad) VALUES ('Aquarius de Limón',179);
INSERT INTO inventario (oid_producto,cantidad) VALUES ('Aquarius de Naranja',157);
INSERT INTO inventario (oid_producto,cantidad) VALUES ('Zumo de Piña',253);
INSERT INTO inventario (oid_producto,cantidad) VALUES ('Zumo de Manzana',253);
INSERT INTO inventario (oid_producto,cantidad) VALUES ('Serranito de Pollo',162);
INSERT INTO inventario (oid_producto,cantidad) VALUES ('Serranito de Lomo',67);
INSERT INTO inventario (oid_producto,cantidad) VALUES ('Sandwich de Jamon York y Queso',153);
INSERT INTO inventario (oid_producto,cantidad) VALUES ('Sandwich de Paté',169);
INSERT INTO inventario (oid_producto,cantidad) VALUES ('Jamón Ibérico',25);
INSERT INTO inventario (oid_producto,cantidad) VALUES ('Pizza Mozarella',75);
INSERT INTO inventario (oid_producto,cantidad) VALUES ('Pizza Jamon York y Queso',48);
INSERT INTO inventario (oid_producto,cantidad) VALUES ('Pizza 4 Quesos',53);
INSERT INTO inventario (oid_producto,cantidad) VALUES ('Langostinos',136);
INSERT INTO inventario (oid_producto,cantidad) VALUES ('Gambas',60);
INSERT INTO inventario (oid_producto,cantidad) VALUES ('Sardinas',56);
INSERT INTO inventario (oid_producto,cantidad) VALUES ('Lubina',53);
INSERT INTO inventario (oid_producto,cantidad) VALUES ('Cazón',98);
INSERT INTO inventario (oid_producto,cantidad) VALUES ('Boquerones',123);
INSERT INTO inventario (oid_producto,cantidad) VALUES ('Acedias',25);
INSERT INTO inventario (oid_producto,cantidad) VALUES ('Rabo de Toro',45);
INSERT INTO inventario (oid_producto,cantidad) VALUES ('San Jacobo',47);
INSERT INTO inventario (oid_producto,cantidad) VALUES ('Tortilla de Patatas',133);
INSERT INTO inventario (oid_producto,cantidad) VALUES ('Flamenquines',98);
INSERT INTO inventario (oid_producto,cantidad) VALUES ('Papas con Ali-Oli',58);
INSERT INTO inventario (oid_producto,cantidad) VALUES ('Enlasadilla Rusa',45);

INSERT INTO carta (oid_producto,precio,cantidad_disponible) VALUES ('Coca-Cola',1,103);
INSERT INTO carta (oid_producto,precio,cantidad_disponible) VALUES ('Coca-Cola Zero',1.25,79);
INSERT INTO carta (oid_producto,precio,cantidad_disponible) VALUES ('Cerveza Cruzcampo',1.5,120);
INSERT INTO carta (oid_producto,precio,cantidad_disponible) VALUES ('Botella de agua',0.5,187);
INSERT INTO carta (oid_producto,precio,cantidad_disponible) VALUES ('Aquarius de Limón',1.25,70);
INSERT INTO carta (oid_producto,precio,cantidad_disponible) VALUES ('Aquarius de Naranja',1.25,70);
INSERT INTO carta (oid_producto,precio,cantidad_disponible) VALUES ('Zumo de Piña',0.75,78);
INSERT INTO carta (oid_producto,precio,cantidad_disponible) VALUES ('Zumo de Manzana',0.75,80);
INSERT INTO carta (oid_producto,precio,cantidad_disponible) VALUES ('Serranito de Pollo',1.5,35);
INSERT INTO carta (oid_producto,precio,cantidad_disponible) VALUES ('Serranito de Lomo',1.5,28);
INSERT INTO carta (oid_producto,precio,cantidad_disponible) VALUES ('Sandwich de Jamon York y Queso',2.5,68);
INSERT INTO carta (oid_producto,precio,cantidad_disponible) VALUES ('Sandwich de Paté',2.5,85);
INSERT INTO carta (oid_producto,precio,cantidad_disponible) VALUES ('Jamón Ibérico',1.75,15);
INSERT INTO carta (oid_producto,precio,cantidad_disponible) VALUES ('Pizza Mozarella',3.25,65);
INSERT INTO carta (oid_producto,precio,cantidad_disponible) VALUES ('Pizza Jamon York y Queso',3.5,40);
INSERT INTO carta (oid_producto,precio,cantidad_disponible) VALUES ('Pizza 4 Quesos',3.5,50);
INSERT INTO carta (oid_producto,precio,cantidad_disponible) VALUES ('Sardinas',4.5,28);
INSERT INTO carta (oid_producto,precio,cantidad_disponible) VALUES ('Cazón',5.5,80);
INSERT INTO carta (oid_producto,precio,cantidad_disponible) VALUES ('Boquerones',3.75,86);
INSERT INTO carta (oid_producto,precio,cantidad_disponible) VALUES ('Acedias',4.25,16);
INSERT INTO carta (oid_producto,precio,cantidad_disponible) VALUES ('San Jacobo',2.75,30);
INSERT INTO carta (oid_producto,precio,cantidad_disponible) VALUES ('Tortilla de Patatas',2,88);
INSERT INTO carta (oid_producto,precio,cantidad_disponible) VALUES ('Flamenquines',2,65);
INSERT INTO carta (oid_producto,precio,cantidad_disponible) VALUES ('Papas con Ali-Oli',2.15,45);

INSERT INTO cliente (oid_cliente,dni_cliente,nombre,pedidos) VALUES (1,'18782489E','Juan Carlos Aragón',4);
INSERT INTO cliente (oid_cliente,dni_cliente,nombre,pedidos) VALUES (2,'92859061B','Bernat de La Rosa',2);
INSERT INTO cliente (oid_cliente,dni_cliente,nombre,pedidos) VALUES (3,'77931606Q','Luis Alfonso Betancor',3);
INSERT INTO cliente (oid_cliente,dni_cliente,nombre,pedidos) VALUES (4,'77077502V','Marcial Miralles',3);


INSERT INTO pedidos (oid_pedidos,cliente_pedido,producto,cantidad,estado,fecha,precio,pagado,valoracion,numMesa) VALUES (1,1,'Cerveza Cruzcampo',2,1,date '2020-6-2',3,1,4,1);
INSERT INTO pedidos (oid_pedidos,cliente_pedido,producto,cantidad,estado,fecha,precio,pagado,valoracion,numMesa) VALUES (2,1,'Boquerones',1,1,date '2020-6-2',3.75,1,5,1);
INSERT INTO pedidos (oid_pedidos,cliente_pedido,producto,cantidad,estado,fecha,precio,pagado,valoracion,numMesa) VALUES (3,1,'Acedías',1,1,date '2020-6-2',4.25,1,4,1);
INSERT INTO pedidos (oid_pedidos,cliente_pedido,producto,cantidad,estado,fecha,precio,pagado,valoracion,numMesa) VALUES (4,1,'Sardinas',1,1,date '2020-6-2',4.5,1,4,2);
INSERT INTO pedidos (oid_pedidos,cliente_pedido,producto,cantidad,estado,fecha,precio,pagado,valoracion,numMesa) VALUES (5,2,'Cerveza Cruzcampo',3,1,date '2020-6-2',4.5,1,5,2);
INSERT INTO pedidos (oid_pedidos,cliente_pedido,producto,cantidad,estado,fecha,precio,pagado,valoracion,numMesa) VALUES (6,2,'Coca-Cola Zero',3,1,date '2020-6-2',3.75,1,5,2);
INSERT INTO pedidos (oid_pedidos,cliente_pedido,producto,cantidad,estado,fecha,precio,pagado,valoracion,numMesa) VALUES (7,3,'Coca-Cola',4,1,date '2020-6-2',4,1,5,3);
INSERT INTO pedidos (oid_pedidos,cliente_pedido,producto,cantidad,estado,fecha,precio,pagado,valoracion,numMesa) VALUES (8,3,'Pizza 4 Quesos',1,1,date '2020-6-2',3.5,1,3,3);
INSERT INTO pedidos (oid_pedidos,cliente_pedido,producto,cantidad,estado,fecha,precio,pagado,valoracion,numMesa) VALUES (9,3,'Pizza Jamon York y Queso',1,1,date '2020-6-2',3.5,1,4,3);
INSERT INTO pedidos (oid_pedidos,cliente_pedido,producto,cantidad,estado,fecha,precio,pagado,valoracion,numMesa) VALUES (10,4,'Cerveza Cruzcampo',2,1,date '2020-6-2',2.5,1,4,4);
INSERT INTO pedidos (oid_pedidos,cliente_pedido,producto,cantidad,estado,fecha,precio,pagado,valoracion,numMesa) VALUES (11,4,'Papas con Ali-Oli',1,1,date '2020-6-2',2.15,1,4,4);
INSERT INTO pedidos (oid_pedidos,cliente_pedido,producto,cantidad,estado,fecha,precio,pagado,valoracion,numMesa) VALUES (12,4,'Serranito de Pollo',1,1,date '2020-6-2',1.5,1,5,4);


--INSERT INTO pedidos (oid_pedidos,cliente_pedido,producto,cantidad,estado,fecha,pagado,valoracion,numMesa) VALUES (1,1,'Cerveza Cruzcampo',2,1,date '2020-6-2',1,4,1);
--INSERT INTO pedidos (oid_pedidos,cliente_pedido,producto,cantidad,estado,fecha,precio,pagado,valoracion,numMesa) VALUES (2,1,'Boquerones',1,1,date '2020-6-2',3.75,1,5,1);
--INSERT INTO pedidos (oid_pedidos,cliente_pedido,producto,cantidad,estado,fecha,pagado,valoracion,numMesa) VALUES (3,1,'Acedías',1,1,date '2020-6-2',1,4,1);
--INSERT INTO pedidos (oid_pedidos,cliente_pedido,producto,cantidad,estado,fecha,pagado,valoracion,numMesa) VALUES (4,1,'Sardinas',1,1,date '2020-6-2',1,4,2);
--INSERT INTO pedidos (oid_pedidos,cliente_pedido,producto,cantidad,estado,fecha,pagado,valoracion,numMesa) VALUES (5,2,'Cerveza Cruzcampo',3,1,date '2020-6-2',1,5,2);
--INSERT INTO pedidos (oid_pedidos,cliente_pedido,producto,cantidad,estado,fecha,pagado,valoracion,numMesa) VALUES (6,2,'Coca-Cola Zero',3,1,date '2020-6-2',1,5,2);
--INSERT INTO pedidos (oid_pedidos,cliente_pedido,producto,cantidad,estado,fecha,pagado,valoracion,numMesa) VALUES (7,3,'Coca-Cola',4,1,date '2020-6-2',1,5,3);
--INSERT INTO pedidos (oid_pedidos,cliente_pedido,producto,cantidad,estado,fecha,pagado,valoracion,numMesa) VALUES (8,3,'Pizza 4 Quesos',1,1,date '2020-6-2',1,3,3);
--INSERT INTO pedidos (oid_pedidos,cliente_pedido,producto,cantidad,estado,fecha,pagado,valoracion,numMesa) VALUES (9,3,'Pizza Jamon York y Queso',1,1,date '2020-6-2',1,4,3);
--INSERT INTO pedidos (oid_pedidos,cliente_pedido,producto,cantidad,estado,fecha,pagado,valoracion,numMesa) VALUES (10,4,'Cerveza Cruzcampo',2,1,date '2020-6-2',1,4,4);
--INSERT INTO pedidos (oid_pedidos,cliente_pedido,producto,cantidad,estado,fecha,pagado,valoracion,numMesa) VALUES (11,4,'Papas con Ali-Oli',1,1,date '2020-6-2',1,4,4);
--INSERT INTO pedidos (oid_pedidos,cliente_pedido,producto,cantidad,estado,fecha,pagado,valoracion,numMesa) VALUES (12,4,'Serranito de Pollo',1,1,date '2020-6-2',1,5,4);

SELECT * FROM CARTA ORDER BY OID_PRODUCTO, PRECIO;
UPDATE CARTA SET PRECIO = 332, CANTIDAD_DISPONIBLE = :cantidad_disponible WHERE OID_PRODUCTO = :oid_producto;
	

COMMIT;
