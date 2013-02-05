<?php
require_once ("customers.php");
class Mobile_customers extends Customers 
{
	function __construct() {
		parent::__construct();	
	}
	

    function index() 
    {
        $config['base_url'] = site_url('?c=mobile_customers&m=index');
        $config['total_rows'] = $this->Customer->count_all();
        $config['per_page'] = '20'; 
        $this->pagination->initialize($config);
        
        $data['controller_name']=strtolower(get_class());
        $data['form_width']=$this->get_form_width();
        $this->load->view("mobile/customers",$data);
    }
    
	
	public function customersJson($timestamp='')
	{
		//$config['base_url'] = site_url('?c=mobile_customers&m=index');
        $config['total_rows'] = $this->Customer->count_all();
        $config['per_page'] = '3'; 
        $this->pagination->initialize($config);
        		
		$CI =& get_instance();
		
        $this->table_data_rows='';
        $people = $this->Customer->get_all();
        foreach($people->result() as $person)
        {
			$peopleArray[] =  array(
									'person_id' => $person->person_id,
									'first_name' => character_limiter($person->first_name,13), 
									'last_name' => character_limiter($person->last_name,13),
									'email' => character_limiter($person->email,30),
									'phone_number' => character_limiter($person->phone_number,20),
									'address_1' => character_limiter($person->address_1,20) /*,
									'address_2' => character_limiter($person->address_2,20),
									'city' => character_limiter($person->city,20),
									'state' => character_limiter($person->state,20),
									'zip' => character_limiter($person->zip,14),
									'country' => character_limiter($person->country,20),
									'comments' => character_limiter($person->comments,200)*/
									); 
        }
        

		$data['json'] = '{"peopleData":{"totalcount":'.$people->num_rows().',"people":'.json_encode($peopleArray).'}}';
        $this->load->view('json_view', $data);

	}
	public function customerJson($customer_id=-1) {
		$data['json'] = '{"person":'.json_encode($this->Customer->get_info($customer_id)).'}';
		$this->load->view('json_view',$data);
	}
	
	function deleteCustomer($customer_id = -1){
		if($customer_id > -1){
			//$this->Customer->delete($customer_id);
			$data['json'] = '{"success":1}';
			$this->load->view('json_view',$data);
		} else {
			$data['json'] = '{"success":0}';
			$this->load->view('json_view',$data);
		}
	}	

}
?>