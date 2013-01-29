<?php
require_once ("secure_area.php");
require_once("mobile-detect.php");
class Home extends Secure_area 
{
	function __construct()
	{
		parent::__construct();	
	}
	
	function index()
	{
	$this->detect = new Mobile_Detect();
 
// Check for any mobile device.
		if (!$this->detect->isMobile()) {
			$this->load->view("mobile/home");
		} else {
			$this->load->view("home");
		}
	}
	
	function logout()
	{
		$this->Employee->logout();
	}
}
?>
