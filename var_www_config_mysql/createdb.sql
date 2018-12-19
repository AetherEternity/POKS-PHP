create database `poks-php`;
use `poks-php`;
create table `chars`(
  id int primary key,
  name varchar (32),
  power int,
  health int,
  level int,
  experience int,
  points int
);
create user 'poksphpapp'@'localhost' identified by 'PASSWORD-CHANGEME';
grant select, insert, update, delete on `poks-php`.* to 'poksphpapp'@'localhost';
flush privileges;
