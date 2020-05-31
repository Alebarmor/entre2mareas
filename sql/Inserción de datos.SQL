INSERT INTO encargado (oid_encargado,oid_dni,pass,nombre,edad,telefono) VALUES (1,'12345678D','antper','Antonio Perez',25,654389775);
-
-
-
-

INSERT INTO cliente (oid_cliente,dni_cliente,nombre,pedidos) VALUES (1,'45672344A','Juan Carlos Aragón',22);
-
-
-
-

INSERT INTO carta (oid_producto,precio,cantidad_disponible) VALUES (1,'Serranito de Pollo',2,3);
-
-
-
-

INSERT INTO inventario (oid_producto,cantidad) VALUES (1,'Cajas de Coca-Cola',10);
-
-
-
-

INSERT INTO mesas (oid_mesa,capacidad,disponibilidad,ubicacion) VALUES (1,2,1,2);
-
-
-
-

INSERT INTO pedidos (oid_pedidos,cliente_pedido,producto,cantidad,estado,precio,pagado,fecha,valoracion) VALUES (1,1,'Croquetas',10,1,date '2019-12-2',25,1,4);
-
-
-
-

--------------------------------------DATOS-------------------------------------------------------------------
-----------------------------------------------------------------------------------------------------------

COMMIT;
