create table m_kecamatan(
	id varchar(5) primary key,
	nama_kecamatan varchar(50)
);
create table m_desa(
	id varchar(5) primary key,
	idkecamatan varchar(5),
	nama_desa varchar(50),
	FOREIGN KEY (idkecamatan) REFERENCES m_kecamatan(id)
);