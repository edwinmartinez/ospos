<?php $this->load->view("mobile/header"); ?>
<div data-role="page" data-theme="c" id="peopleList">
	<header data-role="header" data-position="inline">
		<h1><?php echo $this->config->item('company'); ?></h1>
	</header>

<article data-role="content">
<?php echo $this->lang->line('common_welcome_message'); ?>

    <ul data-role="listview" data-inset="true" data-filter="false">
	<?php
	foreach($allowed_modules->result() as $module) {
	?>
	<li><a href="<?php echo site_url("mobile_"."$module->module_id");?>"><?php echo $this->lang->line("module_".$module->module_id) ?></a></li>
		
	<?php
	}
	?>
	</ul>
</article>

</div>
<?php $this->load->view("mobile/footer"); ?>