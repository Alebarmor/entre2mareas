----------------Eliminacion de tablas-------------------------

drop table encargado;
drop table mesas;
drop table cliente;
drop table pedidos;
drop table carta;
drop table inventario;
drop table ubicacion;
drop table estado;
drop table pagado;
drop table disponibilidad;

-----------------Eliminacion de Secuencias---------------------

drop sequence incre_oid_pedido;
drop sequence incre_oid_cliente;
drop sequence incre_oid_encargado;

create table disponibilidad(
oid_disponibilidad int unique not null,
tipo varchar2(20));
/
insert into disponibilidad values(1,'Disponible');
insert into disponibilidad values(2,'Reservada');
insert into disponibilidad values(3,'Ocupada');


----------------------CREACIÓN DE ENUMERADOS------------------------

create table pagado(
oid_pagado int unique not null,
tipo varchar(20));
/
insert into pagado values(1,'No');
insert into pagado values(2,'Si');


create table estado(
oid_estado int unique not null,
tipo varchar(20));
/
insert into estado values (1,'En preparación');
insert into estado values (2,'Finalizado');


create table ubicacion(
oid_ubicacion int unique not null,
tipo varchar(20));
/
insert into ubicacion values(1,'Salon');
insert into ubicacion values(2,'Terraza');

----------------------CREACIÓN DE TABLAS------------------------

create table inventario(
oid_producto varchar2(20) not null,
cantidad int not null,
check(cantidad between 0 and 150),
primary key(oid_producto));
/

create table carta(
oid_producto varchar2(20) not null,
precio number(12,2) not null,
cantidad_disponible int,
primary key(oid_producto),
check(precio >= 0),
foreign key(oid_producto) references inventario(oid_producto));
/

create table pedidos(
oid_pedidos number(9) not null,
cliente_pedido number(9) not null,
producto varchar2(50) not null,
cantidad int,
estado number(1),
precio number (12,2) not null,
pagado number(1),
fecha date not null,
valoracion int,
primary key(oid_pedidos),
foreign key(producto) references carta(oid_producto),
foreign key(estado) references estado(oid_estado),
foreign key(pagado) references pagado(oid_pagado));
/

create table cliente(
oid_cliente number(9) not null,
dni_cliente varchar2(9) not null,
nombre varchar2(20) not null,
pedidos int,
primary key(oid_cliente),
foreign key(pedidos) references pedidos(oid_pedidos));
/

create table mesas(
oid_mesa number(9) not null,
capacidad int not null,
disponibilidad number(1),
ubicacion number(1) not null,
primary key(oid_mesa),
foreign key(ubicacion) references ubicacion(oid_ubicacion),
foreign key(disponibilidad) references disponibilidad(oid_disponibilidad));
/

create table encargado(
oid_encargado number(9) not null,
oid_dni varchar2(9) not null,
pass varchar2(20) not null,
nombre varchar2(20) not null,
edad int,
telefono number(9),
check(edad between 18 and 99),
primary key(oid_dni));
/

---------------------------------SECUENCIAS-------------------------------

create sequence incre_oid_pedido
increment by 1
start with 1
maxvalue 999999
cycle;

create sequence incre_oid_cliente
increment by 1
start with 1
maxvalue 999999
cycle;

create sequence incre_oid_encargado
increment by 1
start with 1
maxvalue 999999
cycle;

---------------------------------TRIGGERS DE SECUENCIAS-------------------------------

create or replace trigger genera_pk_pedido
before insert on pedidos
for each row 
begin
select incre_oid_pedido.nextval into :new.oid_pedidos from dual;
end;
/

create or replace trigger genera_pk_cliente
before insert on cliente
for each row 
begin
select incre_oid_cliente.nextval into :new.oid_cliente from dual;
end;
/

create or replace trigger genera_pk_encargado
before insert on encargado
for each row 
begin
select incre_oid_encargado.nextval into :new.oid_encargado from dual;
end;
/

create or replace trigger cant_precio_pedido
before insert on pedidos
for each row
begin
select act_precio_x_cant(:new.producto, :new.cantidad) into :new.precio from dual;
end;
/

create or replace trigger insertar_precio
before insert on pedidos
for each row
declare precio_total number(8,2);
begin
    select precio into precio_total
    from pedidos 
    where pedidos.producto=:new.producto;
    precio_total:=precio_total* :new.cantidad;
end;
/

create or replace trigger act_inventario
after insert on pedidos
for each row
declare
    inventario_disponible number;
    cant int;
    cant_carta int;
begin 
    select cantidad into inventario_disponible
    from inventario
    where oid_producto= :new.producto;
    
    select cantidad into cant
    from pedidos
    where producto= :new.producto;
    
    update inventario set cantidad = inventario_disponible - cant where oid_producto= :new.producto;
end;
/

--------------------------------------------FUNCTION-------------------------------------------------------

create or replace function act_precio_x_cant(
    producto varchar2,
    cantidad number)
    return number
is 
    precio_producto number(12,2);
    precio_total number(12,2);
begin
    select precio into precio_producto
    from carta
    where producto=oid_producto;
    
    precio_total:= precio_producto*cantidad;
    return precio_total;
end act_precio_x_cant;
/

----------------------------------------------PROCEDIMIENTOS---------------------------------------

-----------------INSERTAR UN PEDIDO------------------

create or replace procedure insertar_pedido(
    consumicion varchar2,
    cliente varchar2,
    num_pedido int
)
is
begin
    insert into pedidos(producto, precio)
    select carta.oid_producto, carta.precio
    from carta
    where carta.oid_producto=consumicion;
    update pedidos set oid_pedidos=num_pedido where cliente_pedido=cliente;
end;
/

-----------------------------ESTO COMPRUEBA EL FORMATO DE DNI Y TELÉFONO---------------------------------------------------

alter table encargado add constraint ck_dni check (regexp_like(oid_dni, '[0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][A-Z]'));
alter table cliente add constraint ck_dni_cliente check (regexp_like(dni_cliente, '[0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][A-Z]'));
alter table encargado add constraint ck_telefono check (regexp_like(telefono, '[0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9]'));

-----------------------------ESTO COMPRUEBA QUE VALORACIÓN SEA ENTRE 0-5---------------------------------------------------

create or replace trigger check_valoracion
after insert or update on pedidos
for each row
declare
valoracion number(1,0) := :new.valoracion;
begin
if valoracion > 5 or valoracion < 0 then
RAISE_APPLICATION_ERROR(-20600, 'La valoracion debe estar entre 0 y 5');
end if;
end;
/

--------------------------ESTO ELIMINA UN PRODUCTO DE LA BASE DE DATOS CUANDO SE QUEDA SIN EXISTENCIAS----------------------

create or replace trigger check_stock
after insert or update on inventario
for each row
begin
    if :new.cantidad = 0 then
    delete from carta where cantidad_disponible = 0;
    end if;
end;
/