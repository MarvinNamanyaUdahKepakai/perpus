<?php

namespace App\Models;

use CodeIgniter\Model;

class Teacher_model extends Model
{
    protected $table = 'petugas'; // Ganti 'teachers' dengan nama tabel guru Anda
    protected $primaryKey = 'id_petugas'; // Ganti 'id' dengan nama primary key pada tabel guru

    public function getTeacherCount()
    {
        return $this->countAll();
    }
}
