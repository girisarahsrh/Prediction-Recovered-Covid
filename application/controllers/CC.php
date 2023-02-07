<?php
// defined('BASEPATH') OR exit('No direct script access allowed');

//load Spout Library
require_once APPPATH.'third_party/Spout/Autoloader/autoload.php';

use Box\Spout\Reader\ReaderFactory;
use Box\Spout\Common\Type;
use Box\Spout\Writer\WriterFactory;

class CC extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->library('pagination');
		$this->load->model('MData');
	}

	function index()
	{
		//$this->load->view('Header/Header');
		$this->load->view('LoginPage');
		//$this->load->view('Footer/Footer');

	}

	function AksiLogin(){
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$validate = $this->MData->CekLogin($username,$password);
		if($validate->num_rows() > 0){
			$data      	  = $validate->row_array();
			$username     = $data['username'];
			$password     = $data['password'];
			$data_session = array(
				'username'  => $username,
				'password'     => $password,
				'logged_in' => TRUE
			);

			$this->session->set_userdata($data_session);

			redirect('CC/HomePage');

		}else{
			$this->session->set_flashdata('message', 'User Not Found');
			redirect('CC');
		}
	}

	function logout(){
		$this->session->sess_destroy();
		redirect('CC');
	}

	public function HomePage()
	{
		//$data['grafik'] = $this->MData->getgraph();

		$data['namanegara_list'] = $this->MData->fetch_namanegara();
		$data['countcon'] = $this->MData->countcon();
		$data['countde'] = $this->MData->countde();
		$data['countrecovered'] = $this->MData->countrecovered();
		$this->load->view('Header/Header');
		$this->load->view('HomePage',$data);
		$this->load->view('Footer/Footer',$data);

	}

	function fetch_data()
	{
		if($this->input->post('namanegara'))
		{
			$chart_data = $this->MData->fetch_chart_data($this->input->post('namanegara'));

			foreach($chart_data->result_array() as $row)
			{
				$output[] = array(
					'tanggal'  => $row["tanggal"],
					'confirmed' => floatval($row["confirmed"]),
					'death' => floatval($row["death"]),
					'recovered' => floatval($row["recovered"]),
				);
			}
			echo json_encode($output);
		}

	}



	public function MasterData()
	{
//konfigurasi pagination
		$config['base_url'] = base_url().'CC/MasterData';        
		$config['total_rows'] = $this->MData->count_all_users();        
		$config['per_page'] = 20;        
		$config['uri_segment'] = 3;  


		 // Membuat Style pagination untuk BootStrap v4
		$config['first_link']       = 'First';
		$config['last_link']        = 'Last';
		$config['next_link']        = 'Next';
		$config['prev_link']        = 'Prev';
		$config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
		$config['full_tag_close']   = '</ul></nav></div>';
		$config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
		$config['num_tag_close']    = '</span></li>';
		$config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
		$config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
		$config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
		$config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['prev_tagl_close']  = '</span>Next</li>';
		$config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
		$config['first_tagl_close'] = '</span></li>';
		$config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['last_tagl_close']  = '</span></li>';

		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$this->pagination->initialize($config);        
		$data['pagination'] = $this->pagination->create_links();        

        //panggil function get_mahasiswa_list yang ada pada mmodel mahasiswa_model. 
		$data['functionmasterdata'] = $this->MData->getmasterdata($config["per_page"], $page);           


        //load view mahasiswa view
		$this->load->view('Header/Header',$data);
		$this->load->view('MasterDataPage',$data);
		$this->load->view('Footer/Footer',$data);
	}



	function DetailData($kodenegara=''){
    	//$where = array('kodenegara' => $kodenegara);
		$this->db->where('kodenegara', $kodenegara);
		$data['functiondetailnegara'] = $this->MData->datadetail($kodenegara);
		//$data['dataprediksi'] = $this->MData->dataprediksi($kodenegara);
		//$data['datax'] = $this->MData->datax($kodenegara);
		$data['max'] = $this->MData->max($kodenegara);
		$data['confirmed'] = $this->MData->countconkode($kodenegara);
		$data['death'] = $this->MData->countdekode($kodenegara);
		$data['recovered'] = $this->MData->countrekode($kodenegara);
		$data['namanegara_list'] = $this->MData->fetch_namanegara();
		//$data['hasil'] = $this->MData->hasil($kodenegara);

        //-----------------------------View---------------------------------------------------------------
		$this->load->view('Header/Header',$data);
		$this->load->view('DetailPage',$data);
		$this->load->view('Footer/Footer',$data);

	}

	public function NormalisasiPage()
	{

		//konfigurasi pagination
		$config['base_url'] = base_url().'CC/NormalisasiPage';        
		$config['total_rows'] = $this->MData->count_all_users();        
		$config['per_page'] = 20;        
		$config['uri_segment'] = 3;  


		 // Membuat Style pagination untuk BootStrap v4
		$config['first_link']       = 'First';
		$config['last_link']        = 'Last';
		$config['next_link']        = 'Next';
		$config['prev_link']        = 'Prev';
		$config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
		$config['full_tag_close']   = '</ul></nav></div>';
		$config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
		$config['num_tag_close']    = '</span></li>';
		$config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
		$config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
		$config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
		$config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['prev_tagl_close']  = '</span>Next</li>';
		$config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
		$config['first_tagl_close'] = '</span></li>';
		$config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['last_tagl_close']  = '</span></li>';

		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$this->pagination->initialize($config);        
		$data['pagination'] = $this->pagination->create_links();        

        //panggil function get_mahasiswa_list yang ada pada mmodel mahasiswa_model. 
		$data['pranormalisasi'] = $this->MData->getmasterdata($config["per_page"], $page);           


        //load view mahasiswa view
		$this->load->view('Header/Header',$data);
		$this->load->view('NormalisasiPage',$data);
		$this->load->view('Footer/Footer',$data);


	}

	public function Normalisasi($kodenegara='')
	{	
		$datanormalisasi = $this->db->query("SELECT * from datagrafik WHERE kodenegara = '$kodenegara'");
		$cek = $this->db->query("SELECT kodenegara from normalisasi WHERE kodenegara = '$kodenegara'");
		$data['confirmed'] = $this->MData->countconkode($kodenegara);
		$min = 0;
		$q = "";

		    // ---------------------------------Unit Masukan Normalisasi--------------------------------------------
		if(count($cek->result())==0)

		{
			foreach ($datanormalisasi->result() as $s) 
				{	$kodeunik = $s->kodenegara.date('dmy',strtotime($s->tanggal));
			$x1=(($s->confirmed-$min)/($data['confirmed']-$min));

			$x2=(($s->death-$min)/($data['confirmed']-$min));

			$x3=(($s->concasesdaily-$min)/($data['confirmed']-$min));

			$x4=(($s->deathcasesdaily-$min)/($data['confirmed']-$min));

			$x5=(($s->recovered-$min)/($data['confirmed']-$min));

			$q = "INSERT into normalisasi(kodeunik,kodenegara,tanggal,x1,x2,x3,x4,x5) values('".$kodeunik."','".$s->kodenegara."','".$s->tanggal."','".$x1."','".$x2."','".$x3."','".$x4."','".$x5."')";
			$this->db->query($q);
		}

	}else

	{
		foreach ($datanormalisasi->result() as $s) 
			{	$kodeunik = $s->kodenegara.date('dmy',strtotime($s->tanggal));
		$x1=(($s->confirmed-$min)/($data['confirmed']-$min));

		$x2=(($s->death-$min)/($data['confirmed']-$min));

		$x3=(($s->concasesdaily-$min)/($data['confirmed']-$min));

		$x4=(($s->deathcasesdaily-$min)/($data['confirmed']-$min));

		$x5=(($s->recovered-$min)/($data['confirmed']-$min));

		$q = "UPDATE normalisasi SET x1='".$x1."',x2='".$x2."',x3='".$x3."',x4='".$x4."',x5='".$x5."' WHERE kodeunik='$kodeunik'";
		$this->db->query($q);
	}
}

redirect('CC/ProcessPage');

}

public function ProcessPage()
{
//konfigurasi pagination
	$config['base_url'] = base_url().'CC/ProcessPage';        
	$config['total_rows'] = $this->MData->count_all_prediksi();        
	$config['per_page'] = 20;        
	$config['uri_segment'] = 3;  


		 // Membuat Style pagination untuk BootStrap v4
	$config['first_link']       = 'First';
	$config['last_link']        = 'Last';
	$config['next_link']        = 'Next';
	$config['prev_link']        = 'Prev';
	$config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
	$config['full_tag_close']   = '</ul></nav></div>';
	$config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
	$config['num_tag_close']    = '</span></li>';
	$config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
	$config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
	$config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
	$config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
	$config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
	$config['prev_tagl_close']  = '</span>Next</li>';
	$config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
	$config['first_tagl_close'] = '</span></li>';
	$config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
	$config['last_tagl_close']  = '</span></li>';

	$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
	$this->pagination->initialize($config);        
	$data['pagination'] = $this->pagination->create_links();        

        //panggil function get_mahasiswa_list yang ada pada mmodel mahasiswa_model. 
	$data['functionprediksi'] = $this->MData->getprediksi($config["per_page"], $page);           


        //load view mahasiswa view
	$this->load->view('Header/Header',$data);
	$this->load->view('ProcessPage',$data);
	$this->load->view('Footer/Footer',$data);
}

public function ProcessAlgoritma($kodenegara='')
{

	$datanormalisasi = $this->db->query("SELECT * from datagrafik WHERE kodenegara = '$kodenegara'");
	$cek = $this->db->query("SELECT kodenegara from normalisasi WHERE kodenegara = '$kodenegara'");

	$min = -5;
	$max = 5;
	$v01=rand($min,$max)/10;
	$v02=rand($min,$max)/10;
	$v03=rand($min,$max)/10;
	$v04=rand($min,$max)/10;


	$v11=rand($min,$max)/10;
	$v12=rand($min,$max)/10;
	$v13=rand($min,$max)/10;
	$v14=rand($min,$max)/10;


	$v21=rand($min,$max)/10;
	$v22=rand($min,$max)/10;
	$v23=rand($min,$max)/10;
	$v24=rand($min,$max)/10;


	$v31=rand($min,$max)/10;
	$v32=rand($min,$max)/10;
	$v33=rand($min,$max)/10;
	$v34=rand($min,$max)/10;


	$v41=rand($min,$max)/10;
	$v42=rand($min,$max)/10;
	$v43=rand($min,$max)/10;
	$v44=rand($min,$max)/10;


	$w0=rand($min,$max)/10;
	$w1=rand($min,$max)/10;
	$w2=rand($min,$max)/10;
	$w3=rand($min,$max)/10;
	$w4=rand($min,$max)/10;


// ------------------------------------ Start FeedForward---------------------------------------
	$dataZ = $this->db->query("SELECT * from normalisasi WHERE kodenegara = 'CHN' and tanggal <= '2020-05-21'   order by tanggal ")->result_array();

	$cek = $this->db->query("SELECT * from bobotbaru where kodenegara ='$kodenegara'");
	$cekbobotrandom = $this->db->query("SELECT * from bobotrandom where kodenegara ='$kodenegara'");
	$data['recovered'] = $this->MData->hasilre($kodenegara);
	$data['countday'] = $this->MData->countday($kodenegara);
	$data['counttraining'] = $this->MData->counttraining($kodenegara);
	$counttraining=$data['counttraining'];
	$data['counttesting'] = $this->MData->counttesting($kodenegara);
	$counttesting=$data['counttesting'];
	$recoveredx5=$data['recovered'];

	$x = array();
	$x2 = array();
	$x3 = array();
	$x4 = array();
	$x5 = array();
	foreach($dataZ as $row)
	{
		$x[] 	= $row['x1'];
		$x2[] 	= $row['x2'];
		$x3[] 	= $row['x3'];
		$x4[] 	= $row['x4'];
		$x5[] 	= $row['x5'];
	}

	$a=0.9;

	for ($j=0; $j<10000; $j++) {
		for($i=0; $i<= 119; $i++){      



        // ---------------------------------Unit Masukan Menerima Sinyal-------------------------------------------- 

			$Zin1   =$v01 + ($v11*$x[$i]) + ($v21*$x2[$i]) + ($v31*$x3[$i]) + ($v41*$x4[$i]);

		//echo "Zin1[$i]  =$v01 + ($v11*$x[$i]) + ($v21*$x2[$i]) + ($v31*$x3[$i]) + ($v41*$x4[$i]);<br>";

                            //-----------------------------------

			$Zin2   =$v02 + ($v12*$x[$i]) + ($v22*$x2[$i]) + ($v32*$x3[$i]) + ($v42*$x4[$i]);
		//echo "Zin2[$i]   =$v02 + ($v12*$x[$i]) + ($v22*$x2[$i]) + ($v32*$x3[$i]) + ($v42*$x4[$i]);<br>";

                            //-----------------------------------

			$Zin3   =$v03 + ($v13*$x[$i]) + ($v23*$x2[$i]) + ($v33*$x3[$i]) + ($v43*$x4[$i]);
		//echo "Zin3[$i]   =$v03 + ($v13*$x[$i]) + ($v23*$x2[$i]) + ($v33*$x3[$i]) + ($v43*$x4[$i]);<br>";

                            //-----------------------------------

			$Zin4   =$v04 + ($v14*$x[$i]) + ($v24*$x2[$i]) + ($v34*$x3[$i]) + ($v44*$x4[$i]);
		//echo "Zin4[$i]   =$v04 + ($v14*$x[$i]) + ($v24*$x2[$i]) + ($v34*$x3[$i]) + ($v44*$x4[$i]);<br>";




         // ---------------------------------Hitung Keluaran di Unit Tersembunyi--------------------------------------- 

                            //proses Pengaktifan

			$Z1=@(1/(1+(EXP($Zin1)*(-1))));
		                     //-----------------------------------
			$Z2=@(1/(1+(EXP($Zin2)*(-1))));	
                            //-----------------------------------
			$Z3=@(1/(1+(EXP($Zin3)*(-1))));
                            //-----------------------------------
			$Z4=@(1/(1+(EXP($Zin4)*(-1))));
							 //-----------------------------------

			$Yin=$w0+($w1*$Z1)+($w2*$Z2)+($w3*$Z3)+($w4*$Z4);

                        	//Pengaktifan
			$Y=1/(1+(EXP($Yin)*(-1)));

			$MSE=pow(($Y-$x5[$i]),2)/150;

//---------------------------------------- End FeedForward---------------------------------------------

// ---------------------------------------- Start BackForward------------------------------------------------
			//Error

			$dk=($x5[$i]-$Y)*$Y*(1-$Y);

		 // ---------------------------------Hitung Suku Perubahan Bobot--------------------------------------------
			$W0baru=$a*$dk;
			$W1baru=$a*$dk*$Z1;
			$W2baru=$a*$dk*$Z2;
			$W3baru=$a*$dk*$Z3;
			$W4baru=$a*$dk*$Z4;


			//Perbaharui Bobot

			$dkin1 = $dk * $w1;
			$dkin2 = $dk * $w2;
			$dkin3 = $dk * $w3;
			$dkin4 = $dk * $w4;


			$dk1 = $dkin1 * (1/1+(EXP(-$Z1))) * (1-(1/1+(EXP(-$Z1))));
			$dk2 = $dkin2 * (1/1+(EXP(-$Z2))) * (1-(1/1+(EXP(-$Z2))));
			$dk3 = $dkin3 * (1/1+(EXP(-$Z3))) * (1-(1/1+(EXP(-$Z3))));
			$dk4 = $dkin4 * (1/1+(EXP(-$Z4))) * (1-(1/1+(EXP(-$Z4))));



             //Hitung suku perubahan bobot V (yang akan dipakai nanti untuk merubah bobot  V)

			$v11baru = @($a * $dk1 * $x1[$i]);
			$v21baru = @($a * $dk1 * $x2[$i]);
			$v31baru = @($a * $dk1 * $x3[$i]);
			$v41baru = @($a * $dk1 * $x4[$i]);

			$v12baru = @($a * $dk2 * $x1[$i]);
			$v22baru = @($a * $dk2 * $x2[$i]);
			$v32baru = @($a * $dk2 * $x3[$i]);
			$v42baru = @($a * $dk2 * $x4[$i]);

			$v13baru = @($a * $dk3 * $x1[$i]);
			$v23baru = @($a * $dk3 * $x2[$i]);
			$v33baru = @($a * $dk3 * $x3[$i]);
			$v43baru = @($a * $dk3 * $x4[$i]);

			$v14baru = @($a * $dk4 * $x1[$i]);
			$v24baru = @($a * $dk4 * $x2[$i]);
			$v34baru = @($a * $dk4 * $x3[$i]);
			$v44baru = @($a * $dk4 * $x4[$i]);



			$v01baru = $a * $dk1;
			$v02baru = $a * $dk2;
			$v03baru = $a * $dk3;
			$v04baru = $a * $dk4;



			// ---------------------------------Perubahan Bobot--------------------------------------------
			$V11hidden = $v11 + $v11baru;
			$V21hidden = $v21 + $v21baru;
			$V31hidden = $v31 + $v31baru;
			$V41hidden = $v41 + $v41baru;

			$V12hidden = $v12 + $v12baru;
			$V22hidden = $v22 + $v22baru;
			$V32hidden = $v32 + $v32baru;
			$V42hidden = $v42 + $v42baru;

			$V13hidden = $v13 + $v13baru;
			$V23hidden = $v23 + $v23baru;
			$V33hidden = $v33 + $v33baru;
			$V43hidden = $v43 + $v43baru;

			$V14hidden = $v14 + $v14baru;
			$V24hidden = $v24 + $v24baru;
			$V34hidden = $v34 + $v34baru;
			$V44hidden = $v44 + $v44baru;

			$W0hidden = $w0 + $W0baru;
			$W1hidden = $w1 + $W1baru;
			$W2hidden = $w2 + $W2baru;
			$W3hidden = $w3 + $W3baru;
			$W4hidden = $w4 + $W4baru;


				//Rumus Error


	 // }
			$hasilmse[$j] = $MSE/10; 



		}

	}

	$totalmse = (array_sum($hasilmse))/$j;

	if(isset($cekbobotrandom))

	{
		$this->db->query("DELETE from bobotrandom where kodenegara ='$kodenegara'");
		$qr = "INSERT into bobotrandom(kodenegara,v01,v02,v03,v04,v11,v12,v13,v14,v21,v22,v23,v24,v31,v32,v33,v34,v41,v42,v43,v44,w0,w1,w2,w3,w4) values('".$kodenegara."','".$v01."','".$v02."','".$v03."','".$v04."','".$v11."','".$v12."','".$v13."','".$v14."','".$v21."','".$v22."','".$v23."','".$v24."','".$v31."','".$v32."','".$v33."','".$v34."','".$v41."','".$v42."','".$v43."','".$v44."','".$w0."','".$w1."','".$w2."','".$w3."','".$w4."')";
		$this->db->query($qr);



	}else

	{
		$qr = "INSERT into bobotrandom(kodenegara,v01,v02,v03,v04,v11,v12,v13,v14,v21,v22,v23,v24,v31,v32,v33,v34,v41,v42,v43,v44,w0,w1,w2,w3,w4) values('".$kodenegara."','".$v01."','".$v02."','".$v03."','".$v04."','".$v11."','".$v12."','".$v13."','".$v14."','".$v21."','".$v22."','".$v23."','".$v24."','".$v31."','".$v32."','".$v33."','".$v34."','".$v41."','".$v42."','".$v43."','".$v44."','".$w0."','".$w1."','".$w2."','".$w3."','".$w4."')";
		$this->db->query($qr);


	}

//-----------------------------------------------------------


	if(isset($cek))

	{
		$this->db->query("DELETE from bobotbaru where kodenegara ='$kodenegara'");
		$q = "INSERT into bobotbaru(kodenegara,v01,v02,v03,v04,v11,v12,v13,v14,v21,v22,v23,v24,v31,v32,v33,v34,v41,v42,v43,v44,w0,w1,w2,w3,w4,mse,epoch) values('".$kodenegara."','".$v01baru."','".$v02baru."','".$v03baru."','".$v04baru."','".$V11hidden."','".$V12hidden."','".$V13hidden."','".$V14hidden."','".$V21hidden."','".$V22hidden."','".$V23hidden."','".$V24hidden."','".$V31hidden."','".$V32hidden."','".$V33hidden."','".$V34hidden."','".$V41hidden."','".$V42hidden."','".$V43hidden."','".$V44hidden."','".$W0hidden."','".$W1hidden."','".$W2hidden."','".$W3hidden."','".$W4hidden."','".$totalmse."','".$j."')";
		$this->db->query($q);



	}else

	{
		$q = "INSERT into bobotbaru(kodenegara,v01,v02,v03,v04,v11,v12,v13,v14,v21,v22,v23,v24,v31,v32,v33,v34,v41,v42,v43,v44,w0,w1,w2,w3,w4,mse,epoch) values('".$kodenegara."','".$v01baru."','".$v02baru."','".$v03baru."','".$v04baru."','".$V11hidden."','".$V12hidden."','".$V13hidden."','".$V14hidden."','".$V21hidden."','".$V22hidden."','".$V23hidden."','".$V24hidden."','".$V31hidden."','".$V32hidden."','".$V33hidden."','".$V34hidden."','".$V41hidden."','".$V42hidden."','".$V43hidden."','".$V44hidden."','".$W0hidden."','".$W1hidden."','".$W2hidden."','".$W3hidden."','".$W4hidden."','".$totalmse."','".$j."')";
		$this->db->query($q);


	}
	redirect('CC/FinalPage');

}

public function FinalPage()
{

		//konfigurasi pagination
	$config['base_url'] = base_url().'CC/FinalPage';        
	$config['total_rows'] = $this->MData->count_all_users();        
	$config['per_page'] = 20;        
	$config['uri_segment'] = 3;  


		 // Membuat Style pagination untuk BootStrap v4
	$config['first_link']       = 'First';
	$config['last_link']        = 'Last';
	$config['next_link']        = 'Next';
	$config['prev_link']        = 'Prev';
	$config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
	$config['full_tag_close']   = '</ul></nav></div>';
	$config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
	$config['num_tag_close']    = '</span></li>';
	$config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
	$config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
	$config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
	$config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
	$config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
	$config['prev_tagl_close']  = '</span>Next</li>';
	$config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
	$config['first_tagl_close'] = '</span></li>';
	$config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
	$config['last_tagl_close']  = '</span></li>';

	$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
	$this->pagination->initialize($config);        
	$data['pagination'] = $this->pagination->create_links();        

        //panggil function get_mahasiswa_list yang ada pada mmodel mahasiswa_model. 
	$data['finalpage'] = $this->MData->getmasterdata($config["per_page"], $page);           


        //load view mahasiswa view
	$this->load->view('Header/Header',$data);
	$this->load->view('FinalPage',$data);
	$this->load->view('Footer/Footer',$data);
		// $data['dataprediksi'] = $this->MData->dataprediksi();

}

public function FinalAlgoritma($kodenegara='')
{
	$dataAkhir = $this->db->query("SELECT * from normalisasi where kodenegara= '$kodenegara' and tanggal = '2020-06-20'");

	$cekfinal = $this->db->query("SELECT * from final where kodenegara = '$kodenegara'");

	$this->db->where('kodenegara',$kodenegara);
	$databobot = $this->db->get('bobotbaru');
	$v01 ='';
	$v02 ='';
	$v03 ='';
	$v04 ='';

	$v11 ='';
	$v12 ='';
	$v13 ='';
	$v14 ='';

	$v21 ='';
	$v22 ='';
	$v23 ='';
	$v24 ='';

	$v31 ='';
	$v32 ='';
	$v33 ='';
	$v34 ='';

	$v41 ='';
	$v42 ='';
	$v43 ='';
	$v44 ='';

	foreach($databobot->result_array() as $b)
	{
		$v01 =$b['v01'];
		$v02 =$b['v02'];
		$v03 =$b['v03'];
		$v04 =$b['v04'];

		$v11 =$b['v11'];
		$v12 =$b['v12'];
		$v13 =$b['v13'];
		$v14 =$b['v14'];

		$v21 =$b['v21'];
		$v22 =$b['v22'];
		$v23 =$b['v23'];
		$v24 =$b['v24'];

		$v31 =$b['v31'];
		$v32 =$b['v32'];
		$v33 =$b['v33'];
		$v34 =$b['v34'];

		$v41 =$b['v41'];
		$v42 =$b['v42'];
		$v43 =$b['v43'];
		$v44 =$b['v44'];

		$w0 =$b['w0'];
		$w1 =$b['w1'];
		$w2 =$b['w2'];
		$w3 =$b['w3'];
		$w4 =$b['w4'];
	}
	$data['x5'] = $this->MData->hasilre($kodenegara);
	$datarecoveredprediksi =$data['x5'];
	$data['countday'] = $this->MData->countday($kodenegara);

	$data['maxre'] = $this->MData->maxrecovered($kodenegara);
	$maxre =$data['maxre'];

	$data['minre'] = $this->MData->minrecovered($kodenegara);
	$minre =$data['minre'];
	$q='';

	foreach ($dataAkhir->result() as $s) 
	{
		$Zin1prediksi = $v01 + ($v11 * $s->x1) + ($v21 * $s->x2) + ($v31 * $s->x3) + ($v41 * $s->x4);
		$Zin2prediksi = $v02 + ($v12 * $s->x1) + ($v22 * $s->x2) + ($v32 * $s->x3) + ($v42 * $s->x4);
		$Zin3prediksi = $v03 + ($v13 * $s->x1) + ($v23 * $s->x2) + ($v33 * $s->x3) + ($v43 * $s->x4);
		$Zin4prediksi = $v04 + ($v14 * $s->x1) + ($v24 * $s->x2) + ($v34 * $s->x3) + ($v44 * $s->x4);



                                //Pengaktifan

		$Z1iprediksi = (1/1+(EXP(-$Zin1prediksi)));
		$Z2iprediksi = (1/1+(EXP(-$Zin2prediksi)));
		$Z3iprediksi = (1/1+(EXP(-$Zin3prediksi)));
		$Z4iprediksi = (1/1+(EXP(-$Zin4prediksi)));


		$Yinbaru = $w0 + ($w1 * $Z1iprediksi) + ($w2 * $Z2iprediksi) + ($w3 * $Z3iprediksi) + ($w4 * $Z4iprediksi);
		$Ybaru = (1/1+(EXP(-$Yinbaru)));
		$hasilbaru = ($Ybaru*($maxre-$minre)) + $minre;
				//$hasilbaru=($Ybaru*($datamaxre-0))+0;
		if($hasilbaru<=0){
			$selisih=$datarecoveredprediksi;
		}else{
			$selisih = $datarecoveredprediksi - $hasilbaru;
		}

		$MAD=($datarecoveredprediksi-$Yinbaru);
		$MAPE = abs((($hasilbaru - $datarecoveredprediksi)/$hasilbaru)) * 100;
		$AKURASI = 100 - $MAPE;
	}
	$selisihperbandingan=$selisih;
	if(isset($cekfinal))

	{
		$this->db->query("DELETE from final where kodenegara ='$kodenegara'");

		$q = "INSERT into final(kodenegara,tanggal,prediksi,selisih,mad,mape,akurasi) values('".$s->kodenegara."','".$s->tanggal."','".$hasilbaru."','".$selisih."','".$MAD."','".$MAPE."','".$AKURASI."')";
		$this->db->query($q);
	}else{
		$q = "INSERT into final(kodenegara,tanggal,prediksi,selisih,mad,mape,akurasi) values('".$s->kodenegara."','".$s->tanggal."','".$hasilbaru."','".$selisih."','".$MAD."','".$MAPE."','".$AKURASI."')";
		$this->db->query($q);
	}


	redirect('CC/Report');


}
function AllAlgoritmaPage()

{

		//konfigurasi pagination
	$config['base_url'] = base_url().'CC/AllAlgoritmaPage';        
	$config['total_rows'] = $this->MData->count_all_users();        
	$config['per_page'] = 20;        
	$config['uri_segment'] = 3;  


		 // Membuat Style pagination untuk BootStrap v4
	$config['first_link']       = 'First';
	$config['last_link']        = 'Last';
	$config['next_link']        = 'Next';
	$config['prev_link']        = 'Prev';
	$config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
	$config['full_tag_close']   = '</ul></nav></div>';
	$config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
	$config['num_tag_close']    = '</span></li>';
	$config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
	$config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
	$config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
	$config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
	$config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
	$config['prev_tagl_close']  = '</span>Next</li>';
	$config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
	$config['first_tagl_close'] = '</span></li>';
	$config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
	$config['last_tagl_close']  = '</span></li>';

	$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
	$this->pagination->initialize($config);        
	$data['pagination'] = $this->pagination->create_links();        

        //panggil function get_mahasiswa_list yang ada pada mmodel mahasiswa_model. 
	$data['pranormalisasi'] = $this->MData->getmasterdata($config["per_page"], $page);           


        //load view mahasiswa view
	$this->load->view('Header/Header',$data);
	$this->load->view('AllAlgoritmaPage',$data);
	$this->load->view('Footer/Footer',$data);


}

public function AllAlgoritma($kodenegara=''){


	$datanormalisasi = $this->db->query("SELECT * from datagrafik WHERE kodenegara = '$kodenegara'");
	$cek = $this->db->query("SELECT kodenegara from normalisasi WHERE kodenegara = '$kodenegara'");
	$data['confirmed'] = $this->MData->countconkode($kodenegara);
	$min =0;
	$q = "";

		    // ---------------------------------Unit Masukan Normalisasi--------------------------------------------
	if(count($cek->result())==0)

	{
		foreach ($datanormalisasi->result() as $s) 
			{	$kodeunik = $s->kodenegara.date('dmy',strtotime($s->tanggal));
		$x1=(($s->confirmed-$min)/($data['confirmed']-$min));

		$x2=(($s->death-$min)/($data['confirmed']-$min));

		$x3=(($s->concasesdaily-$min)/($data['confirmed']-$min));

		$x4=(($s->deathcasesdaily-$min)/($data['confirmed']-$min));

		$x5=(($s->recovered-$min)/($data['confirmed']-$min));

		$q = "INSERT into normalisasi(kodeunik,kodenegara,tanggal,x1,x2,x3,x4,x5) values('".$kodeunik."','".$s->kodenegara."','".$s->tanggal."','".$x1."','".$x2."','".$x3."','".$x4."','".$x5."')";
		$this->db->query($q);
	}

}else

{
	foreach ($datanormalisasi->result() as $s) 
		{	$kodeunik = $s->kodenegara.date('dmy',strtotime($s->tanggal));
	$x1=(($s->confirmed-$min)/($data['confirmed']-$min));

	$x2=(($s->death-$min)/($data['confirmed']-$min));

	$x3=(($s->concasesdaily-$min)/($data['confirmed']-$min));

	$x4=(($s->deathcasesdaily-$min)/($data['confirmed']-$min));

	$x5=(($s->recovered-$min)/($data['confirmed']-$min));

	$q = "UPDATE normalisasi SET x1='".$x1."',x2='".$x2."',x3='".$x3."',x4='".$x4."',x5='".$x5."' WHERE kodeunik='$kodeunik' and kodenegara = '$kodenegara'";
	$this->db->query($q);
}
}

$min = -5;
$max = 5;
$v01=rand($min,$max)/10;
$v02=rand($min,$max)/10;
$v03=rand($min,$max)/10;
$v04=rand($min,$max)/10;


$v11=rand($min,$max)/10;
$v12=rand($min,$max)/10;
$v13=rand($min,$max)/10;
$v14=rand($min,$max)/10;


$v21=rand($min,$max)/10;
$v22=rand($min,$max)/10;
$v23=rand($min,$max)/10;
$v24=rand($min,$max)/10;


$v31=rand($min,$max)/10;
$v32=rand($min,$max)/10;
$v33=rand($min,$max)/10;
$v34=rand($min,$max)/10;


$v41=rand($min,$max)/10;
$v42=rand($min,$max)/10;
$v43=rand($min,$max)/10;
$v44=rand($min,$max)/10;


$w0=rand($min,$max)/10;
$w1=rand($min,$max)/10;
$w2=rand($min,$max)/10;
$w3=rand($min,$max)/10;
$w4=rand($min,$max)/10;







// ------------------------------------ Start FeedForward---------------------------------------
$dataZ = $this->db->query("SELECT * from normalisasi WHERE kodenegara = 'CHN' and tanggal <= '2020-05-21'   order by tanggal ")->result_array();

$cek = $this->db->query("SELECT * from bobotbaru where kodenegara ='$kodenegara'");
$cekbobotrandom = $this->db->query("SELECT * from bobotrandom where kodenegara ='$kodenegara'");
$data['recovered'] = $this->MData->hasilre($kodenegara);
$data['countday'] = $this->MData->countday($kodenegara);
$data['counttraining'] = $this->MData->counttraining($kodenegara);
$counttraining=$data['counttraining'];
$data['counttesting'] = $this->MData->counttesting($kodenegara);
$counttesting=$data['counttesting'];
$recoveredx5=$data['recovered'];

$x = array();
$x2 = array();
$x3 = array();
$x4 = array();
$x5 = array();
foreach($dataZ as $row)
{
	$x[] 	= $row['x1'];
	$x2[] 	= $row['x2'];
	$x3[] 	= $row['x3'];
	$x4[] 	= $row['x4'];
	$x5[] 	= $row['x5'];
}

$a=0.9;

for ($j=0; $j<10000; $j++) {
	for($i=0; $i<= 119; $i++){      



        // ---------------------------------Unit Masukan Menerima Sinyal-------------------------------------------- 

		$Zin1   =$v01 + ($v11*$x[$i]) + ($v21*$x2[$i]) + ($v31*$x3[$i]) + ($v41*$x4[$i]);
		
		//echo "Zin1[$i]  =$v01 + ($v11*$x[$i]) + ($v21*$x2[$i]) + ($v31*$x3[$i]) + ($v41*$x4[$i]);<br>";

                            //-----------------------------------

		$Zin2   =$v02 + ($v12*$x[$i]) + ($v22*$x2[$i]) + ($v32*$x3[$i]) + ($v42*$x4[$i]);
		//echo "Zin2[$i]   =$v02 + ($v12*$x[$i]) + ($v22*$x2[$i]) + ($v32*$x3[$i]) + ($v42*$x4[$i]);<br>";

                            //-----------------------------------

		$Zin3   =$v03 + ($v13*$x[$i]) + ($v23*$x2[$i]) + ($v33*$x3[$i]) + ($v43*$x4[$i]);
		//echo "Zin3[$i]   =$v03 + ($v13*$x[$i]) + ($v23*$x2[$i]) + ($v33*$x3[$i]) + ($v43*$x4[$i]);<br>";

                            //-----------------------------------

		$Zin4   =$v04 + ($v14*$x[$i]) + ($v24*$x2[$i]) + ($v34*$x3[$i]) + ($v44*$x4[$i]);
		//echo "Zin4[$i]   =$v04 + ($v14*$x[$i]) + ($v24*$x2[$i]) + ($v34*$x3[$i]) + ($v44*$x4[$i]);<br>";




         // ---------------------------------Hitung Keluaran di Unit Tersembunyi--------------------------------------- 

                            //proses Pengaktifan

		$Z1=@(1/(1+(EXP($Zin1)*(-1))));
		                     //-----------------------------------
		$Z2=@(1/(1+(EXP($Zin2)*(-1))));	
                            //-----------------------------------
		$Z3=@(1/(1+(EXP($Zin3)*(-1))));
                            //-----------------------------------
		$Z4=@(1/(1+(EXP($Zin4)*(-1))));
							 //-----------------------------------

		$Yin=$w0+($w1*$Z1)+($w2*$Z2)+($w3*$Z3)+($w4*$Z4);

                        	//Pengaktifan
		$Y=1/(1+(EXP($Yin)*(-1)));

		$MSE=pow(($Y-$x5[$i]),2)/150;

				//$err = ($s->x5-$Y)*$Y*(1$out); 
//---------------------------------------- End FeedForward---------------------------------------------

// ---------------------------------------- Start BackForward------------------------------------------------
			//Error

		$dk=($x5[$i]-$Y)*$Y*(1-$Y);

		 // ---------------------------------Hitung Suku Perubahan Bobot--------------------------------------------
		$W0baru=$a*$dk;
		$W1baru=$a*$dk*$Z1;
		$W2baru=$a*$dk*$Z2;
		$W3baru=$a*$dk*$Z3;
		$W4baru=$a*$dk*$Z4;


			//Perbaharui Bobot

		$dkin1 = $dk * $w1;
		$dkin2 = $dk * $w2;
		$dkin3 = $dk * $w3;
		$dkin4 = $dk * $w4;


		$dk1 = $dkin1 * (1/1+(EXP(-$Z1))) * (1-(1/1+(EXP(-$Z1))));
		$dk2 = $dkin2 * (1/1+(EXP(-$Z2))) * (1-(1/1+(EXP(-$Z2))));
		$dk3 = $dkin3 * (1/1+(EXP(-$Z3))) * (1-(1/1+(EXP(-$Z3))));
		$dk4 = $dkin4 * (1/1+(EXP(-$Z4))) * (1-(1/1+(EXP(-$Z4))));



             //Hitung suku perubahan bobot V (yang akan dipakai nanti untuk merubah bobot  V)

		$v11baru = @($a * $dk1 * $x1[$i]);
		$v21baru = @($a * $dk1 * $x2[$i]);
		$v31baru = @($a * $dk1 * $x3[$i]);
		$v41baru = @($a * $dk1 * $x4[$i]);

		$v12baru = @($a * $dk2 * $x1[$i]);
		$v22baru = @($a * $dk2 * $x2[$i]);
		$v32baru = @($a * $dk2 * $x3[$i]);
		$v42baru = @($a * $dk2 * $x4[$i]);

		$v13baru = @($a * $dk3 * $x1[$i]);
		$v23baru = @($a * $dk3 * $x2[$i]);
		$v33baru = @($a * $dk3 * $x3[$i]);
		$v43baru = @($a * $dk3 * $x4[$i]);

		$v14baru = @($a * $dk4 * $x1[$i]);
		$v24baru = @($a * $dk4 * $x2[$i]);
		$v34baru = @($a * $dk4 * $x3[$i]);
		$v44baru = @($a * $dk4 * $x4[$i]);



		$v01baru = $a * $dk1;
		$v02baru = $a * $dk2;
		$v03baru = $a * $dk3;
		$v04baru = $a * $dk4;



			// ---------------------------------Perubahan Bobot--------------------------------------------
		$V11hidden = $v11 + $v11baru;
		$V21hidden = $v21 + $v21baru;
		$V31hidden = $v31 + $v31baru;
		$V41hidden = $v41 + $v41baru;

		$V12hidden = $v12 + $v12baru;
		$V22hidden = $v22 + $v22baru;
		$V32hidden = $v32 + $v32baru;
		$V42hidden = $v42 + $v42baru;

		$V13hidden = $v13 + $v13baru;
		$V23hidden = $v23 + $v23baru;
		$V33hidden = $v33 + $v33baru;
		$V43hidden = $v43 + $v43baru;

		$V14hidden = $v14 + $v14baru;
		$V24hidden = $v24 + $v24baru;
		$V34hidden = $v34 + $v34baru;
		$V44hidden = $v44 + $v44baru;

		$W0hidden = $w0 + $W0baru;
		$W1hidden = $w1 + $W1baru;
		$W2hidden = $w2 + $W2baru;
		$W3hidden = $w3 + $W3baru;
		$W4hidden = $w4 + $W4baru;


				//Rumus Error


	 // }
		$hasilmse[$j] = $MSE/10; 



	}
	
}

$totalmse = (array_sum($hasilmse))/$j;

if(isset($cekbobotrandom))

{
	$this->db->query("DELETE from bobotrandom where kodenegara ='$kodenegara'");
	$qr = "INSERT into bobotrandom(kodenegara,v01,v02,v03,v04,v11,v12,v13,v14,v21,v22,v23,v24,v31,v32,v33,v34,v41,v42,v43,v44,w0,w1,w2,w3,w4) values('".$kodenegara."','".$v01."','".$v02."','".$v03."','".$v04."','".$v11."','".$v12."','".$v13."','".$v14."','".$v21."','".$v22."','".$v23."','".$v24."','".$v31."','".$v32."','".$v33."','".$v34."','".$v41."','".$v42."','".$v43."','".$v44."','".$w0."','".$w1."','".$w2."','".$w3."','".$w4."')";
	$this->db->query($qr);



}else

{
	$qr = "INSERT into bobotrandom(kodenegara,v01,v02,v03,v04,v11,v12,v13,v14,v21,v22,v23,v24,v31,v32,v33,v34,v41,v42,v43,v44,w0,w1,w2,w3,w4) values('".$kodenegara."','".$v01."','".$v02."','".$v03."','".$v04."','".$v11."','".$v12."','".$v13."','".$v14."','".$v21."','".$v22."','".$v23."','".$v24."','".$v31."','".$v32."','".$v33."','".$v34."','".$v41."','".$v42."','".$v43."','".$v44."','".$w0."','".$w1."','".$w2."','".$w3."','".$w4."')";
	$this->db->query($qr);


}

//-----------------------------------------------------------


if(isset($cek))

{
	$this->db->query("DELETE from bobotbaru where kodenegara ='$kodenegara'");
	$q = "INSERT into bobotbaru(kodenegara,v01,v02,v03,v04,v11,v12,v13,v14,v21,v22,v23,v24,v31,v32,v33,v34,v41,v42,v43,v44,w0,w1,w2,w3,w4,mse,epoch) values('".$kodenegara."','".$v01baru."','".$v02baru."','".$v03baru."','".$v04baru."','".$V11hidden."','".$V12hidden."','".$V13hidden."','".$V14hidden."','".$V21hidden."','".$V22hidden."','".$V23hidden."','".$V24hidden."','".$V31hidden."','".$V32hidden."','".$V33hidden."','".$V34hidden."','".$V41hidden."','".$V42hidden."','".$V43hidden."','".$V44hidden."','".$W0hidden."','".$W1hidden."','".$W2hidden."','".$W3hidden."','".$W4hidden."','".$totalmse."','".$j."')";
	$this->db->query($q);



}else

{
	$q = "INSERT into bobotbaru(kodenegara,v01,v02,v03,v04,v11,v12,v13,v14,v21,v22,v23,v24,v31,v32,v33,v34,v41,v42,v43,v44,w0,w1,w2,w3,w4,mse,epoch) values('".$kodenegara."','".$v01baru."','".$v02baru."','".$v03baru."','".$v04baru."','".$V11hidden."','".$V12hidden."','".$V13hidden."','".$V14hidden."','".$V21hidden."','".$V22hidden."','".$V23hidden."','".$V24hidden."','".$V31hidden."','".$V32hidden."','".$V33hidden."','".$V34hidden."','".$V41hidden."','".$V42hidden."','".$V43hidden."','".$V44hidden."','".$W0hidden."','".$W1hidden."','".$W2hidden."','".$W3hidden."','".$W4hidden."','".$totalmse."','".$j."')";
	$this->db->query($q);


}

$dataAkhir = $this->db->query("SELECT * from normalisasi where kodenegara= '$kodenegara' and tanggal = '2020-06-20'");

$cekfinal = $this->db->query("SELECT * from final where kodenegara = '$kodenegara'");

$this->db->where('kodenegara',$kodenegara);
$databobot = $this->db->get('bobotbaru');
$v01=$v01baru;
$v02=$v02baru;
$v03=$v03baru;
$v04=$v04baru;


$v11=$V11hidden;
$v12=$V12hidden;
$v13=$V13hidden;
$v14=$V14hidden;


$v21=$V21hidden;
$v22=$V22hidden;
$v23=$V23hidden;
$v24=$V24hidden;


$v31=$V31hidden;
$v32=$V32hidden;
$v33=$V33hidden;
$v34=$V34hidden;


$v41=$V41hidden;
$v42=$V42hidden;
$v43=$V43hidden;
$v44=$V44hidden;


foreach($databobot->result_array() as $b)
{
	$v01 =$b['v01'];
	$v02 =$b['v02'];
	$v03 =$b['v03'];
	$v04 =$b['v04'];

	$v11 =$b['v11'];
	$v12 =$b['v12'];
	$v13 =$b['v13'];
	$v14 =$b['v14'];

	$v21 =$b['v21'];
	$v22 =$b['v22'];
	$v23 =$b['v23'];
	$v24 =$b['v24'];

	$v31 =$b['v31'];
	$v32 =$b['v32'];
	$v33 =$b['v33'];
	$v34 =$b['v34'];

	$v41 =$b['v41'];
	$v42 =$b['v42'];
	$v43 =$b['v43'];
	$v44 =$b['v44'];

	$w0 =$b['w0'];
	$w1 =$b['w1'];
	$w2 =$b['w2'];
	$w3 =$b['w3'];
	$w4 =$b['w4'];
}
$data['x5'] = $this->MData->hasilre($kodenegara);
$datarecoveredprediksi =$data['x5'];
$data['countday'] = $this->MData->countday($kodenegara);

$data['maxre'] = $this->MData->maxrecovered($kodenegara);
$maxre =$data['maxre'];

$data['minre'] = $this->MData->minrecovered($kodenegara);
$minre =$data['minre'];
$q='';


foreach ($dataAkhir->result() as $s) 
{
	$Zin1prediksi = $v01 + ($v11 * $s->x1) + ($v21 * $s->x2) + ($v31 * $s->x3) + ($v41 * $s->x4);
	$Zin2prediksi = $v02 + ($v12 * $s->x1) + ($v22 * $s->x2) + ($v32 * $s->x3) + ($v42 * $s->x4);
	$Zin3prediksi = $v03 + ($v13 * $s->x1) + ($v23 * $s->x2) + ($v33 * $s->x3) + ($v43 * $s->x4);
	$Zin4prediksi = $v04 + ($v14 * $s->x1) + ($v24 * $s->x2) + ($v34 * $s->x3) + ($v44 * $s->x4);



                                //Pengaktifan

	$Z1iprediksi = (1/1+(EXP(-$Zin1prediksi)));
	$Z2iprediksi = (1/1+(EXP(-$Zin2prediksi)));
	$Z3iprediksi = (1/1+(EXP(-$Zin3prediksi)));
	$Z4iprediksi = (1/1+(EXP(-$Zin4prediksi)));


	$Yinbaru = $w0 + ($w1 * $Z1iprediksi) + ($w2 * $Z2iprediksi) + ($w3 * $Z3iprediksi) + ($w4 * $Z4iprediksi);
	$Ybaru = (1/1+(EXP(-$Yinbaru)));

	$hasilbaru = ($Ybaru*($maxre-$minre)) + $minre;
	$data['recovered20'] = $this->MData->datarecoveredtaggal21($kodenegara);
	$datatanggal20 =$data['recovered20'];

	if($hasilbaru == $datatanggal20){
		$hasilbaru = 0;
	}

	if($hasilbaru<=0){
		$selisih= (0)-($datarecoveredprediksi);
	}else{
		$selisih = $hasilbaru - $datarecoveredprediksi ;
	}
	

	$MAD=($datarecoveredprediksi-$Yinbaru);
	$MAPE = (($MAD)/$data['countday']);
	$AKURASI = 100 - $MAPE;
}
$selisihperbandingan=$selisih;

$cekZ = $this->db->query("SELECT * from zprediksi where kodenegara = '$kodenegara'");

if(isset($cekZ))

{
	$cekZ = $this->db->query("SELECT * from zprediksi where kodenegara = '$kodenegara'");
	$this->db->query("DELETE from zprediksi where kodenegara ='$kodenegara'");

	$q = "INSERT into zprediksi(kodenegara,zin1prediksi,zin2prediksi,zin3prediksi,zin4prediksi,z1prediksi,z2prediksi,z3prediksi,z4prediksi,yinbaru,ybaru,hasilbaru) 

	values('".$s->kodenegara."','".$Zin1prediksi."','".$Zin2prediksi."','".$Zin3prediksi."','".$Zin4prediksi."','".$Z1iprediksi."','".$Z2iprediksi."','".$Z3iprediksi."','".$Z4iprediksi."','".$Yinbaru."','".$Ybaru."','".$hasilbaru."')";
	$this->db->query($q);
}else{
	$q = "INSERT into zprediksi(kodenegara,zin1prediksi,zin2prediksi,zin3prediksi,zin4prediksi,z1prediksi,z2prediksi,z3prediksi,z4prediksi,yinbaru,ybaru,hasilbaru) 

	values('".$s->kodenegara."','".$Zin1prediksi."','".$Zin2prediksi."','".$Zin3prediksi."','".$Zin4prediksi."','".$Z1iprediksi."','".$Z2iprediksi."','".$Z3iprediksi."','".$Z4iprediksi."','".$Yinbaru."','".$Ybaru."','".$hasilbaru."')";
	$this->db->query($q);
}

//----------------------------------------------------------------------------------------------

if(isset($cekfinal))

{
	$this->db->query("DELETE from final where kodenegara ='$kodenegara'");

	$q = "INSERT into final(kodenegara,tanggal,prediksi,selisih,mad,mape,akurasi,training,testing,ybaru) values('".$s->kodenegara."','".$s->tanggal."','".$hasilbaru."','".$selisih."','".$MAD."','".$MAPE."','".$AKURASI."','".$counttraining."','".$counttesting."','".$Ybaru."')";
	$this->db->query($q);
}else{
	$q = "INSERT into final(kodenegara,tanggal,prediksi,selisih,mad,mape,akurasi,training,testing,ybaru) values('".$s->kodenegara."','".$s->tanggal."','".$hasilbaru."','".$selisih."','".$MAD."','".$MAPE."','".$AKURASI."','".$counttraining."','".$counttesting."','".$Ybaru."')";
	$this->db->query($q);
}


redirect('CC/Report');
//redirect('CC/AllAlgoritmaPage');


}


public function Report()
{
	$data['graph'] = $this->MData->fetch_chart_data_report();
	$data['datahasil'] = $this->MData->hasilprediksi();
	$this->load->view('Header/Header');
	$this->load->view('ReportPage',$data);
	$this->load->view('Footer/Footer',$data);
}

function Detailnormalisasi($kodenegara=''){
	$this->db->where('kodenegara', $kodenegara);
	$data['Detailnormalisasi'] = $this->MData->Detailnormalisasi($kodenegara);
        //-----------------------------View---------------------------------------------------------------
	$this->load->view('Header/Header',$data);
	$this->load->view('DetailNormalisasiPage',$data);
	$this->load->view('Footer/Footer',$data);

}

function Detailprocess($kodenegara=''){
	$this->db->where('kodenegara', $kodenegara);
	$data['Detailprocess'] = $this->MData->Detailprocess($kodenegara);
	$data['Detailrandombobot'] = $this->MData->Detailrandombobot($kodenegara);
        //-----------------------------View---------------------------------------------------------------
	$this->load->view('Header/Header',$data);
	$this->load->view('DetailProcessPage',$data);
	$this->load->view('Footer/Footer',$data);

}

function getAutoComplete()
{
	$namanegara=$this->input->post('namanegara');
	$getKodeNegara =$this->MData->getKodeNegara($namanegara);
	//$tanggalprediksi =$this->MData->tanggalprediksi($namanegara);
	echo json_encode($getKodeNegara);
}

function getAutoCompleteEdit()
{
	$kodeunik=$this->input->post('kodeunik');
	$getKodeunik =$this->MData->getKodeunik($kodeunik);
	//$tanggalprediksi =$this->MData->tanggalprediksi($namanegara);
	echo json_encode($getKodeunik);
} 

function InputForecast()
{
	//$data['forecastedit'] = $this->MData->GetEditForecast($kodenegara)->result();
	$data['namanegara_list'] = $this->MData->fetch_namanegara();
	$this->load->view('Header/Header');
	$this->load->view('InputForecastPage',$data);
	$this->load->view('Footer/Footer');
}

function AksiInputForecast(){
	
	$kodenegara = $this->input->post('kodenegara');
	$namanegara = $this->input->post('namanegara');
	$tanggal = $this->input->post('tanggal');
	$confirmed = $this->input->post('confirmed');
	$death = $this->input->post('death');

	$kodeunik = $kodenegara.date('Y-m-d',strtotime($tanggal));
	$confirmedsebelum = $this->input->post('confirmedsebelum');
	$deathsebelum = $this->input->post('deathsebelum');

	$concasesdaily = ($confirmed - $confirmedsebelum);
	$deathcasesdaily = ($death - $deathsebelum);
	$recovered = $this->input->post('recovered');

	$data = array(
		'kodeunik' => $kodeunik,
		'kodenegara' => $kodenegara,
		'namanegara' => $namanegara,
		'tanggal' => $tanggal,
		'confirmed' => $confirmed,
		'death' => $death,
		'concasesdaily' => $concasesdaily,
		'deathcasesdaily' => $deathcasesdaily,
		'recovered' => $recovered
	);

	$this->MData->AksiInputForecast($data,'datagrafik');
	redirect('CC/MasterData');
}

function EditForecast($kodeunik)
{
	$where = array('kodeunik' => $kodeunik);
	$data['forecastedit'] = $this->MData->EditForecast($where,'datagrafik')->result();
	$data['yesterday'] = $this->MData->yesterday($kodeunik)->result();
	$this->load->view('Header/Header');
	$this->load->view('EditForecastPage',$data);
	$this->load->view('Footer/Footer');
}

function AksiEditForecast(){

	$kodeunik = $this->input->post('kodeunik');
	$kodenegara = $this->input->post('kodenegara');
	$namanegara = $this->input->post('namanegara');
	$tanggal = $this->input->post('tanggal');
	$confirmed = $this->input->post('confirmed');
	$death = $this->input->post('death');
	$recovered = $this->input->post('recovered');

	$yesterdayconfirmed = $this->input->post('editconfirmedsebelum');
	$yesterdaydeath = $this->input->post('editdeathsebelum');
	$concasesdaily = ($confirmed - $yesterdayconfirmed);
	$deathcasesdaily = ($death - $yesterdaydeath);


	$data = array(
		'kodenegara' => $kodenegara,
		'namanegara' => $namanegara,
		'tanggal' => $tanggal,
		'confirmed' => $confirmed,
		'death' => $death,
		'concasesdaily' => $concasesdaily,
		'deathcasesdaily' => $deathcasesdaily,
		'recovered' => $recovered
	);

	$where = array(
		'kodeunik' => $kodeunik
	);

	$this->MData->AksiEditForecast($where,$data,'datagrafik');
	redirect('CC/MasterData');
}


public function UploadForecast()
{
		//ketika button submit diklik
	if ($this->input->post('submit', TRUE) == 'upload')
	{
            $config['upload_path']      = './uploads/'; //siapkan path untuk upload file
            $config['allowed_types']    = 'xlsx|xls'; //siapkan format file
            $config['file_name']        = 'doc'.time(); //rename file yang diupload

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('excel'))
            {
                //fetch data upload
            	$file   = $this->upload->data();

                $reader = ReaderFactory::create(Type::XLSX); //set Type file xlsx
                $reader->open('uploads/'.$file['file_name']); //open file xlsx

                //looping pembacaat sheet dalam file        
                foreach ($reader->getSheetIterator() as $sheet)
                {
                	$numRow = 1;

                    //siapkan variabel array kosong untuk menampung variabel array data
                	$save   = array();

                    //looping pembacaan row dalam sheet
                	foreach ($sheet->getRowIterator() as $row)
                	{
                		if ($numRow > 1)
                		{
                			$data = array(
                				'kodeunik'    		=> $row[0],
                				'kodenegara'  		=> $row[1],
                				'namanegara'    	=> $row[2],
                				'tanggal'    		=> $row[3],
                				'confirmed'   		=> $row[4],
                				'death'    			=> $row[5],
                				'concasesdaily' 	=> $row[6],
                				'deathcasesdaily' 	=> $row[7],
                				'recovered'    		=> $row[8],
                			);

                            //tambahkan array $data ke $save
                			array_push($save, $data);
                		}

                		$numRow++;
                	}
                    //simpan data ke database
                	$this->MData->AksiInputForecastExcel($save);

                    //tutup spout reader
                	$reader->close();

                    //hapus file yang sudah diupload
                	unlink('uploads/'.$file['file_name']);

                    //tampilkan pesan success dan redirect ulang ke index controller import
                	echo    '<script type="text/javascript">
                	alert(\'UPLOAD SUCCESS\');
                	window.location.replace("'.base_url('CC/InputForecast').'");
                	</script>';
                }
            }
            else
            {
                echo "Error :".$this->upload->display_errors(); //tampilkan pesan error jika file gagal diupload
            }
        }
        $this->session->set_flashdata('uploadsuccess', 'Success Upload Data');
        $this->load->view('Header/Header');
        $this->load->view('InputForecastPage');
        $this->load->view('Footer/Footer');

    }

    public function InputMaster()
    {
    	$this->load->view('Header/Header');
    	$this->load->view('InputMasterPage');
    	$this->load->view('Footer/Footer');
    }

    function AksiInputMaster()
    {
    	$kodenegara = $this->input->post('kodenegara');
    	$namanegara = $this->input->post('namanegara');
    	$populasi = $this->input->post('populasi');
    	$wilayah = $this->input->post('wilayah');

    	$data = array(
    		'kodenegara' => $kodenegara,
    		'namanegara' => $namanegara,
    		'populasi' => $populasi,
    		'wilayah' => $wilayah
    	);
    	$this->MData->AksiInputMaster($data,'masterdata');
    	$this->session->set_flashdata('inputsuccess', 'Success Input Data');
    	redirect('CC/MasterData');
    }

    function EditMasterData($id)
    {
    	$where = array('id' => $id);
    	$data['masterdataedit'] = $this->MData->EditMasterData($where,'masterdata')->result();
    	$this->load->view('Header/Header');
    	$this->load->view('EditMasterPage',$data);
    	$this->load->view('Footer/Footer');
    }

    function AksiEditMaster(){
    	$id = $this->input->post('id');
    	$kodenegara = $this->input->post('kodenegara');
    	$namanegara = $this->input->post('namanegara');
    	$populasi = $this->input->post('populasi');
    	$wilayah = $this->input->post('wilayah');

    	$data = array(
    		'kodenegara' => $kodenegara,
    		'namanegara' => $namanegara,
    		'populasi' => $populasi,
    		'wilayah' => $wilayah
    	);

    	$where = array(
    		'id' => $id
    	);

    	$this->MData->AksiEditMaster($where,$data,'masterdata');
    	$this->session->set_flashdata('editsuccess', 'Success Update Data');
    	redirect('CC/MasterData');
    }

    function AksiHapusMaster($id){
    	$where = array('id' => $id);
    	$this->MData->AksiHapusMaster($where,'masterdata');
    	$this->session->set_flashdata('deletesuccess', 'Success Delete Data');
    	redirect('CC/MasterData');
    }

    public function ExportReport()
    {
        //ambil data
    	$get    = $this->MData->export();

        //validasi jumlah data
    	if ($get->num_rows() > 0)
    	{
    		$writer = WriterFactory::create(Type::XLSX);

    		$writer->openToBrowser("Report.xlsx");
            //silahkan sobat sesuaikan dengan data yang ingin sobat tampilkan
    		$header = [
    			'No',
    			'Country Code',
    			'Country Name',
    			'Date',
    			'Confirmed',
    			'Death',
    			'Confirmed Cases Daily',
    			'Death Cases Daily',
    			'Recovered',
    			'Predicton',
    			'Difference'
    		];

            $writer->addRow($header); //tambah row untuk header data

            $data   = array(); //siapkan variabel array untuk menampung data
            $no     = 1;

            //looping pembacaan data
            foreach ($get->result() as $key)
            {
                //masukkan data dari database ke variabel array
                //silahkan sobat sesuaikan dengan nama field pada tabel database
            	$reportdata    = array(
            		$no++,
            		$key->kodenegara,
            		$key->namanegara,
            		$key->tanggalprediksi,
            		$key->confirmed,
            		$key->death,
            		$key->concasesdaily,
            		$key->deathcasesdaily,
            		$key->recovered,
            		$key->prediksi,
            		$key->selisih
            	);

                array_push($data, $reportdata); //masukkan variabel array anggota ke variabel array data
            }

            $writer->addRows($data); // tambahkan row untuk data anggota

            $writer->close(); //tutup spout writer
        }
        else
        {
        	echo "DATA NOT FOUND!";
        }
    }

    public function Coba()
    {

    	$dataZ = $this->db->query("SELECT * from normalisasi WHERE kodenegara = 'CHN' and tanggal <= '2020-05-21'   order by tanggal ")->result_array();
    	$x = array();
    	foreach($dataZ as $row)
    	{
    		$x[] = $row['x1'];
    		$x2[] = $row['x2'];
    		$x3[] = $row['x3'];
    		$x4[] = $row['x4'];
    	}
    	for($i=0; $i<= 5; $i++){
    		echo "
    		x1$i =$x[$i]<br>
    		x2$i =$x2[$i]<br>
    		x3$i =$x3[$i]<br>
    		x4$i =$x4[$i]<br>";
    	}



    }
}



