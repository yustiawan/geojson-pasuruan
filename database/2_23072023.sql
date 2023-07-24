create table m_status_pendidikan(
    id int primary key,
    status_pendidikan varchar(100)
);
insert into m_status_pendidikan values(0,"Tidak/belum sekolah"),(1,"Tamat SD/sederajat"),(2,"Tamat SMP/sederajat")
,(3,"Tamat SMA/sederajat"),(4,"Tamat Perguruan Tinggi"),(11,"Tidak Tamat SD/sederajat"),
(12,"Belum Tamat SD/sederajat"),(13,"Siswa SD/sederajat"),(21,"Siswa SMP/sederajat"),(31,"Siswa SMA/sederajat")
,(41,"Mahasiswa Perguruan Tinggi");

create table m_jenis_pekerjaan(
    id int primary key,
    status_jenis_pekerjaan varchar(100)
);
 insert into m_jenis_pekerjaan values(0,"Tidak/belum bekerja"),(1,"Pegawai Swasta"),(2,"Wiraswasta"),(3,"Nelayan")
 ,(4,"Pedagang"),(5,"Pekerja Lepas"),(6,"Pensiunan"),(7,"Petani"),(8,"Lainnya");
