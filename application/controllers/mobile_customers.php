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
        $data['manage_table']=$this->get_people_manage_table($this->Customer->get_all($config['per_page'], $this->input->get('per_page')),$this);
        $this->load->view("mobile/customers",$data);
    }
    
	
	public function customersJson($timestamp='')
	{
		
		$config['base_url'] = site_url('?c=mobile_customers&m=index');
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
									'address_1' => character_limiter($person->address_1,20) ,
									'address_2' => character_limiter($person->address_2,20),
									'city' => character_limiter($person->city,20),
									'state' => character_limiter($person->state,20),
									'zip' => character_limiter($person->zip,14),
									'country' => character_limiter($person->country,20)
									); 
        }
        

		$data['json'] = '{"peopleData":{"totalcount":'.$people->num_rows().',"people":'.json_encode($peopleArray).'}}';
		//$data['json'] =json_encode($peopleArray);
        $this->load->view('json_view', $data);
        //echo $data['json'];

	}
 
   
    /*
Gets the html table to manage people.
*/
function get_people_manage_table($people,$controller)
{
    $CI =& get_instance();
    $table='<table data-role="table" id="customers-table" data-mode="reflow" class="table-stroke table-stripe">';
    
   // $headers = array(/*'<input type="checkbox" id="select_all" class="custom" data-mini="true" /><label for="select_all"></label>', */
    $headers = array(
    $CI->lang->line('common_last_name'),
    $CI->lang->line('common_first_name'),
    $CI->lang->line('common_email'),
    $CI->lang->line('common_phone_number'),
    '&nbsp');
    
    $table.='<thead><tr>';
    foreach($headers as $header)
    {
        $table.="<th>$header</th>";
    }
    $table.='</tr></thead><tbody>';
    $table.=$this->get_people_manage_table_data_rows($people,$controller);
    $table.='</tbody></table>';
    return $table;
}

/*
Gets the html data rows for the people.
*/
    function get_people_manage_table_data_rows($people,$controller)
    {
        $CI =& get_instance();
        $this->table_data_rows='';
        
        foreach($people->result() as $person)
        {
           // $this->table_data_rows.=parent::parent::get_person_data_row($person,$controller);
            
        }
        
        if($people->num_rows()==0)
        {
            $this->table_data_rows.="<tr><td colspan='6'><div class='warning_message' style='padding:7px;'>".$CI->lang->line('common_no_persons_to_display')."</div></tr></tr>";
        }
        
        return $this->table_data_rows;
    }
    

}


?>