drop table if exists utente cascade;
drop table if exists camere cascade;
drop table if exists prenotazioni cascade; 
drop table if exists recensioni cascade;


create table utente (
	nome varchar(30) not null,
	cognome varchar(30) not null,
	email varchar(80) not null unique,
	password varchar(255) not null,
	immagine_profilo varchar(255) default 'default_acc.png',
	id serial primary key
);

create table camere (
 	numero int primary key,
  	tipo varchar(20),
  	prezzo numeric(7,2)
);

create table prenotazioni( 
	utente int,
  	arrivo date,
  	partenza date,
  	numeroCamera int,
  	prezzo numeric(7,2),
  	id serial primary key
);

create table recensioni (
	email varchar(50) ,
	nome varchar(20) not null,
	recensione varchar (230) not null,
	star integer not null,
	foto varchar(128) default 'default_acc.png',
	id serial primary key,
	dd date default now()
);


insert into camere values(1,'singola',39);
insert into camere values(2,'singola',39);
insert into camere values(3,'matrimoniale',49);
insert into camere values(4,'matrimoniale',49);
insert into camere values(5,'tripla',59);
insert into camere values(6,'tripla',59);

insert into prenotazioni values (1,'2020-05-20','2020-05-25',2,195);
insert into prenotazioni values (2,'2020-05-20','2020-05-25',1,195);
insert into prenotazioni values (3,'2020-05-20','2020-05-25',3,245);
insert into prenotazioni values (4,'2020-05-20','2020-05-25',4,245);

grant all privileges on all tables in schema public TO postgres;
grant all privileges on all sequences in schema public TO postgres;



select * from camere;
select * from utente;
select * from prenotazioni;
select * from recensioni;