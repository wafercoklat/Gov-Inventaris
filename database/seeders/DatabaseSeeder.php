<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
use Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => strtolower('Admin'),
            'username' => strtolower('admin'),
            'password' => Hash::make('admin123'),
            'role' => strtolower('admin')
        ]);

        DB::insert('insert into ruangan (IdRuangan, Code, Name, NUP, Keterangan, Counter, created_at, updated_at) values (?, ?,?, ?,?, ?,?, ?)', ['1','R-TP','Ruang Tunggu PTSP',NULL,NULL,NULL,'2021-08-24','2021-08-24']);
        DB::insert('insert into ruangan (IdRuangan, Code, Name, NUP, Keterangan, Counter, created_at, updated_at) values (?, ?,?, ?,?, ?,?, ?)', ['2','R-BP','Ruang Bisnis Proses',NULL,NULL,NULL,'2021-08-24','2021-08-24']);
        DB::insert('insert into ruangan (IdRuangan, Code, Name, NUP, Keterangan, Counter, created_at, updated_at) values (?, ?,?, ?,?, ?,?, ?)', ['3','R-SU','Ruang Sidang Utama',NULL,NULL,NULL,'2021-08-24','2021-08-24']);
        DB::insert('insert into ruangan (IdRuangan, Code, Name, NUP, Keterangan, Counter, created_at, updated_at) values (?, ?,?, ?,?, ?,?, ?)', ['4','R-SAM','Ruang Sidang Abu Musa',NULL,NULL,NULL,'2021-08-24','2021-08-24']);
        DB::insert('insert into ruangan (IdRuangan, Code, Name, NUP, Keterangan, Counter, created_at, updated_at) values (?, ?,?, ?,?, ?,?, ?)', ['5','R-SS','Ruang Sidang Syiriyah',NULL,NULL,NULL,'2021-08-24','2021-08-24']);
        DB::insert('insert into ruangan (IdRuangan, Code, Name, NUP, Keterangan, Counter, created_at, updated_at) values (?, ?,?, ?,?, ?,?, ?)', ['6','R-TL1','Ruang Tunggu Lt.1',NULL,NULL,NULL,'2021-08-24','2021-08-24']);
        DB::insert('insert into ruangan (IdRuangan, Code, Name, NUP, Keterangan, Counter, created_at, updated_at) values (?, ?,?, ?,?, ?,?, ?)', ['7','R-AL1','Ruang Arsip Lt.1',NULL,NULL,NULL,'2021-08-24','2021-08-24']);
        DB::insert('insert into ruangan (IdRuangan, Code, Name, NUP, Keterangan, Counter, created_at, updated_at) values (?, ?,?, ?,?, ?,?, ?)', ['8','R-K','Ruang Ketua',NULL,NULL,NULL,'2021-08-24','2021-08-24']);
        DB::insert('insert into ruangan (IdRuangan, Code, Name, NUP, Keterangan, Counter, created_at, updated_at) values (?, ?,?, ?,?, ?,?, ?)', ['9','R-WK','Ruang Wakil Ketua',NULL,NULL,NULL,'2021-08-24','2021-08-24']);
        DB::insert('insert into ruangan (IdRuangan, Code, Name, NUP, Keterangan, Counter, created_at, updated_at) values (?, ?,?, ?,?, ?,?, ?)', ['10','R-P','Ruang Panitera',NULL,NULL,NULL,'2021-08-24','2021-08-24']);
        DB::insert('insert into ruangan (IdRuangan, Code, Name, NUP, Keterangan, Counter, created_at, updated_at) values (?, ?,?, ?,?, ?,?, ?)', ['11','R-R','Ruang Rapat',NULL,NULL,NULL,'2021-08-24','2021-08-24']);
        DB::insert('insert into ruangan (IdRuangan, Code, Name, NUP, Keterangan, Counter, created_at, updated_at) values (?, ?,?, ?,?, ?,?, ?)', ['12','R-PP','Ruang Panitera Pengganti',NULL,NULL,NULL,'2021-08-24','2021-08-24']);
        DB::insert('insert into ruangan (IdRuangan, Code, Name, NUP, Keterangan, Counter, created_at, updated_at) values (?, ?,?, ?,?, ?,?, ?)', ['13','R-H1','Ruang Hakim I',NULL,NULL,NULL,'2021-08-24','2021-08-24']);
        DB::insert('insert into ruangan (IdRuangan, Code, Name, NUP, Keterangan, Counter, created_at, updated_at) values (?, ?,?, ?,?, ?,?, ?)', ['14','R-H2','Ruang Hakim II',NULL,NULL,NULL,'2021-08-24','2021-08-24']);
        DB::insert('insert into ruangan (IdRuangan, Code, Name, NUP, Keterangan, Counter, created_at, updated_at) values (?, ?,?, ?,?, ?,?, ?)', ['15','R-H3','Ruang Hakim III',NULL,NULL,NULL,'2021-08-24','2021-08-24']);
        DB::insert('insert into ruangan (IdRuangan, Code, Name, NUP, Keterangan, Counter, created_at, updated_at) values (?, ?,?, ?,?, ?,?, ?)', ['16','R-H4','Ruang Hakim IV',NULL,NULL,NULL,'2021-08-24','2021-08-24']);
        DB::insert('insert into ruangan (IdRuangan, Code, Name, NUP, Keterangan, Counter, created_at, updated_at) values (?, ?,?, ?,?, ?,?, ?)', ['17','R-H5','Ruang Hakim V',NULL,NULL,NULL,'2021-08-24','2021-08-24']);
        DB::insert('insert into ruangan (IdRuangan, Code, Name, NUP, Keterangan, Counter, created_at, updated_at) values (?, ?,?, ?,?, ?,?, ?)', ['18','R-M','Mushola',NULL,NULL,NULL,'2021-08-24','2021-08-24']);
        DB::insert('insert into ruangan (IdRuangan, Code, Name, NUP, Keterangan, Counter, created_at, updated_at) values (?, ?,?, ?,?, ?,?, ?)', ['19','R-TL2','Ruang Tunggu Lt.2',NULL,NULL,NULL,'2021-08-24','2021-08-24']);
        DB::insert('insert into ruangan (IdRuangan, Code, Name, NUP, Keterangan, Counter, created_at, updated_at) values (?, ?,?, ?,?, ?,?, ?)', ['20','R-Sek','Ruang Sekretaris',NULL,NULL,NULL,'2021-08-24','2021-08-24']);
        DB::insert('insert into ruangan (IdRuangan, Code, Name, NUP, Keterangan, Counter, created_at, updated_at) values (?, ?,?, ?,?, ?,?, ?)', ['21','R-MC','Ruang Media Center',NULL,NULL,NULL,'2021-08-24','2021-08-24']);
        DB::insert('insert into ruangan (IdRuangan, Code, Name, NUP, Keterangan, Counter, created_at, updated_at) values (?, ?,?, ?,?, ?,?, ?)', ['22','R-Ks','Ruang Kesekretariatan',NULL,NULL,NULL,'2021-08-24','2021-08-24']);
        DB::insert('insert into ruangan (IdRuangan, Code, Name, NUP, Keterangan, Counter, created_at, updated_at) values (?, ?,?, ?,?, ?,?, ?)', ['23','R-Kp','Ruang Kepaniteraan',NULL,NULL,NULL,'2021-08-24','2021-08-24']);
        DB::insert('insert into ruangan (IdRuangan, Code, Name, NUP, Keterangan, Counter, created_at, updated_at) values (?, ?,?, ?,?, ?,?, ?)', ['24','R-JS','Ruang Juru Sita',NULL,NULL,NULL,'2021-08-24','2021-08-24']);
        DB::insert('insert into ruangan (IdRuangan, Code, Name, NUP, Keterangan, Counter, created_at, updated_at) values (?, ?,?, ?,?, ?,?, ?)', ['25','R-Pp','Ruang Perpustakaan',NULL,NULL,NULL,'2021-08-24','2021-08-24']);
        DB::insert('insert into ruangan (IdRuangan, Code, Name, NUP, Keterangan, Counter, created_at, updated_at) values (?, ?,?, ?,?, ?,?, ?)', ['26','R-A3','Ruang Arsip Lt.3',NULL,NULL,NULL,'2021-08-24','2021-08-24']);
        DB::insert('insert into ruangan (IdRuangan, Code, Name, NUP, Keterangan, Counter, created_at, updated_at) values (?, ?,?, ?,?, ?,?, ?)', ['27','R-T3','Ruang Tunggu Lt.3',NULL,NULL,NULL,'2021-08-24','2021-08-24']);

        DB::insert('insert into ruangandetail (IdDetail, idRuangan, idLokasi, created_at, updated_at) values (?, ?,?, ?,?)', ['1','1','1','2021-08-24','2021-08-24']);
        DB::insert('insert into ruangandetail (IdDetail, idRuangan, idLokasi, created_at, updated_at) values (?, ?,?, ?,?)', ['2','2','1','2021-08-24','2021-08-24']);
        DB::insert('insert into ruangandetail (IdDetail, idRuangan, idLokasi, created_at, updated_at) values (?, ?,?, ?,?)', ['3','3','1','2021-08-24','2021-08-24']);
        DB::insert('insert into ruangandetail (IdDetail, idRuangan, idLokasi, created_at, updated_at) values (?, ?,?, ?,?)', ['4','4','1','2021-08-24','2021-08-24']);
        DB::insert('insert into ruangandetail (IdDetail, idRuangan, idLokasi, created_at, updated_at) values (?, ?,?, ?,?)', ['5','5','1','2021-08-24','2021-08-24']);
        DB::insert('insert into ruangandetail (IdDetail, idRuangan, idLokasi, created_at, updated_at) values (?, ?,?, ?,?)', ['6','6','1','2021-08-24','2021-08-24']);
        DB::insert('insert into ruangandetail (IdDetail, idRuangan, idLokasi, created_at, updated_at) values (?, ?,?, ?,?)', ['7','7','1','2021-08-24','2021-08-24']);
        DB::insert('insert into ruangandetail (IdDetail, idRuangan, idLokasi, created_at, updated_at) values (?, ?,?, ?,?)', ['8','8','2','2021-08-24','2021-08-24']);
        DB::insert('insert into ruangandetail (IdDetail, idRuangan, idLokasi, created_at, updated_at) values (?, ?,?, ?,?)', ['9','9','2','2021-08-24','2021-08-24']);
        DB::insert('insert into ruangandetail (IdDetail, idRuangan, idLokasi, created_at, updated_at) values (?, ?,?, ?,?)', ['10','10','2','2021-08-24','2021-08-24']);
        DB::insert('insert into ruangandetail (IdDetail, idRuangan, idLokasi, created_at, updated_at) values (?, ?,?, ?,?)', ['11','11','2','2021-08-24','2021-08-24']);
        DB::insert('insert into ruangandetail (IdDetail, idRuangan, idLokasi, created_at, updated_at) values (?, ?,?, ?,?)', ['12','12','2','2021-08-24','2021-08-24']);
        DB::insert('insert into ruangandetail (IdDetail, idRuangan, idLokasi, created_at, updated_at) values (?, ?,?, ?,?)', ['13','13','2','2021-08-24','2021-08-24']);
        DB::insert('insert into ruangandetail (IdDetail, idRuangan, idLokasi, created_at, updated_at) values (?, ?,?, ?,?)', ['14','14','2','2021-08-24','2021-08-24']);
        DB::insert('insert into ruangandetail (IdDetail, idRuangan, idLokasi, created_at, updated_at) values (?, ?,?, ?,?)', ['15','15','2','2021-08-24','2021-08-24']);
        DB::insert('insert into ruangandetail (IdDetail, idRuangan, idLokasi, created_at, updated_at) values (?, ?,?, ?,?)', ['16','16','2','2021-08-24','2021-08-24']);
        DB::insert('insert into ruangandetail (IdDetail, idRuangan, idLokasi, created_at, updated_at) values (?, ?,?, ?,?)', ['17','17','2','2021-08-24','2021-08-24']);
        DB::insert('insert into ruangandetail (IdDetail, idRuangan, idLokasi, created_at, updated_at) values (?, ?,?, ?,?)', ['18','18','2','2021-08-24','2021-08-24']);
        DB::insert('insert into ruangandetail (IdDetail, idRuangan, idLokasi, created_at, updated_at) values (?, ?,?, ?,?)', ['19','19','2','2021-08-24','2021-08-24']);
        DB::insert('insert into ruangandetail (IdDetail, idRuangan, idLokasi, created_at, updated_at) values (?, ?,?, ?,?)', ['20','20','3','2021-08-24','2021-08-24']);
        DB::insert('insert into ruangandetail (IdDetail, idRuangan, idLokasi, created_at, updated_at) values (?, ?,?, ?,?)', ['21','21','3','2021-08-24','2021-08-24']);
        DB::insert('insert into ruangandetail (IdDetail, idRuangan, idLokasi, created_at, updated_at) values (?, ?,?, ?,?)', ['22','22','3','2021-08-24','2021-08-24']);
        DB::insert('insert into ruangandetail (IdDetail, idRuangan, idLokasi, created_at, updated_at) values (?, ?,?, ?,?)', ['23','23','3','2021-08-24','2021-08-24']);
        DB::insert('insert into ruangandetail (IdDetail, idRuangan, idLokasi, created_at, updated_at) values (?, ?,?, ?,?)', ['24','24','3','2021-08-24','2021-08-24']);
        DB::insert('insert into ruangandetail (IdDetail, idRuangan, idLokasi, created_at, updated_at) values (?, ?,?, ?,?)', ['25','25','3','2021-08-24','2021-08-24']);
        DB::insert('insert into ruangandetail (IdDetail, idRuangan, idLokasi, created_at, updated_at) values (?, ?,?, ?,?)', ['26','26','3','2021-08-24','2021-08-24']);
        DB::insert('insert into ruangandetail (IdDetail, idRuangan, idLokasi, created_at, updated_at) values (?, ?,?, ?,?)', ['27','27','3','2021-08-24','2021-08-24']);

        DB::insert('insert into lokasi (IdLokasi, Code, Name, CreatedBy, created_at, updated_at) values (?, ?,?, ?,?,?)', ['1','LT-1','Lantai 1','Admin','2021-08-24','2021-08-24']);
        DB::insert('insert into lokasi (IdLokasi, Code, Name, CreatedBy, created_at, updated_at) values (?, ?,?, ?,?,?)', ['2','LT-2','Lantai 2','Admin','2021-08-24','2021-08-24']);
        DB::insert('insert into lokasi (IdLokasi, Code, Name, CreatedBy, created_at, updated_at) values (?, ?,?, ?,?,?)', ['3','LT-3','Lantai 3','Admin','2021-08-24','2021-08-24']);

        DB::insert('insert into userrole (id, userid, IdRuangan, created_at, updated_at) values (?, ?,?, ?,?)', ['1','1','1','2021-08-24','2021-08-24']);
        DB::insert('insert into userrole (id, userid, IdRuangan, created_at, updated_at) values (?, ?,?, ?,?)', ['2','1','2','2021-08-24','2021-08-24']);
        DB::insert('insert into userrole (id, userid, IdRuangan, created_at, updated_at) values (?, ?,?, ?,?)', ['3','1','3','2021-08-24','2021-08-24']);
        DB::insert('insert into userrole (id, userid, IdRuangan, created_at, updated_at) values (?, ?,?, ?,?)', ['4','1','4','2021-08-24','2021-08-24']);
        DB::insert('insert into userrole (id, userid, IdRuangan, created_at, updated_at) values (?, ?,?, ?,?)', ['5','1','5','2021-08-24','2021-08-24']);
        DB::insert('insert into userrole (id, userid, IdRuangan, created_at, updated_at) values (?, ?,?, ?,?)', ['6','1','6','2021-08-24','2021-08-24']);
        DB::insert('insert into userrole (id, userid, IdRuangan, created_at, updated_at) values (?, ?,?, ?,?)', ['7','1','7','2021-08-24','2021-08-24']);
        DB::insert('insert into userrole (id, userid, IdRuangan, created_at, updated_at) values (?, ?,?, ?,?)', ['8','1','8','2021-08-24','2021-08-24']);
        DB::insert('insert into userrole (id, userid, IdRuangan, created_at, updated_at) values (?, ?,?, ?,?)', ['9','1','9','2021-08-24','2021-08-24']);
        DB::insert('insert into userrole (id, userid, IdRuangan, created_at, updated_at) values (?, ?,?, ?,?)', ['10','1','10','2021-08-24','2021-08-24']);
        DB::insert('insert into userrole (id, userid, IdRuangan, created_at, updated_at) values (?, ?,?, ?,?)', ['11','1','11','2021-08-24','2021-08-24']);
        DB::insert('insert into userrole (id, userid, IdRuangan, created_at, updated_at) values (?, ?,?, ?,?)', ['12','1','12','2021-08-24','2021-08-24']);
        DB::insert('insert into userrole (id, userid, IdRuangan, created_at, updated_at) values (?, ?,?, ?,?)', ['13','1','13','2021-08-24','2021-08-24']);
        DB::insert('insert into userrole (id, userid, IdRuangan, created_at, updated_at) values (?, ?,?, ?,?)', ['14','1','14','2021-08-24','2021-08-24']);
        DB::insert('insert into userrole (id, userid, IdRuangan, created_at, updated_at) values (?, ?,?, ?,?)', ['15','1','15','2021-08-24','2021-08-24']);
        DB::insert('insert into userrole (id, userid, IdRuangan, created_at, updated_at) values (?, ?,?, ?,?)', ['16','1','16','2021-08-24','2021-08-24']);
        DB::insert('insert into userrole (id, userid, IdRuangan, created_at, updated_at) values (?, ?,?, ?,?)', ['17','1','17','2021-08-24','2021-08-24']);
        DB::insert('insert into userrole (id, userid, IdRuangan, created_at, updated_at) values (?, ?,?, ?,?)', ['18','1','18','2021-08-24','2021-08-24']);
        DB::insert('insert into userrole (id, userid, IdRuangan, created_at, updated_at) values (?, ?,?, ?,?)', ['19','1','19','2021-08-24','2021-08-24']);
        DB::insert('insert into userrole (id, userid, IdRuangan, created_at, updated_at) values (?, ?,?, ?,?)', ['20','1','20','2021-08-24','2021-08-24']);
        DB::insert('insert into userrole (id, userid, IdRuangan, created_at, updated_at) values (?, ?,?, ?,?)', ['21','1','21','2021-08-24','2021-08-24']);
        DB::insert('insert into userrole (id, userid, IdRuangan, created_at, updated_at) values (?, ?,?, ?,?)', ['22','1','22','2021-08-24','2021-08-24']);
        DB::insert('insert into userrole (id, userid, IdRuangan, created_at, updated_at) values (?, ?,?, ?,?)', ['23','1','23','2021-08-24','2021-08-24']);
        DB::insert('insert into userrole (id, userid, IdRuangan, created_at, updated_at) values (?, ?,?, ?,?)', ['24','1','24','2021-08-24','2021-08-24']);
        DB::insert('insert into userrole (id, userid, IdRuangan, created_at, updated_at) values (?, ?,?, ?,?)', ['25','1','25','2021-08-24','2021-08-24']);
        DB::insert('insert into userrole (id, userid, IdRuangan, created_at, updated_at) values (?, ?,?, ?,?)', ['26','1','26','2021-08-24','2021-08-24']);
        DB::insert('insert into userrole (id, userid, IdRuangan, created_at, updated_at) values (?, ?,?, ?,?)', ['27','1','27','2021-08-24','2021-08-24']);

        DB::insert('insert into kategori (id, Nama) values (?,?)', ['1','Milik Negara']);
        DB::insert('insert into kategori (id, Nama) values (?,?)', ['2','Pihak Ketiga']);

        DB::insert('insert into barangstatus (id, Status) values (?,?)', ['1','Tersedia']);
        DB::insert('insert into barangstatus (id, Status) values (?,?)', ['2','Perbaiki']);
        DB::insert('insert into barangstatus (id, Status) values (?,?)', ['3','Rusak Ringan']);
        DB::insert('insert into barangstatus (id, Status) values (?,?)', ['4','Rusak Berat']);
        DB::insert('insert into barangstatus (id, Status) values (?,?)', ['5','Pindah']);
        DB::insert('insert into barangstatus (id, Status) values (?,?)', ['6','Selesai Pindah']);
        DB::insert('insert into barangstatus (id, Status) values (?,?)', ['7','Selesai Diperbaiki']);
        DB::insert('insert into barangstatus (id, Status) values (?,?)', ['8','Ditolak']);
    }
}
