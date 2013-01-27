<?php
require_once ("home.php");
class Mobile_home extends Home 
{
	function __construct() {
		parent::__construct();	
	}
	

    function index() 
    {
        $this->load->view("mobile/home");
    }
    

}


?>