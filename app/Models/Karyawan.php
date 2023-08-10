<?php

namespace App\Models;

use CodeIgniter\Model;


class Karyawan extends Model
{
    protected $table = 'tab_karyawan';
    protected $allowedFields = ['id', 'nama_karyawan','kota','foto'];
    
    public function tab_karyawan(){
        $db      = \Config\Database::connect();

        $query = $db->query("SELECT tk.id as id, tko.id as id_kota, tk.nama_karyawan as nama,tko.nama_kota as kota, tk.foto as foto FROM tab_karyawan as tk JOIN tab_kota as tko ON tk.kota = tko.id");

        return $query->getResultArray();
    }
}