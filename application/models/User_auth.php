<?php
	class User_auth extends CI_Model
	{
		var $table = 'user_auth';
		var $table2= 'mahasiswa';
		public function __construct()
		{
			parent::__construct();
			$this->load->database();
		}

		function cekuspas($user,$pass,$id)
		{
			
			if($user!=NULL&&$pass!=NULL&&$id==NULL)
			{
				$this->db->from($this->table);
				$this->db->where('username', $user);
				$this->db->where('pw', $pass);
				
			}
			if($user==NULL&&$pass!=NULL&&$id!=NULL)
			{
				$this->db->from($this->table);
				$this->db->where('id', $id);
				$this->db->where('pw', $pass);
			}


			$query = $this->db->get();
			return $query->result_array();
		}

		function getgambar($id)
		{
			$this->db->from($this->table2);
			$this->db->where('id_user', $id);
			$query = $this->db->get();
			$array= $query->result_array();
			return $array[0]['gambar'];
		}





			public function tampil()
		{
			$this->db->from($this->table);
			$r=$this->db->get();
			return $r->result_array();
		}


		function cekstatus($user,$pass)
		{
		$this->db->from($this->table);
		$this->db->where('username', $user);
		$this->db->where('pw', $pass);
		$this->db->select('status');
		$query = $this->db->get();
		$array = $query->result_array();

		return $array[0]["status"];
		}

	

		function tampilwere($id)
		{
			$this->db->from($this->table);
			$this->db->where('id', $id);
			$query = $this->db->get();
			return $query->result_array();

		}

		function sessionangkatan($id)
		{
			$this->db->from($this->table2);
			$this->db->where('id_user', $id);
			$query = $this->db->get();
			$array=$query->result_array();

			 return $array[0]['angkatan'];
		}

		function wereuser($id)//untuk halaman myprofile, join tabel user_auth & mahasiswa
		{

			$this->db->select('*');
			$this->db->from('user_auth');
			$this->db->where('id_user', $id);
			$this->db->join('mahasiswa', 'id_user = id');
			$query = $this->db->get();
			return $query->result_array();

		}

		function tampilsearch($user,$stat)
		{
		
			if($user==null&&$stat!=null)
			{
				$data=array(
					
					'status'=>$stat);

				$query = $this->db->get_where('user_auth', $data);
				return $query->result_array();
			}

			elseif($stat==null&&$user!=null)
			{
				$data=array('username'=>$user);
				$query = $this->db->get_where('user_auth', $data);
				return $query->result_array();
				}

				elseif($user!=null&&$stat!=null)
			{
				$data=array(
					'username'=>$user,
					'status'=>$stat );

				$query = $this->db->get_where('user_auth', $data);
				return $query->result_array();
			}

			else
			{
				$this->db->from($this->table);
				$query = $this->db->get();
				return $query->result_array();

			}
		}




		function insertdata($us,$pass,$sta)
		{
			$data = array(
			'username' => $us ,
			'pw' => $pass,
			'status'   => $sta
			);

			$this->db->insert('user_auth', $data);  //tambah pada tabel user_auth

			$this->db->from($this->table);
			$this->db->where('username',$us);
			$this->db->where('pw',$pass);
			$this->db->select("id");
			$query=$this->db->get();


			$ar=$query->result_array();
			//tambah id_user pada tabel mahasiswa
			$data2=array(
				'id_user' =>  $ar[0]['id'],
				'NIM'=> $ar[0]['id']
			 );
			$this->db->insert('mahasiswa', $data2);
		}


		function updatedata($id,$use,$pas,$sta) //update dari halaman admin
		{
			$datas=array(
				'username'=>$use,
				'pw' => $pas,
				'status' => $sta
				);
			$this->db->where('id',$id);
			$this->db->update('user_auth',$datas);
			return;
		}



		function updatedata1($id,$nim,$use,$pasb,$nam,$jk,$ang,$tgl,$pekerjaan,$nohp,$alamat,$emailp,$emailm,$sos,$gambar)//update dari halaman myprofile
		{
			if($pasb!=null)
			{
				$data=array(
					'username'=>$use,
					'pw'=>$pasb
					);
			}

			else
			{
				$data=array(
				'username'=>$use,
				);
			}

			$this->db->where('id',$id);
			$this->db->update('user_auth',$data);


			if($gambar!=NULL)
			{
				$datas=array(
					'nama'=>$nam,
					'NIM'=>$nim,
					'jenis_kelamin'=>$jk,
					'angkatan'=>$ang,
					'tgl_lahir'=>$tgl,
					'pekerjaan'=>$pekerjaan,
					'no_hp'=>$nohp,
					'alamat'=>$alamat,
					'email'=>$emailp,
					'email_mhs'=>$emailm,
					'sosmed'=>$sos,
					'gambar'=>$gambar

					);
			}

			if($gambar==NULL)
			{
				$datas=array(
					'nama'=>$nam,
					'NIM'=>$nim,
					'jenis_kelamin'=>$jk,
					'angkatan'=>$ang,
					'tgl_lahir'=>$tgl,
					'pekerjaan'=>$pekerjaan,
					'no_hp'=>$nohp,
					'alamat'=>$alamat,
					'email'=>$emailp,
					'email_mhs'=>$emailm,
					'sosmed'=>$sos

					);
			}

			$this->db->where('id_user',$id);
			$this->db->update('mahasiswa',$datas);
			
			return true;
		}

		function deletedata($id)
		{
			$data=array(
				'id' => $id
				);
			$this->db->delete('user_auth',$data);
		}



	}
?>