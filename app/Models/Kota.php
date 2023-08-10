<?php

namespace App\Models;

use CodeIgniter\Model;


class Kota extends Model
{
    protected $table = 'tab_kota';

    public function tab_kota(){
        return $this->findAll();
    }
}