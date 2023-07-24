create table m_kecamatan(
	id varchar(5) primary key,
	nama_kecamatan varchar(50)
);
create table m_desa(
	id varchar(10) primary key,
	idkecamatan varchar(5),
	nama_desa varchar(50),
	FOREIGN KEY (idkecamatan) REFERENCES m_kecamatan(id)
);
create table m_penduduk(
    id int primary key,
    nik varchar(20),
    idkeluarga varchar(15),
    nama varchar(100),
    idkecamatan varchar(5),
    iddesa varchar(10),
    tgllahir date,
    alamat varchar(100),
    jk int,
    statuskawin varchar(5),
    statusdikeluarga int,
    pendidikan int,
    statusbekerja int,
    FOREIGN KEY (idkecamatan) REFERENCES m_kecamatan(id),
    FOREIGN KEY (iddesa) REFERENCES m_desa(id)
);
create table tr_penerima_bantuan(
    id int primary key ,
    idpenduduk int,
    ispenerima_bpnt int,
    ispenerima_bpum int,
    ispenerima_bst int,
    ispenerima_pkh int,
    ispenerima_sembako int,
    FOREIGN KEY (idpenduduk) REFERENCES m_penduduk(id)
);
create table m_config_shape_kecamatan(
    id int primary key,
    idkecamatan varchar(5),
    filegeojson varchar(50),
    warna varchar(25),
    foreign key (idkecamatan) references m_kecamatan(id)
);
