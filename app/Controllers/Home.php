<?php namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\M_model;
use TCPDF;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use App\Models\Teacher_model;




class Home extends BaseController
{
    public function index()
    {
        
            $num1 = rand(1, 10);
            $num2 = rand(1, 10);
            echo view('login', ['num1' => $num1, 'num2' => $num2]);

    
}
public function aksi_login()
{
    $u = $this->request->getPost('username');
    $p = $this->request->getPost('password');
    $num1 = $this->request->getPost('num1'); // Get the first number from the form
    $num2 = $this->request->getPost('num2'); // Get the second number from the form
    $captchaAnswer = $this->request->getPost('captcha_answer'); // Get captcha answer from the form

    // Check if the CAPTCHA answer is empty
    if (empty($captchaAnswer)) {
        echo '<script>alert("Please enter the CAPTCHA answer."); window.location.href = "' . base_url('/Home') . '";</script>';
        return;
    }

    // Verify CAPTCHA answer
    $correctAnswer = $num1 + $num2;
    if ($captchaAnswer != $correctAnswer) {
        echo '<script>alert("Incorrect CAPTCHA answer. Please try again."); window.location.href = "' . base_url('/Home') . '";</script>';
        return;
    }

    // Proceed with login
    $model = new M_model();
    $data = array(
        'username' => $u,
        'password' => md5($p)
    );
    $cek = $model->getWhere2('user', $data);
    if ($cek > 0) {
        session()->set('id', $cek['id_user']);
        session()->set('username', $cek['username']);
        session()->set('level', $cek['level']);
        return redirect()->to('/Home/dashboard');
    } else {
        return redirect()->to('/Home');
    }
}

    public function reset_password($id)
    {
        if(session()->get('id')>0) {
            $okta=new M_model();
            $where=array('id_user'=>$id);
            $user=array('password'=>md5('12345'));
            $okta->qedit('user', $user, $where);

            echo view('header');
            echo view('menu');
            echo view('footer');

            return redirect()->to('/Home/user');
        }else {
            return redirect()->to('home');

        }
    }

    public function log_out()
    {

        session()->destroy();
        return redirect()->to('Home');
    }

    public function dashboard()
    {
        if (session()->get('id') > 0) {
            $model=new M_model();
            $data['status']=$model->getWhere('user',array('id_user'=>session()->get('id')));
            echo view('header');
            echo view('menu',$data);

            $teacherModel = new Teacher_model(); // Buat objek model
            $teacherCount = $teacherModel->getTeacherCount(); // Panggil metode model

            echo view('dashboard', ['teacherCount' => $teacherCount]);
            echo view('footer');
        } else {
            return redirect()->to('/');
        }
    }
    public function user()
{
    if (session()->get('id') > 0) {
        $model = new M_model();
        $data['status']=$model->getWhere('user',array('id_user'=>session()->get('id')));
        $on = 'user.level = level.id_level';
        $diva['okta'] = $model->join2('user', 'level', $on);

        $data['status']=$model->getWhere('user',array('id_user'=>session()->get('id')));

        echo view('header');
        echo view('menu',$data);
        echo view('user', $diva);
        echo view('footer');
    } else {
        return redirect()->to('/Home/');
    }
}

public function petugas()
    {
        if(session()->get('id')>0) {
            $model=new M_model();
            $data['status']=$model->getWhere('user',array('id_user'=>session()->get('id')));
            $on='petugas.user=user.id_user';
            $diva['okta'] = $model->join2('petugas', 'user',$on);
            $data['status']=$model->getWhere('user',array('id_user'=>session()->get('id')));
            echo view('header',$data);
            echo view('menu',$data );
            echo view('petugas',$diva);
            echo view('footer');
        }else{
            return redirect()->to('/Home');
    }   
}

public function hapus_petugas($id)
{
    $model = new M_model(); 
    $where = array('user' => $id);
    $where2 = array('id_user' => $id);
    $model->hapus('petugas', $where);
    $model->hapus('user', $where2);

    $data2 = array(
        'id_user' => session()->get('id'),
        'aktiviti' =>"Menghapus petugas dengan Id ".$id."",
        'waktu' => date('Y-m-d H:i:s')
       
    );
     $model->simpan('log', $data2);

    return redirect()->to('/Home/petugas');


}

public function tambah_petugas()
    {
        if(session()->get('id')>0) {
        $model=new m_model();
        $data['status']=$model->getWhere('user',array('id_user'=>session()->get('id')));
        echo view('header');
        echo view('menu',$data);
        $diva['okta'] = $model->tampil('level');
        

        return view('tambah_petugas', $diva);
        echo view('footer');
        }else{
            return redirect()->to('/Home');
        }
        
    
    }

    public function aksi_tambah_petugas()
{
    $a = $this->request->getPost('username');
    $f = $this->request->getPost('password');
    $level = $this->request->getPost('level');
    $nama_petugas = $this->request->getPost('nama_petugas');
    $jk = $this->request->getPost('jk');
    $ttl = $this->request->getPost('ttl');
    $nohp = $this->request->getPost('nohp');
    $nik = $this->request->getPost('nik');
     $foto= $this->request->getFile('foto');
        if($foto->isValid() && ! $foto->hasMoved())
        {
            $imageName = $foto->getName();
            $foto->move('images/',$imageName);
        }


    $data1 = array(
        'username' => $a,
        'password' =>md5($f),
        'level' => '2',
        'foto' => $imageName,
        'created_at'=>date('Y-m-d-H:i:s')
    );

    $darrel = new M_model();
    $darrel->simpan('user', $data1);

    $where = array('username' => $a);
    $ayu = $darrel->getWhere2('user', $where);
    $id = $ayu['id_user'];

    $data2 = array(
        'nama_petugas' => $nama_petugas,
        'jk' => $jk,
        'ttl' => $ttl,
        'nohp' => $nohp,
        'nik' => $nik,
        'created_at'=>date('Y-m-d-H:i:s'),
        'user' => $id
    );

    $darrel->simpan('petugas', $data2);

    return redirect()->to('/Home/petugas');
}

public function edit_petugas($user)
    {
        if(session()->get('id')>0){
        $model=new M_model();
        $data['status']=$model->getWhere('user',array('id_user'=>session()->get('id')));
        $where=array('user'=>$user);
        $where2=array('id_user'=>$user);
        $data['jess']=$model->tampil('level');
        $data['jojo']=$model->getWhere('petugas',$where);
        $data['rizkan']=$model->getWhere('user',$where2);
        echo view('header');
        echo view('menu',$data);
        echo view('edit_petugas',$data);
        echo view('footer');
        }else{
            return redirect()->to('/Home/petugas');

        }
    }
    public function aksi_edit_petugas()
    {
        $a= $this->request->getPost('username');
        $b= $this->request->getPost('password');
        $level= $this->request->getPost('level');
        $nama_petugas= $this->request->getPost('nama_petugas');
        $jk= $this->request->getPost('jk');
        $ttl= $this->request->getPost('ttl');
        $nohp= $this->request->getPost('nohp');
        $nik= $this->request->getPost('nik');
       
        $id= $this->request->getPost('id');
        $id2= $this->request->getPost('id2');

        $where=array('id_user'=>$id);
        $data1=array(
            'username'=>$a,
           'password' =>md5($f),
            'level'=>'2',

        );
        $darrel=new M_model();
        $darrel->qedit('user', $data1, $where);
        
        $where2=array('user'=>$id2);
        $data2=array(
            'nama_petugas'=>$nama_petugas,
            'jk'=>$jk,
            'ttl'=>$ttl,
            'nohp'=>$nohp,
            'nik'=>$nik
            
        );
        $darrel->qedit('petugas', $data2,$where2);

        return redirect()->to('/Home/petugas');

    }

    public function ketua()
    {
        if(session()->get('id')>0) {
            $model=new M_model();
            $data['status']=$model->getWhere('user',array('id_user'=>session()->get('id')));
            $on = 'ketua.user = user.id_user';
            $on1 = 'ketua.rw = rw.id_rw';
           
            $diva['okta'] = $model->join3('ketua', 'user', 'rw', $on, $on1);
            $data['status']=$model->getWhere('user',array('id_user'=>session()->get('id')));
            echo view('header',$data);
            echo view('menu',$data );
            echo view('ketua',$diva);
            echo view('footer');
        }else{
            return redirect()->to('/Home');
    }   
}

public function tambah_ketua()
{
    if (session()->get('id') > 0) {
        $model = new M_model();
         $data['status']=$model->getWhere('user',array('id_user'=>session()->get('id')));
        $diva['okta'] = $model->tampil('level');
        $diva['okt'] = $model->tampil('rw');
        echo view('header');
        echo view('menu',$data);
        echo view('tambah_ketua', $diva);
        echo view('footer');
    } else {
        return redirect()->to('/Home');
    }
}

    public function aksi_tambah_ketua()
{
    $a = $this->request->getPost('username');
    $f = $this->request->getPost('password');
    $level = $this->request->getPost('level');
    $nama_ketua = $this->request->getPost('nama_ketua');
    $rw = $this->request->getPost('rw');
    $jk = $this->request->getPost('jk');
    $tanggal = $this->request->getPost('tanggal');
     $foto= $this->request->getFile('foto');
        if($foto->isValid() && ! $foto->hasMoved())
        {
            $imageName = $foto->getName();
            $foto->move('images/',$imageName);
        }


    $data1 = array(
        'username' => $a,
        'password' =>md5($f),
        'level' => '3',
        'foto' => $imageName,
        'created_at'=>date('Y-m-d-H:i:s')
    );

    $darrel = new M_model();
    $darrel->simpan('user', $data1);
    $where = array('username' => $a);
    $ayu = $darrel->getWhere2('user', $where);
    $id = $ayu['id_user'];

    $data2 = array(
        'nama_ketua' => $nama_ketua,
        'rw' => $rw,
        'jk' => $jk,
        'tanggal' => $tanggal,
        'created_at'=>date('Y-m-d-H:i:s'),
        'user' => $id
    );

    $darrel->simpan('ketua', $data2);

    return redirect()->to('/Home/ketua');
}

public function hapus_ketua($id)
{
    $model = new M_model(); 
    $where = array('user' => $id);
    $where2 = array('id_user' => $id);
    $model->hapus('ketua', $where);
    $model->hapus('user', $where2);

    $data2 = array(
        'id_user' => session()->get('id'),
        'aktiviti' =>"Menghapus ketua dengan Id ".$id."",
        'waktu' => date('Y-m-d H:i:s')
       
    );
     $model->simpan('log', $data2);

    return redirect()->to('/Home/ketua');


}

public function edit_ketua($user)
    {
        if(session()->get('id')>0){
        $model=new M_model();
        $data['status']=$model->getWhere('user',array('id_user'=>session()->get('id')));
        $where=array('user'=>$user);
        $where2=array('id_user'=>$user);
        $data['jess']=$model->tampil('level');
        $data['jes']=$model->tampil('rw');
        $data['jojo']=$model->getWhere('ketua',$where);
        $data['rizkan']=$model->getWhere('user',$where2);
        echo view('header');
        echo view('menu',$data);
        echo view('edit_ketua',$data);
        echo view('footer');
        }else{
            return redirect()->to('/Home/ketua');

        }
    }
    public function aksi_edit_ketua()
    {
        $a= $this->request->getPost('username');
        $b= $this->request->getPost('password');
        $level= $this->request->getPost('level');
        $nama_ketua= $this->request->getPost('nama_ketua');
        $rw= $this->request->getPost('rw');
        $jk= $this->request->getPost('jk');
        $tanggal= $this->request->getPost('tanggal');
        $id= $this->request->getPost('id');
        $id2= $this->request->getPost('id2');

        $where=array('id_user'=>$id);
        $data1=array(
            'username'=>$a,
           'password' =>md5($f),
            'level'=>'3',

        );
        $darrel=new M_model();
        $darrel->qedit('user', $data1, $where);
        $where2=array('user'=>$id2);
        $data2=array(
            'nama_ketua'=>$nama_ketua,
            'rw'=>$rw,
            'jk'=>$jk,
            'tanggal'=>$tanggal
            
        );
        $darrel->qedit('ketua', $data2,$where2);

        return redirect()->to('/Home/ketua');

    }

     public function penduduk()
    {
        if(session()->get('id')>0) {
            $model=new M_model();
            $data['status']=$model->getWhere('user',array('id_user'=>session()->get('id')));
            $on = 'penduduk.user = user.id_user';
            $on1 = 'penduduk.rw = rw.id_rw';
           
            $diva['okta'] = $model->join3('penduduk', 'user', 'rw', $on, $on1);
            $data['status']=$model->getWhere('user',array('id_user'=>session()->get('id')));
            echo view('header',$data);
            echo view('menu',$data );
            echo view('penduduk',$diva);
            echo view('footer');
        }else{
            return redirect()->to('/Home');
    }   
}

public function tambah_penduduk()
{
    if (session()->get('id') > 0) {
        $model = new M_model();
         $data['status']=$model->getWhere('user',array('id_user'=>session()->get('id')));
        $diva['okta'] = $model->tampil('level');
        $diva['okt'] = $model->tampil('rw');
        echo view('header');
        echo view('menu',$data);
        echo view('tambah_penduduk', $diva);
        echo view('footer');
    } else {
        return redirect()->to('/Home');
    }
}

public function aksi_tambah_penduduk()
{
    $a = $this->request->getPost('username');
    $f = $this->request->getPost('password');
    $level = $this->request->getPost('level');
    $nama_penduduk = $this->request->getPost('nama_penduduk');
    $rw = $this->request->getPost('rw');
    $jk = $this->request->getPost('jk');
    $tanggal = $this->request->getPost('tanggal');
     $foto= $this->request->getFile('foto');
        if($foto->isValid() && ! $foto->hasMoved())
        {
            $imageName = $foto->getName();
            $foto->move('images/',$imageName);
        }


    $data1 = array(
        'username' => $a,
        'password' =>md5($f),
        'level' => '4',
        'foto' => $imageName,
         'created_at'=>date('Y-m-d-H:i:s')
    );

    $darrel = new M_model();
    $darrel->simpan('user', $data1);
    $where = array('username' => $a);
    $ayu = $darrel->getWhere2('user', $where);
    $id = $ayu['id_user'];

    $data2 = array(
        'nama_penduduk' => $nama_penduduk,
        'rw' => $rw,
        'jk' => $jk,
        'tanggal' => $tanggal,
        'created_at'=>date('Y-m-d-H:i:s'),
        'user' => $id
    );

    $darrel->simpan('penduduk', $data2);

    return redirect()->to('/Home/penduduk');
}

public function hapus_penduduk($id)
{
    $model = new M_model(); 
    $where = array('user' => $id);
    $where2 = array('id_user' => $id);
    $model->hapus('penduduk', $where);
    $model->hapus('user', $where2);

    $data2 = array(
        'id_user' => session()->get('id'),
        'aktiviti' =>"Menghapus penduduk dengan Id ".$id."",
        'waktu' => date('Y-m-d H:i:s')
       
    );
     $model->simpan('log', $data2);

    return redirect()->to('/Home/penduduk');


}

public function edit_penduduk($user)
    {
        if(session()->get('id')>0){
        $model=new M_model();
        $data['status']=$model->getWhere('user',array('id_user'=>session()->get('id')));
        $where=array('user'=>$user);
        $where2=array('id_user'=>$user);
        $data['jess']=$model->tampil('level');
        $data['jes']=$model->tampil('rw');
        $data['jojo']=$model->getWhere('penduduk',$where);
        $data['rizkan']=$model->getWhere('user',$where2);
        echo view('header');
        echo view('menu',$data);
        echo view('edit_penduduk',$data);
        echo view('footer');
        }else{
            return redirect()->to('/Home/penduduk');

        }
    }
    public function aksi_edit_penduduk()
    {
        $a= $this->request->getPost('username');
        $b= $this->request->getPost('password');
        $level= $this->request->getPost('level');
        $nama_penduduk= $this->request->getPost('nama_penduduk');
        $rw= $this->request->getPost('rw');
        $jk= $this->request->getPost('jk');
        $tanggal= $this->request->getPost('tanggal');
        $id= $this->request->getPost('id');
        $id2= $this->request->getPost('id2');

        $where=array('id_user'=>$id);
        $data1=array(
            'username'=>$a,
           'password' =>md5($f),
            'level'=>'4',

        );
        $darrel=new M_model();
        $darrel->qedit('user', $data1, $where);
        $where2=array('user'=>$id2);
        $data2=array(
            'nama_penduduk'=>$nama_penduduk,
            'rw'=>$rw,
            'jk'=>$jk,
            'tanggal'=>$tanggal
            
        );
        $darrel->qedit('penduduk', $data2,$where2);

        return redirect()->to('/Home/penduduk');

    }

 public function sampah()
    {
        if (session()->get('id') > 0) {
            $model = new M_model();
            $data['status']=$model->getWhere('user',array('id_user'=>session()->get('id')));
            $on = 'sampah.petugas = petugas.id_petugas';
            $on1 = 'sampah.rw = rw.id_rw';
            $diva['okta'] = $model->join3('sampah', 'petugas', 'rw', $on, $on1);
            echo view('header');
            echo view('menu',$data);
            echo view('sampah', $diva);
            echo view('footer');
        } else {
            return redirect()->to('/Home/sampah');
        }
    }

    public function tambah_sampah()
{
    if (session()->get('id') > 0) {
        $model = new M_model();
        $data['status']=$model->getWhere('user',array('id_user'=>session()->get('id')));
        $diva['okta'] = $model->tampil('petugas');
        $diva['okt'] = $model->tampil('rw');
        echo view('header');
        echo view('menu',$data);
        echo view('tambah_sampah', $diva);
        echo view('footer');
    } else {
        return redirect()->to('/Home');
    }
}


    public function aksi_tambah_sampah()
    {
        $a=$this->request->getPost('id_sampah');
        $b=$this->request->getPost('petugas');
        $c=$this->request->getPost('rw');
        $d=$this->request->getPost('sampah_organik');
        $e=$this->request->getPost('sampah_anorganik');
        $f=$this->request->getPost('sampah_b3');
        $g=$this->request->getPost('tanggal');
      
        $simpan=array(
            'id_sampah'=>$a,
            'petugas'=>$b,
            'rw'=>$c,
            'sampah_organik'=>$d,
            'sampah_anorganik'=>$e,
            'sampah_b3'=>$f,
            'tanggal'=>$g,
            'created_at'=>date('Y-m-d-H:i:s')
            
        );
        $model=new M_model();
        $model->simpan('sampah',$simpan);
        return redirect()->to('/Home/sampah');
    }

     public function hapus_sampah($id)
    {
        $model=new M_model();
        $where=array('id_sampah'=>$id);
        echo view('header');
            echo view('menu');
            echo view('footer');
        $model->hapus('sampah',$where);
        return redirect()->to('/Home/sampah');
    }

     public function edit_sampah($id)
    {
        if(session()->get('id')>0) {
        $model=new m_model();
         $data['status']=$model->getWhere('user',array('id_user'=>session()->get('id')));
        $where=array('id_sampah '=>$id);
        $data['jess']=$model->tampil('petugas');
        $data['jesss']=$model->tampil('rw');
        $data['jojo']=$model->getWhere('sampah',$where);
        echo view('header');
        echo view('menu',$data);
        return view('edit_sampah',$data);
        echo view('footer');
        }else{
            return redirect()->to('/Home/edit_sampah');
        }
    }

    public function aksi_edit_sampah()
    {
        $id=$this->request->getPost('id');
        $a=$this->request->getPost('petugas');
        $b=$this->request->getPost('rw');
        $c=$this->request->getPost('sampah_organik');
        $d=$this->request->getPost('sampah_anorganik');
        $e=$this->request->getPost('sampah_b3');
        $f=$this->request->getPost('tanggal');



        $where=array('id_sampah'=>$id);
        $simpan=array(
            'petugas'=>$a,
            'rw'=>$b,
            'sampah_organik'=>$c,
            'sampah_anorganik'=>$d,
            'sampah_b3'=>$e,
            'tanggal'=>$f

        );
        $model=new M_model();
        $model->qedit('sampah',$simpan, $where);
        return redirect()->to('/Home/sampah');

    }

    public function keluhan()
    {
        if (session()->get('id') > 0) {
            $model = new M_model();
             $data['status']=$model->getWhere('user',array('id_user'=>session()->get('id')));
            $on = 'keluhan.rw = rw.id_rw';
            $diva['okta'] = $model->join2('keluhan','rw', $on);
            echo view('header');
            echo view('menu',$data);
            echo view('keluhan', $diva);
            echo view('footer');
        } else {
            return redirect()->to('/Home/keluhan');
        }
    }

 public function tambah_keluhan()
{
    if (session()->get('id') > 0) {
        $model = new M_model();
        $data['status']=$model->getWhere('user',array('id_user'=>session()->get('id')));
        $diva['okt'] = $model->tampil('rw');
        echo view('header');
        echo view('menu',$data);
        echo view('tambah_keluhan', $diva);
        echo view('footer');
    } else {
        return redirect()->to('/Home');
    }
}


    public function aksi_tambah_keluhan()
    {
        $a=$this->request->getPost('id_keluhan');
        $b=$this->request->getPost('nama');
        $c=$this->request->getPost('rw');
        $d=$this->request->getPost('keluhan');
        $g=$this->request->getPost('tanggal');
      
        $simpan=array(
            'id_keluhan'=>$a,
            'nama'=>$b,
            'rw'=>$c,
            'keluhan'=>$d,
            'tanggal'=>$g,
            'created_at'=>date('Y-m-d-H:i:s')
            
        );
        $model=new M_model();
        $model->simpan('keluhan',$simpan);
        return redirect()->to('/Home/keluhan');
    }

     public function hapus_keluhan($id)
    {
        $model=new M_model();
        $where=array('id_keluhan'=>$id);
        echo view('header');
            echo view('menu');
            echo view('footer');
        $model->hapus('keluhan',$where);
        return redirect()->to('/Home/keluhan');
    }

     public function edit_keluhan($id)
    {
        if(session()->get('id')>0) {
        $model=new m_model();
        $data['status']=$model->getWhere('user',array('id_user'=>session()->get('id')));
        $where=array('id_keluhan'=>$id);
        $data['jesss']=$model->tampil('rw');
        $data['jojo']=$model->getWhere('keluhan',$where);
        echo view('header');
        echo view('menu',$data);
        return view('edit_keluhan',$data);
        echo view('footer');
        }else{
            return redirect()->to('/Home/edit_keluhan');
        }
    }

    public function aksi_edit_keluhan()
    {
        $id=$this->request->getPost('id');
        $a=$this->request->getPost('nama');
        $b=$this->request->getPost('rw');
        $c=$this->request->getPost('keluhan');
        $f=$this->request->getPost('tanggal');
        $g=$this->request->getPost('status');



        $where=array('id_keluhan'=>$id);
        $simpan=array(
            'nama'=>$a,
            'rw'=>$b,
            'keluhan'=>$c,
            'tanggal'=>$f,
            'status'=>$g

        );
        $model=new M_model();
        $model->qedit('keluhan',$simpan, $where);
        return redirect()->to('/Home/keluhan');

    }


     public function rw()
    {
        // if(session()->get('id')>0) {
            $model=new M_model();
            $data['status']=$model->getWhere('user',array('id_user'=>session()->get('id')));
            $diva['okta'] = $model->tampil('rw');
            echo view('header');
            echo view('menu',$data);
            echo view('rw',$diva);
            echo view('footer');
        // }else{
            // return redirect()->to('/Home/guru');
    }

    public function hapus_rw($id)
    {
        $model=new m_model();
        $where=array('id_rw'=>$id);
        echo view('header');
            echo view('menu');
            echo view('footer');
        $model->hapus('rw',$where);
         $data2 = array(
        'id_user' => session()->get('id'),
        'aktiviti' =>"Menghapus rw dengan Id ".$id."",
        'waktu' => date('Y-m-d H:i:s')
       
    );
     $model->simpan('log', $data2);
        return redirect()->to('/Home/rw');
    }


    public function tambah_rw()
    {
        // if(session()->get('id')>0) {
        $model=new m_model();
         $data['status']=$model->getWhere('user',array('id_user'=>session()->get('id')));
        echo view('header');
        echo view('menu',$data);
        $diva['okta'] = $model->tampil('rw');
        return view('tambah_rw', $diva);
        echo view('footer');
        // }else{
        //  return redirect()->to('/Home');
        // }
        
    
    }

    public function aksi_tambah_rw()
    {
        $a=$this->request->getPost('id_rw');
        $b=$this->request->getPost('nama_rw');


        
        
        $simpan=array(
            'id_rw'=>$a,
            'nama_rw'=>$b,
            'created_at'=>date('Y-m-d-H:i:s')
            
        );
        $model=new M_model();
        $model->simpan('rw',$simpan);
        return redirect()->to('/Home/rw');
    }

    public function edit_rw($id)
    {
       
        $model=new m_model();
         $data['status']=$model->getWhere('user',array('id_user'=>session()->get('id')));
        $where=array('id_rw'=>$id);
        echo view('header');
        echo view('menu',$data);
        $data['jojo']=$model->getWhere('rw',$where);
        return view('edit_rw',$data);
        echo view('footer');
        
    }

    public function aksi_edit_rw()
    {
        $id=$this->request->getPost('id');
        $a=$this->request->getPost('nama_rw');


        $where=array('id_rw'=>$id);
        $simpan=array(
            'nama_rw'=>$a
        );
        $model=new M_model();
        $model->qedit('rw',$simpan, $where);
        return redirect()->to('/Home/rw');

    }



      public function cari_b()
{
    if (session()->get('id') > 0) {
        $model = new M_model();
         $data['status']=$model->getWhere('user',array('id_user'=>session()->get('id')));
        $awal = $this->request->getPost('awal');
        $akhir = $this->request->getPost('akhir');
        $result = $model->filter2($awal, $akhir);

        $kui['duar'] = $result;
        echo view('header');
        echo view('menu',$data);
        echo view('c_b', $kui);
        echo view('footer');
    } else {
        return redirect()->to('/Home/sampah');
    }
}

    public function pdf_b()
{
    $model = new M_model(); 
    $awal = $this->request->getPost('awal');
    $akhir = $this->request->getPost('akhir');
    $result = $model->filter2($awal, $akhir);

    $kui['duar'] = $result;

    // Load the 'c_b' view into a variable instead of echoing it directly.
    $pdf_view = view('c_b', $kui);

    $dompdf = new \Dompdf\Dompdf();
    $dompdf->loadHtml($pdf_view);
    $dompdf->setPaper('A4', 'landscape');
    $dompdf->render();
    $dompdf->stream('my.pdf', ['Attachment' => 0]);
}




    public function excel_barang()
{
    $model = new M_model();
    $awal = $this->request->getPost('awal');
    $akhir = $this->request->getPost('akhir');
    $data = $model->filter2($awal, $akhir);

    $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // Set the headers for the Excel file
    $sheet->setCellValue('A1', 'Nama Petugas');
    $sheet->setCellValue('B1', 'RT/RW');
    $sheet->setCellValue('C1', 'Sampah Organik');
    $sheet->setCellValue('D1', 'Sampah Anorganik');
    $sheet->setCellValue('E1', 'Sampah B3');
    $sheet->setCellValue('F1', 'Tanggal');
    // $sheet->setCellValue('G1', 'Kelas');
    // $sheet->setCellValue('H1', 'Rombel');
    // $sheet->setCellValue('J1', 'Guru');
    // $sheet->setCellValue('K1', 'Mapel');

    // Set the data from the filtered results
    $row = 2;
    foreach ($data as $item) {
        $sheet->setCellValue('A' . $row, $item->nama_petugas);
        $sheet->setCellValue('B' . $row, $item->nama_rw);
        $sheet->setCellValue('C' . $row, $item->sampah_organik);
        $sheet->setCellValue('D' . $row, $item->sampah_anorganik);
        $sheet->setCellValue('E' . $row, $item->sampah_b3);
        $sheet->setCellValue('F' . $row, $item->tanggal);
        // $sheet->setCellValue('G' . $row, $item->tingkat);
        // $sheet->setCellValue('H' . $row, $item->rombel);
        // $sheet->setCellValue('J' . $row, $item->nama_guru);
        // $sheet->setCellValue('K' . $row, $item->nama_mapel);
        $row++;
    }

    $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
    $fileName = 'Data Laporan jadwal.xlsx';

    // Set the appropriate headers to download the Excel file
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="' . $fileName . '"');
    header('Cache-Control: max-age=0');

    // Output the file to the browser
    $writer->save('php://output');
}

    public function l_brg()
    {
        if(session()->get('level')== 1) {

            $model=new M_model();
            $data['status']=$model->getWhere('user',array('id_user'=>session()->get('id')));
            $kui['kunci']='view_b';

            echo view('header');
            echo view('menu',$data);
            echo view('filter',$kui);
            echo view('footer');

        }else{
            return redirect()->to('/home/');
        }
    }

     public function log()
    {
        if(session()->get('level')== 1) {
        $model=new M_model();
        $where=array('log.id_user'=>session()->get('id'));
            $on='log.id_user=user.id_user';
            $diva ['okta']= $model->join_w('log', 'user',$on, $where);
            echo view('header');
            echo view('menu');
            echo view('log',$diva);
            echo view('footer');
        
    }else{
        return redirect()->to('/Home');
    }
    }





}
