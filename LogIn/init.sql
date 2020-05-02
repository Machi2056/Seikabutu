create database login_db;

grant all on login_db.* to dbuser@localhost identified by 'gb8fJec7';

use login_db

create table users (
  id int not null auto_increment primary key,
  username varchar(255) unique,
  password varchar(255)
);

desc users;



test
INSERT INTO users (username, password) VALUES ('taro123', '$2y$10$EcOB0a2Yw1aqEOvcEYl4g.dRc.k/O/QtIYnbvpbhl1zVbxIQMilmW');
