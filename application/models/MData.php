<?php
class MData extends CI_Model{

	function CekLogin($username,$password){
		$this->db->where('username',$username);
		$this->db->where('password', $password);
		$result = $this->db->get('user',1);
		return $result;
	}


	function fetch_namanegara()
	{
		$this->db->select('namanegara');
		$this->db->from('datagrafik');
		$this->db->group_by('namanegara');
		$this->db->order_by('namanegara', 'ASC');
		return $this->db->get();
	}


	function fetch_chart_data($namanegara)
	{
		$this->db->where('namanegara', $namanegara);
		$this->db->where('confirmed >',0 );
		$this->db->order_by('tanggal', 'ASC');
		// $this->db->group_by('YEARWEEK(tanggal)','tanggal');
		return $this->db->get('datagrafik');
	}

	function fetch_chart_data_report()
	{
		$this->db->select('*');
		$this->db->from('final');
		$this->db->where('datagrafik.tanggal=', '2020-06-21');
		//$this->db->like('datagrafik.kodenegara', 'C', 'after');
		$this->db->join('datagrafik', 'final.kodenegara = datagrafik.kodenegara');
		$this->db->order_by('namanegara', 'ASC');

		$data = $this->db->get();
		return $data->result();

	}

	private function _get_users_data(){ 
		$this->db->select('*'); 
		$this->db->from('masterdata'); 
	}

	private function _get_prediksi_data(){ 
		$this->db->select('*'); 
		$this->db->from('masterdata');
	}

	public function _get_detaildata($kodenegara = NULL){ 
		$this->db->select('*'); 
		$this->db->from('datagrafik');
		$this->db->where('kodenegara','$kodenegara');

	}

	function getdetailnegara($limit,$start){
		$this->_get_detaildata(); 
		$this->db->limit($limit, $start); 
		$query = $this->db->get(); 
		return $query->result_array(); 
	}

	function getprediksi($limit,$start){
		$this->_get_prediksi_data(); 
		$this->db->limit($limit, $start); 
		$query = $this->db->get(); 
		return $query->result_array(); 
	}

	function getmasterdata($limit,$start){
		$this->_get_users_data(); 
		$this->db->limit($limit, $start);
		$query = $this->db->get(); 
		return $query->result_array(); 
	}

	public function count_all_users(){ 
		$this->_get_users_data(); 
		$query = $this->db->count_all_results(); 
		return $query; 
	}

	public function count_all_prediksi(){ 
		$this->_get_prediksi_data(); 
		$query = $this->db->count_all_results(); 
		return $query; 
	}

	public function count_all_detailnegara(){ 
		$this->_get_detaildata(); 
		$query = $this->db->count_all_results(); 
		return $query; 
	}

	function countcon(){
		$this->db->select_sum('confirmed');
		$countcon = $this->db->get('datagrafik')->row();  
		return $countcon->confirmed;
	}

	function countconkode($kodenegara){
		$this->db->select('confirmed');
		$this->db->where('kodenegara', $kodenegara);
		$this->db->where('tanggal', '2020-06-20');
		$query = $this->db->get('datagrafik')->row();
		return $query->confirmed;
	}

	function countde(){
		$this->db->select_sum('death');
		$countde = $this->db->get('datagrafik')->row();  
		return $countde->death;

	}

	function countdekode($kodenegara){
		$this->db->select('death');
		$this->db->where('kodenegara', $kodenegara);
		$this->db->where('tanggal', '2020-06-20');
		$query = $this->db->get('datagrafik')->row();
		return $query->death;
	}

	function countrecovered(){
		$this->db->select_sum('recovered');
		$countrecovered = $this->db->get('datagrafik')->row();  
		return $countrecovered->recovered;

	}

	function countrekode($kodenegara){
		$this->db->select('recovered');
		$this->db->where('kodenegara', $kodenegara);
		$this->db->where('tanggal', '2020-06-20');
		$query = $this->db->get('datagrafik')->row();
		return $query->recovered;
	}


	function datadetail($kodenegara){    
		$this->db->select('*');
		$this->db->where('kodenegara', $kodenegara);
		$this->db->order_by('tanggal', 'DESC');
		$query = $this->db->get('datagrafik');
		return $query->result();

	}


	function datapranormalisasi($kodenegara){    
		$this->db->select('*');
		$this->db->where('kodenegara', $kodenegara);
		$query = $this->db->get('masterdata');

	}

	function datanormalisasi($where,$table){        
		return $this->db->get_where($table,$where);

	}

	function max($kodenegara){   
		$this->db->select_max('confirmed');
		$this->db->where('kodenegara', $kodenegara);
		$query = $this->db->get('datagrafik')->row(); 
		return $query->confirmed;

	}

	function hasil($kodenegara){    
		$this->db->select('*');
		$this->db->where('kodenegara', $kodenegara);
		$this->db->order_by('tanggal', 'ASC');
		$query = $this->db->get('hasilprediksi');
		return $query->result();

	}

	function backpropagation($kodenegara){    
		$this->db->select('*');
		$this->db->where('kodenegara', $kodenegara);
		$query = $this->db->get('normalisasi');
		return $query->result();

	}

	function bobotbaru($kodenegara){    
		$this->db->select('*');
		$this->db->where('kodenegara', $kodenegara);
		$query = $this->db->get('bobotbaru');
		return $query->result();

	}


	function FinalPage(){
		$this->db->select('*');
		$query = $this->db->get('masterdata');
		return $query->result();

	}

	

	function maxcon($kodenegara){
		$this->db->select_max('confirmed');
		$this->db->select('kodenegara');
		$this->db->where('kodenegara', $kodenegara);
		$query = $this->db->get('datagrafik')->row();
		return $query->confirmed;
	}

	function hasilre($kodenegara){
		$this->db->select('recovered');
		$this->db->select('kodenegara');
		//$this->db->select_max('tanggal');
		$this->db->where('kodenegara', $kodenegara);
		$this->db->where('tanggal=', '2020-06-22');
		$query = $this->db->get('datagrafik')->row();
		return $query->recovered;
	}

	function hasilprediksi(){
		$this->db->select('*');
		//$this->db->select_max('datagrafik.tanggal');
		$this->db->from('final');
		$this->db->where('datagrafik.tanggal=', '2020-06-21');
		$this->db->join('datagrafik', 'final.kodenegara = datagrafik.kodenegara');
		$this->db->order_by('namanegara');

		$query = $this->db->get();
		return $query->result_array();

	}

	function export(){
		$hsl=$this->db->query("SELECT *,datagrafik.tanggal as tanggalprediksi FROM datagrafik join final WHERE datagrafik.kodenegara= final.kodenegara and  datagrafik.tanggal ='2020-06-21' order by datagrafik.namanegara ASC");

		return $hsl;


	}

	function maxrecovered($kodenegara){
		$this->db->select('recovered');
		$this->db->where('kodenegara', $kodenegara);
		$this->db->where('tanggal', '2020-06-20');
		$query = $this->db->get('datagrafik')->row();
		return $query->recovered;
	}



	function minrecovered($kodenegara){
		$this->db->select('recovered');
		$this->db->where('kodenegara', $kodenegara);
		$this->db->where('tanggal', '2020-01-22');
		$query = $this->db->get('datagrafik')->row();
		return $query->recovered;
	}

	function datarecoveredtaggal21($kodenegara){
		$this->db->select('recovered');
		$this->db->where('kodenegara', $kodenegara);
		$this->db->where('tanggal', '2020-06-22');
		$query = $this->db->get('datagrafik')->row();
		return $query->recovered;
	}

	function maxconfirmed(){
		$this->db->select_max('confirmed');
		$query = $this->db->get('datagrafik')->row();
		return $query;
	}

	function namanegara(){
		$this->db->select('namanegara');
		$this->db->from('masterdata');
		$this->db->group_by('namanegara');
		$this->db->order_by('namanegara', 'ASC');
		return $this->db->get();
	}

	function AksiInputForecastExcel($data = array()) 
	{
		$jumlah = count($data);

		if ($jumlah > 0)
		{
			$this->db->insert_batch('datagrafik', $data);
		}
	}

	function AksiInputMaster($data,$table)
	{
		$this->db->insert($table,$data);
	}

	function EditMasterData($where,$table){		
		return $this->db->get_where($table,$where);
	}

	function AksiEditMaster($where,$data,$table){
		$this->db->where($where);
		$this->db->update($table,$data);
	}	

	function AksiHapusMaster($where,$table){
		$this->db->where($where);
		$this->db->delete($table);
	}

// Get nama negara
	function getKodeNegara($namanegara){
		$hsl=$this->db->query("SELECT * FROM datagrafik join masterdata WHERE masterdata.namanegara='$namanegara' and masterdata.kodenegara=datagrafik.kodenegara order by datagrafik.tanggal ASC");
		if($hsl->num_rows()>0){
			foreach ($hsl->result() as $data) {
				$hasil=array(
					'kodenegara' => $data->kodenegara,
					'namanegara' => $data->namanegara,
					'tanggal' => $data->tanggal,
					'kodeunik' => $data->kodenegara.date('Y-m-d',strtotime($data->tanggal."-1 days")).date('d',strtotime($data->tanggal."+1 days")),
					'confirmed' => $data->confirmed,
					'death' => $data->death,
					'recovered' => $data->recovered
				);
			}
		}
		return $hasil;
	}

	function getKodeunik($kodeunik){
		$hsl=$this->db->query("SELECT *,DATE_SUB('tanggal', INTERVAL 1 DAY) FROM datagrafik where kodeunik='$kodeunik'");
		if($hsl->num_rows()>0){
			foreach ($hsl->result() as $data) {
				$hasil=array(
					'kodeunik' => $data->kodeunik,
					'confirmed' => $data->confirmed,
					'death' => $data->death
				);
			}
		}
		return $hasil;
	}


	function GetEditForecast($kodenegara)
	{
		$hsl=$this->db->query("SELECT *,MAX(datagrafik.tanggal) as tanggal FROM masterdata join datagrafik WHERE datagrafik.kodenegara = '$kodenegara' ");
		return $hsl;
	}

	function AksiInputForecast($data,$table){
		$this->db->insert($table,$data);

	}

	function EditForecast($where,$table){		
		return $this->db->get_where($table,$where);
	}

	function AksiEditForecast($where,$data,$table){
		$this->db->where($where);
		$this->db->update($table,$data);
	}

	function yesterdayconfirmed($kodenegara,$yesterday)
	{
		$this->db->SELECT('confirmed');
		$this->db->where('kodenegara', $kodenegara);
		$this->db->where('tanggal', $yesterday);
		return $this->db->get('datagrafik');
	}

	function yesterday($kodeunik)
	{
		return $this->db->query("SELECT *,left('$kodeunik',3) from datagrafik where kodenegara= left('$kodeunik',3) and tanggal = SUBSTRING('$kodeunik',4,10)");
	}

	function countday($kodenegara){
		$this->db->select('kodenegara, COUNT(kodenegara) as countday');
		$this->db->where('kodenegara', $kodenegara);
		$this->db->group_by('kodenegara'); 
		$hasil = $this->db->get('datagrafik')->row();
		return $hasil->countday;
	}
	function counttraining($kodenegara){
		$this->db->select('kodenegara, COUNT(kodenegara) as counttraining');
		$this->db->where('kodenegara', $kodenegara);
		$this->db->where('tanggal <=', '2020-05-21');
		$this->db->group_by('kodenegara'); 
		$hasil = $this->db->get('normalisasi')->row();
		return $hasil->counttraining;
	}
	function counttesting($kodenegara){
		$this->db->select('kodenegara, COUNT(kodenegara) as counttesting');
		$this->db->where('kodenegara', $kodenegara);
		$this->db->where('tanggal >=', '2020-05-22');
		$this->db->group_by('kodenegara'); 
		$hasil = $this->db->get('normalisasi')->row();
		return $hasil->counttesting;
	}

	function Detailnormalisasi($kodenegara){    
		$this->db->select('*');
		$this->db->where('kodenegara', $kodenegara);
		$this->db->order_by('tanggal', 'DESC');
		$query = $this->db->get('normalisasi');
		return $query->result();

	}

	function Detailprocess($kodenegara){    
		$this->db->select('*');
		$this->db->where('kodenegara', $kodenegara);
		$query = $this->db->get('bobotbaru');
		return $query->result();

	}

	function Detailrandombobot($kodenegara){    
		$this->db->select('*');
		$this->db->where('kodenegara', $kodenegara);
		$query = $this->db->get('bobotrandom');
		return $query->result();

	}



}