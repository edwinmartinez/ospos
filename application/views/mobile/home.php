<?php $this->load->view("mobile/header"); ?>



<?php echo $this->lang->line('common_welcome_message'); ?>
<!--<div id="home_module_list">-->
    <ul data-role="listview" data-inset="true" data-filter="false">
	<?php
	foreach($allowed_modules->result() as $module) {
	?>
	<li><a href="<?php echo site_url("mobile_"."$module->module_id");?>"><?php echo $this->lang->line("module_".$module->module_id) ?></a></li>
		
	<?php
	}
	?>
	</ul>
<!--</div>-->
<?php $this->load->view("mobile/footer"); ?>