<?php

namespace App\Controllers;

use App\Models\Kota;
use App\Models\Karyawan;

class Home extends BaseController
{

    protected $tab_kota;
    protected $tab_karyawan;

   
    public function __construct()
    {
        $this->tab_kota = new Kota();
        $this->tab_karyawan = new Karyawan();
    }

    public function index(): string
    {

        $data =  [
            "table_kota" => $this->tab_kota->tab_kota(),
            "table_karyawan" => $this->tab_karyawan->tab_karyawan(),
        ];
        return view('Home', $data);
    }
}
