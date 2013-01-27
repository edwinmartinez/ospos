<?php $this->load->view("mobile/header"); ?>


<script type="text/javascript">

</script>

<h1><?php echo $this->lang->line('common_list_of').' '.$this->lang->line('module_customers'); ?></h1>
<?php echo $this->pagination->create_links();?>
<div id="table_action_header">

        <?php echo form_open("$controller_name/search",array('id'=>'search_form')); ?>
            <input  type="search" name ='search' id='search' data-clear-btn="true" placeholder="Search" />
        </form>

</div>

<div id="table_holder">
    <?php echo $manage_table; ?>
</div>

<div id="feedback_bar"></div>

<?php $this->load->view("mobile/footer"); ?>