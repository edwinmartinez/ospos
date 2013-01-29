<?php $this->load->view("mobile/header"); ?>

<script type="text/javascript">

$(document).ready(
function() {
	var data = {};
	$.getJSON("<?php echo site_url('mobile_customers/customersJson'); ?>", function(json) {
   		console.log("JSON Data: " + json.customersData.customercount);
   		data = json.customersData;
   		console.log(data);
   		var template = $('#customersTable').html();
		var html = Mustache.to_html(template, data);
		$('#table_holder').html(html);
 	});

}

);
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

<script id="customersTable" type="text/template">
	<table data-role="table" id="customers-table" data-mode="reflow" class="table-stroke table-stripe">
	{{#customers}}<tr><td>{{first_name}}</td><td>{{last_name}}</td><td>{{email}}</td><td>{{phone_number}}</td><td><?php echo $this->lang->line('common_edit'); ?></td></tr>{{/customers}}
	</table>
</script>

<!--
var template = "Employees:<ul>{{#employees}}" +
                            "<li>{{firstName}} {{lastName}}</li>" +
                            "{{/employees}}</ul>";
                        -->

<script id="personTpl" type="text/template">
<h1>{{firstName}} {{lastName}}</h1>
<p>Blog URL: <a href="{{blogURL}}">{{blogURL}}</a></p>
</script>



<?php $this->load->view("mobile/footer"); ?>