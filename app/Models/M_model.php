<?php 

namespace App\Models; 
use CodeIgniter\Model;

class M_model extends Model
{
// public function tampil($table){
//     return $this->db->table($table)->get()->getResult(); 
// }

public function hapus($table, $where){
    return $this->db->table($table)->delete($where);
  }
  

  public function simpan($table, $data){
    return $this->db->table($table)->insert($data);
  }

    public function getarray($table, $where)
  {
    return $this->db->table($table)->getWhere($where)->getRowArray();
  }
    public function getWhere($table, $where){
    return $this->db->table($table)->getWhere($where)->getRow(); 
  }

  public function qedit($table, $data, $where){
    return $this->db->table($table)->update($data, $where);
  }

  public function tampil($table) {
        return $this->db->table($table)
                        ->orderBy('created_at', 'desc')
                        ->get()
                        ->getResult();
    }

    public function getWhere2($table, $where){
        return $this->db->table($table)->getWhere($where)->getRowArray();
    }

    public function join2($table1, $table2, $on){
        return $this->db->table($table1)
                        ->join($table2, $on, 'left')
                        ->orderBy("$table1.created_at", 'desc') 
                        ->get()
                        ->getResult();
    }

    public function join_w($table1, $table2, $on, $where)
    {
        return $this->db
            ->table($table1)
            ->join($table2, $on, 'left')
            ->where($where)
            ->get()
           ->getResult();
    }

    public function join3($table1, $table2, $table3, $on1, $on2)
    {
        return $this->db->table($table1)
            ->join($table2, $on1, 'left')
            ->join($table3, $on2, 'left')
            ->orderBy("$table1.created_at", 'desc') 
            ->get()
            ->getResult();
    }

    public function join4($table1, $table2, $table3, $table4, $on1, $on2, $on3)
    {
        return $this->db->table($table1)
            ->join($table2, $on1, 'left')
            ->join($table3, $on2, 'left')
            ->join($table4, $on3, 'left')
            ->orderBy('created_at', 'desc')
            ->get()
            ->getResult();
    }

    public function join5($table1, $table2, $table3, $table4, $table5, $on1, $on2, $on3, $on4)
    {
        return $this->db->table($table1)
            ->join($table2, $on1, 'left')
            ->join($table3, $on2, 'left')
            ->join($table4, $on3, 'left')
            ->join($table5, $on4, 'left')
            ->orderBy('created_at', 'desc')
            ->get()
            ->getResult();
    }

     public function join6($table1, $table2, $table3, $table4, $table5, $table6, $on1, $on2, $on3, $on4, $on5)
    {
        return $this->db->table($table1)
            ->join($table2, $on1, 'left')
            ->join($table3, $on2, 'left')
            ->join($table4, $on3, 'left')
            ->join($table5, $on4, 'left')
            ->join($table6, $on5, 'left')
            ->orderBy('created_at', 'desc')
            ->get()
            ->getResult();
    }

    public function join7($table1, $table2, $table3, $table4, $table5, $table6, $table7, $on1, $on2, $on3, $on4, $on5, $on6)
    {
        return $this->db->table($table1)
            ->join($table2, $on1, 'left')
            ->join($table3, $on2, 'left')
            ->join($table4, $on3, 'left')
            ->join($table5, $on4, 'left')
            ->join($table6, $on5, 'left')
            ->join($table7, $on6, 'left')
            ->orderBy('created_at', 'desc')
            ->get()
            ->getResult();
    }

    public function join8($table1, $table2, $table3, $table4, $table5, $table6, $table7, $table8, $on1, $on2, $on3, $on4, $on5, $on6, $on7)
    {
        return $this->db->table($table1)
            ->join($table2, $on1, 'left')
            ->join($table3, $on2, 'left')
            ->join($table4, $on3, 'left')
            ->join($table5, $on4, 'left')
            ->join($table6, $on5, 'left')
            ->join($table7, $on6, 'left')
            ->join($table8, $on7, 'left')
            ->orderBy('created_at', 'desc')
            ->get()
            ->getResult();
    }
//      public function filter2($awal, $akhir)
// {
//     $db = \Config\Database::connect();

//     $query = $db->table('jadwal');
//     $query->select('*');
//     $query->join('jurusan', 'jadwal.jurusan = jurusan.id_jurusan', 'left');
//     $query->join('blok', 'jadwal.nama_blok = blok.id_blok', 'left');
//     $query->join('kelas', 'jadwal.tingkat = kelas.id_kelas', 'left');
//     $query->join('rombel', 'jadwal.rombel = rombel.id_rombel', 'left');
//     $query->join('guru', 'jadwal.nama_guru = guru.id_guru', 'left');
//     $query->join('mapel', 'jadwal.nama_mapel = mapel.id_mapel', 'left');
//     $query->where('jadwal.tahun BETWEEN "' . $awal . '" AND "' . $akhir . '"');

//     return $query->get()->getResult();
// }

// public function filter2 ($table,$awal,$akhir)
//   {
//     return $this->db->query("
//       SELECT *
//       FROM ".$table."
//       WHERE ".$table.".tg
//       BETWEEN '".$awal."'
//       and '".$akhir."'"

//         )->getResult();
//   }

    public function filter2($awal, $akhir)
{
    $db = \Config\Database::connect();

    $query = $db->table('sampah');
    $query->select('*');
    $query->join('petugas', 'sampah.petugas = petugas.id_petugas', 'left');
    $query->join('rw', 'sampah.rw = rw.id_rw', 'left');

    $query->where('sampah.tanggal BETWEEN "' . $awal . '" AND "' . $akhir . '"');

    return $query->get()->getResult();
}



}

   