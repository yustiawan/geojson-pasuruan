create table m_jeniskepemilikanrumah(
    idstatuskepemilikanrumah int primary key,
    namastatuskepemilikanrumah varchar(50)
);
insert into m_jeniskepemilikanrumah values(1,"Bebas Sewa"),(2,"Dinas"),(3,"Kontrak/Sewa"),(4,"Menumpang"),
(5,"Milik Sendiri"),(6,"Lainnya");

create table m_jenisatap(
    idjenisatap int primary key,
    namajenisatap varchar(50)
);
insert into m_jenisatap values(1,"Asbes/Seng"),(2,"Bambu"),(3,"Beton"),(4,"Genteng"),(5,"Kayu/Sirap"),(6,"Lainnya");

create table m_jenisdinding(
    idjenisdinding int primary key ,
    namajenisdinding varchar(50)
);
insert into m_jenisdinding values(1,"Bambu"),(2,"Kayu/Papan"),(3,"Seng"),(4,"Tembok"),(5,"Lainnya");

create table m_jenislantai(
    idjenislantai int primary key ,
    namajenislantai varchar(50)
);
insert into m_jenislantai values(1,"Bambu"),(2,"Kayu/Papan"),(3,"Keramik/Granit/Marmer/Ubin/Tegel/Teraso"),(4,"Semen"),
(5,"Tanah"),(6,"Lainnya");

create table m_sumberjenispenerangan(
    idjenissumberpenerangan int primary key ,
    namajenissumberpenerangan varchar(50)
);
insert into m_sumberjenispenerangan values(1,"Genset/Solar cell"),(2,"Listrik Bersama"),(3,"Listrik Pribadi > 900 Watt"),
(4,"Listrik Pribadi s/d 900 Watt"),(5,"Non-Listrik");

create table m_bahanbakarmasak(
    idbahanbakarmasak int primary key ,
    namabahanbakarmasak varchar(50)
);
insert into m_bahanbakarmasak values(1,"Arang/Kayu"),(2,"Listrik/Gas"),(3,"Minyak Tanah"),(4,"Lainnya")

create table m_sumberminum(
    idsumberminum int primary key ,
    namasumberminum varchar(50)
);
insert into m_sumberminum values(1,"Air Hujan"),(2,"Air Kemasan/Isi Ulang"),(3,"Air Permukaan (Sungai, Danau, dll)"),
(4,"Ledeng/PAM"),(5,"Sumur Bor"),(6,"Sumur Terlindung"),(7,"Sumur Tidak Terlindung"),(8,"Lainnya");

create table m_statuskepemilikanfasilbab(
    idismilikifasilitasbab int primary key,
    namastatuskepemilikan varchar(50)
);
insert into m_statuskepemilikanfasilbab values(1,"Tidak, Jamban Umum/Bersama"),(2,"Ya, dengan Septic Tank"),
(3,"Ya, tanpa Septic Tank"),(4,"Lainnya");

create table tr_fasilitasrumah(
    id int primary key ,
    idpenduduk int,
    idstatuskepemilikanrumah int,
    ispunyasimpanan int,
    idjenisatap int,
    idjenisdinding int,
    idjenislantai int,
    idjenissumberpenerangan int,
    idbahanbakarmasak int,
    idsumberminum int,
    ismilikifasilitasbab int,
    FOREIGN KEY (idpenduduk) REFERENCES m_penduduk(id)
);
