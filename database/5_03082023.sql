create table m_jenis_user(
     id int primary key ,
     namajenisuser varchar(50)
);
insert into m_jenis_user values(0,'Super Admin'),(1,'Administrator'),(2,'Sekretaris Daerah'),(3,'OPD');
create table m_user(
   username varchar(50) primary key,
   nama varchar(50),
   jenisuser int,
   password varchar(100)
);
insert into m_user values('adiyus','adi yus',0,md5('adiyus123'));
create table m_login(
    username varchar(50),
    jenisuser int,
    token varchar(250),
    loginat datetime,
    logoutat datetime
);
