<?php

namespace App\Controllers;
use App\Models\Karyawan;

class Crud extends BaseController
{
    protected $karyawan;

   
    public function __construct()
    {
        $this->karyawan = new Karyawan();
    }

    public function Create()
    {
        $db      = \Config\Database::connect();
        // dd($this->request->getVar());
        // dd($_FILES);

        if (!$this->validate([
            'nama_karyawan' => [
                'rules' => 'required|max_length[50]',
                'errors' => [
                    'required' => 'Nama Wajib Diisi'
                ]
            ],
            'kota_karyawan' => 'required',
            'foto_karyawan' => [
                'rules' => 'max_size[foto_karyawan,2048]|is_image[foto_karyawan]|mime_in[foto_karyawan,image/jpg,image/png,image/jpeg]',
                'errors' => [
                    'max_size' => 'Maksimal Ukuran 2mb',
                    'mime_in' => 'Extensi file harus jpg, jpeg atau png',
                    'is_image' => 'File harus berupa image',
                ]
            ],
        ])) {
            $validation = \Config\Services::validation();
            if ($validation) {

                if ($validation->getError('nama_karyawan')) {
                    session()->setFlashdata('warning', $validation->getError('nama_karyawan'));
                    return redirect()->to('/');
                } else if ($validation->getError('foto_karyawan')) {
                    session()->setFlashdata('warning', $validation->getError('foto_karyawan'));
                    return redirect()->to('/');
                }
            }
        }

        $foto = $this->request->getFile('foto_karyawan');

        if ($foto->getError() == 4) {
            $nama_foto = "default.png";
        } else {
            $nama_foto = $foto->getRandomName();
            $foto->move('upload', $nama_foto);
        }

        $nama_karyawan = $this->request->getVar('nama_karyawan');

        $kota_karyawan = $this->request->getVar('kota_karyawan');

        $db->query("INSERT INTO tab_karyawan(nama_karyawan,kota, foto) VALUES ('$nama_karyawan','$kota_karyawan', '$nama_foto')");

        session()->setFlashdata('success', "Data berhasil ditambahkan");
        return redirect()->to('/');
    }

    public function Update(){

        // dd($this->request->getVar());

        $db      = \Config\Database::connect();
        $id = $this->request->getVar('id');
        $foto_lama = $this->request->getVar('foto');

        $nama_karyawan = $this->request->getVar('nama_karyawan');

        $kota_karyawan = $this->request->getVar('kota_karyawan');

        $foto = $this->request->getFile('foto_karyawan');

        if ($foto->getError() == 4) {
            $db->query("UPDATE tab_karyawan set nama_karyawan = '$nama_karyawan', kota = $kota_karyawan, foto = '$foto_lama' WHERE id = '$id'");

            session()->setFlashdata('success', "Data berhasil diubah");
            return redirect()->to('/');
        } else {

            unlink('upload/'.$foto_lama);
            $nama_foto = $foto->getRandomName();
            $foto->move('upload', $nama_foto);
            $db->query("UPDATE tab_karyawan set nama_karyawan = '$nama_karyawan', kota = $kota_karyawan, foto = '$nama_foto' WHERE id = '$id'");

            session()->setFlashdata('success', "Data berhasil diubah");
            return redirect()->to('/');
        }

    }

    public function Delete(){
        $db      = \Config\Database::connect();
        $id = $this->request->getVar('id');
        $foto = $this->request->getVar('foto');

        unlink('upload/'.$foto);

        $db->query("DELETE FROM tab_karyawan WHERE id = '$id' ");

        session()->setFlashdata('success', "Data berhasil dihapus");
        return redirect()->to('/');
    }
}
