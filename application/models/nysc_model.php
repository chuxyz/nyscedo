<?php
class Nysc_model extends CI_Model
{
	public function __construct()
	{
		$this->load->database();
	}
	public function check_admin($username, $password)
	{
		$this->db->where(array('username'=>$username,'password'=>$password));
		$this->db->from('admin');
		return $this->db->count_all_results();
	}
	public function get_banks($prefix)
	{
		$this->db->select('bankName');
		$this->db->from($prefix.'_banks');
		$this->db->order_by('bankName asc');
		$query = $this->db->get();
		return $query->result();
	}
	public function count_data_statecode($prefix, $statecode)
	{
		$this->db->select('*');
		$this->db->from($prefix.'_corpmember');
		$this->db->where('stateCode',$statecode);
		return $this->db->count_all_results(); 
	}
	public function get_data_statecode($prefix, $statecode)
	{
		$this->db->select('*');
		$this->db->from($prefix.'_corpmember');
		$this->db->where('stateCode',$statecode);
		$query = $this->db->get();
		return $query->result(); 
	}
	public function get_data($prefix)
	{
		$this->db->select('*');
		$this->db->from($prefix.'_corpmember');
		$query = $this->db->get();
		return $query->result(); 
	}
	public function get_branches($prefix,$bank)
	{
		$this->db->select('*');
		$this->db->from($prefix.'_branches');
		$this->db->where('bankName',$bank);
		$query =$this->db->get();
		return $query->result();
	}
	public function double_acct($prefix)
	{
		$this->db->select('acctNumber');
		$this->db->from($prefix.'_corpmember');
		$query = $this->db->get();
		return $query->result();
	}
	public function get_double_acct_data($prefix, $acct)
	{
		$this->db->select('corpName, stateCode, bankName, branchName');
		$query = $this->db->get_where($prefix.'_corpmember',array('acctNumber'=>$acct));
		return $query->result();
		
	}
	public function my_insert($table,$assoc_array)
	{
		$this->db->insert($table,$assoc_array);
	}
	public function update_data($state_code,$table,$array_data)
	{
		$this->db->where('stateCode',$state_code);
		$this->db->update($table,$array_data);
	}
	public function check_month_paid($prefix,$state_code)
	{
		$this->db->select('corpName, stateCode, acctNumber, bankName, branchName, jan, feb, mar, apr, may, jun, jul, aug, sep, oct, nov, dec');
		$query = $this->db->get_where($prefix.'_corpmember',array('stateCode'=>$state_code));
		return $query->result();
	}
	
	public function count_all($prefix)
	{
		$this->db->select();
		$this->db->from($prefix.'_corpmember');
		return $this->db->count_all_results();
	}
	
	public function excel_data_by_month($prefix, $month)
	{
		$this->db->select('corpName, stateCode, acctNumber, bankName, branchName');
		$this->db->order_by('bankName asc, branchName asc, stateCode asc');
		$query = $this->db->get_where($prefix.'_corpmember',array($month => '19,800'));
		return $query->result();	
	}
	
	public function excel_data_all($prefix)
	{
		$this->db->select('*')->from($prefix.'_corpmember')->order_by('bankName asc, branchName asc');
		$query = $this->db->get();
		return $query->result();
	}
	public function get_current_month()
	{
		$this->db->select('currentMonth')->from('settings')->where('id',1);
		$query = $this->db->get();
		return $query->result();
	}
	public function get_all_uncleared($prefix, $month, $bank)
	{
		$where = "bankName = '$bank' AND $month = '' OR bankName = '$bank' AND $month IS NULL";
		$this->db->select('stateCode, bankName, branchName')
		->from($prefix.'_corpmember')
		->where($where)
		->order_by('bankName asc, stateCode asc');
		$query =$this->db->get();
		return $query->result();
	}
	
	public function get_prefix()
	{
		$this->db->select('prefix')->from('settings')->where('id',1);
		$query = $this->db->get();
		return $query->result();
	}
	
	public function set_prefix($prefix)
	{
		$this->db->where('id',1);
		$this->db->update('settings',$prefix);
	}
	
	public function set_last_active()
	{
		$time = array(
		'last_active' => time()
		);
		$this->db->where('username','admin');
		$this->db->update('admin',$time);
	}
	
	public function get_last_active()
	{
		$this->db->select('last_active')
		->from('admin')
		->where('username','admin');
		$query = $this->db->get();
		return $query->result();
	}
	
	public function check_state_code($prefix, $csv_state_code)
	{
		$this->db->select('*')
		->from($prefix.'_corpmember')
		->where('stateCode', trim($csv_state_code));
		$query = $this->db->get();
		return $query->num_rows();
	}
	
	public function get_distinct_banks($prefix)
	{
		$query = $this->db->query('SELECT DISTINCT bankName FROM '.$prefix.'_corpmember');
		return $query->result();
	}
	
	public function get_distinct_bank_branch($prefix)
	{
		$query = $this->db->query('SELECT DISTINCT bankName, branchName FROM '.$prefix.'_corpmember');
		return $query->result();
	}
	
	public function set_banks_table($prefix, $bank_name)
	{
		$this->db->set('bankName', $bank_name);
		$this->db->insert($prefix.'banks'); 
	}
	
	public function set_branches_table($prefix, $bank_name, $branch_name)
	{
		$this->db->set('bankName', $bank_name);
		$this->db->set('branchName', $branch_name);
		$this->db->insert($prefix.'branches'); 
	}
	
}
?>