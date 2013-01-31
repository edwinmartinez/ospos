<?php $this->load->view("mobile/header"); ?>

<script type="text/javascript">

$(document).ready(
function() {
	var data = {};
	var page = 1;
	var allJsonData = {};

	var getPeople = function(groupType,personId){
		 if(typeof(groupType)==='undefined') groupType = 'customers';
		 if(typeof(personId) === 'undefined') personId = false;
		$.ajax({
		
		url: '<?php echo site_url('mobile_customers/customersJson/'); ?>',
		type: 'POST',
		data: 'grouptype='+groupType+'&personId='+personId+'&page='+page,
		success: function(json) {
			//console.log("JSON Data: " + json.peopleData.totalcount);
		},
		error: function(e) {
			//called when there is an error
			//console.log(e.responseText);
		}
	}).done(function(json){
		showPeople(json);
		//allJsonData = json;
		});
	};
	

	var showPeople = function( json ) {
		data = json.peopleData;
		console.log(data);
		var template = $('#customersTable').html();
		var html = Mustache.to_html(template, data);
		$('#table_holder').html(html);
		$('.editLink').on("click", editPerson);
	}
	
	var editPerson = function(e) {
		console.log(e);
		var person_id = $(e.currentTarget).attr('id').substr(5);
		var data = {};
		data.person_id = person_id;
		$('#row_'+person_id).css("display","none");
		var template = $('#customerDetails').html();
		var html = Mustache.to_html(template, data);
		$('#row_'+person_id).after(html);
		$('#personDetail_'+person_id).trigger("create");
		console.log(person_id);
	}
	getPeople();
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

<div id="table_holder"></div>

<div id="feedback_bar"></div>


<script id="customersTable" type="text/template">
	<table data-role="table" id="customers-table" data-mode="reflow" class="table-stroke table-stripe">
	<thead><tr>
		<td><?php echo $this->lang->line('common_first_name'); ?></td>
		<td><?php echo $this->lang->line('common_last_name'); ?></td>
		<td><?php echo $this->lang->line('common_email'); ?></td>
		<td><?php echo $this->lang->line('common_phone_number'); ?></td>
		<td>&nbsp;</td>
		</tr>
		</thead>
	{{#people}}<tr id="row_{{person_id}}">
		<td width="20%">{{first_name}}</td><td width="20%">{{last_name}}</td>
		<td width="30%">{{email}}</td><td width="20%">{{phone_number}}</td>
		<td><a href="#" id="edit_{{person_id}}" data-role="button" data-icon="arrow-d"  data-mini="true" data-corners="true" data-shadow="true" data-iconshadow="true" data-wrapperels="span" data-theme="b" class="editLink ui-btn ui-shadow ui-btn-corner-all ui-btn-icon-left ui-btn-up-b"><span class="ui-btn-inner ui-btn-corner-all"><span class="ui-btn-text"><?php echo $this->lang->line('common_edit'); ?></span><span  class="ui-icon ui-icon-arrow-d ui-icon-shadow"/></span></a></td>
		</tr>
	{{/people}} 
	</table>
</script>

<script id="customerDetails" type="text/template">
<tr id="personDetail_{{person_id}}"><td colspan="5">
<form>
	<div class="ui-body ui-body-b">
		<!--<fieldset class="ui-grid-a">-->
		<div data-role="fieldcontain" class="ui-field-contain ui-body ui-br" >
			<label for="first_name"><?php echo $this->lang->line('common_first_name'); ?></label>
			<input id="first_name" type="text" value="{{first_name}}">
		</div> 
		<div data-role="fieldcontain" class="ui-field-contain ui-body ui-br">
			<label for="last_name"><?php echo $this->lang->line('common_last_name'); ?></label>
			<input id="last_name" type="text" value="{{last_name}}">
		</div>
		<div  data-role="fieldcontain" class="ui-field-contain ui-body ui-br">
			<label for="email"><?php echo $this->lang->line('common_email'); ?></label>
			<input id="email" type="text" value="{{email}}">
		</div>
		<div  data-role="fieldcontain" class="ui-field-contain ui-body ui-br">
			<label for="phone_number"><?php echo $this->lang->line('common_phone_number'); ?></label>
			<input id="phone_number" type="text" value="{{phone_number}}">
		</div>
		
		<div data-role="fieldcontain" class="ui-field-contain ui-body ui-br" >
			<label for="address_1" class="ui-input-text"><?php echo $this->lang->line('common_address_1'); ?></label>
			<input id="adress_1" type="text" value="{{address_1}}">
		</div> 
		
		<div data-role="fieldcontain" class="ui-field-contain ui-body ui-br">
			<label for="textarea">Textarea:</label>
			<textarea name="textarea" id="textarea"></textarea>
		</div>
		<!--</fieldset>-->
	</div>
</form>
</td></tr>
</script>


<?php $this->load->view("mobile/footer"); ?>