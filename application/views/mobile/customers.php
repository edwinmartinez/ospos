<?php $this->load->view("mobile/header"); ?>

<script type="text/javascript">

$(document).ready(
	function() {
	var peopleData = {};
	var page = 1;
	//var allJsonPeopleData = {};

	var getPeople = function(groupType,personId){
		 if(typeof(groupType)==='undefined') groupType = 'customers';
		 if(typeof(personId) === 'undefined') personId = -1;
		$.ajax({
		
		url: '<?php echo site_url('mobile_customers/customersJson/'); ?>',
		type: 'POST',
		data: 'grouptype='+groupType+'&personId='+personId+'&page='+page,
		error: function(e) {
			//called when there is an error
			console.log(e.responseText);
		}
	}).done(function(json){
		peopleData = json.peopleData;	
		showPeople(json);
		});
	};
	
	var getCustomer = function(personId){
		 if(typeof(groupType)==='undefined') groupType = 'customers';
		 if(typeof(personId) === 'undefined') personId = -1;
		var personData;
		$.ajax({
		
		url: '<?php echo site_url('mobile_customers/customerJson/'); ?>/'+personId,
		type: 'POST',
		//data: 'person_id='+personId,
		error: function(e) {
			console.log(e.responseText);
		}
		}).done(function(json){
			personData = json.person;
			console.log(personData);
			personData.taxable = personData.taxable == 1?true:false;
			var template = $('#personDetail_template').html();
			var html = Mustache.to_html(template, personData);
			$('#personDetail_holder').html(html);
			$('#personDetail_holder').trigger("create");
		});
		
	};
	
	var showPeople = function( json ) {
		
		console.log(peopleData);
		var template = $('#peopleList_template').html();
		var html = Mustache.to_html(template, peopleData);
		$('#list_holder').html(html);
		$('#list_holder').trigger("create");
		$('.personRow').on("click", editPerson);
	}

	var editPerson = function(e) {
		
		//console.log($(this).attr('class'));
		//console.log($(this).find('a').attr('id'));
	
		var data ={};
		var personJson;
		// get the id of the clicked person
		var person_id = $(this).find('a').attr('id');
		personJson = getCustomer(person_id);
		//console.log(personJson);
		//data = personJson;
		//var template = $('#personDetail_template').html();
		//var html = Mustache.to_html(template, data);
		//$('#personDetail_holder').html(html);
		//$('#personDetail_holder').trigger("create");
	}
	getPeople();
}

);
</script>

<div data-role="page" data-theme="c" id="peopleList">
	<header data-role="header" data-position="inline">
		<h1><?php echo $this->config->item('company'); ?></h1>
	</header>

	<article data-role="content" data-theme="b">
		<h1><?php echo $this->lang->line('common_list_of').' '.$this->lang->line('module_customers'); ?></h1>

		<!--<div id="table_action_header">
				<?php echo form_open("$controller_name/search",array('id'=>'search_form')); ?>
					<input  type="search" name ='search' id='search' data-clear-btn="true" placeholder="Search" />
				</form>
		</div>-->

		<div id="list_holder"></div>

		<div id="feedback_bar"></div>
	</article>
</div> <!-- end of page -->

<div data-role="page" id="personView">
	<header data-role="header" data-position="fixed">
		<h1><?php echo $this->config->item('company'); ?></h1>
		<a data-icon="grid" href="#peopleList"><?php echo $this->lang->line('module_customers'); ?></a>
	</header>
	
	<article data-role="content" id="personDetail_holder"></article>
	
<?php 
/*$CI =& get_instance();
var_dump($CI->lang);*/
?>
</div> <!-- end of page -->
	
<script id="peopleList_template" type="text/template">

	<ul id="peopleList" data-role="listview" data-inset="true" data-filter="true">	
	{{#people}}
	<li id="row_{{person_id}}" class="personRow">
		<a href="#personView" id="{{person_id}}"><h1>{{first_name}} {{last_name}}</h1>
		<p>{{#email}}{{email}}<br />{{/email}} {{phone_number}}</p>
		</a>
		</li>
	{{/people}} 
	</ul>

</script>

<script id="personDetail_template" type="text/template">

<form>
	<div class="ui-body ui-body-b">
		
		<input type="hidden" name="person_id" value="{{person_id}}" />
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
			<input id="address_1" type="text" value="{{address_1}}">
		</div>
		<div data-role="fieldcontain" class="ui-field-contain ui-body ui-br" >
			<label for="address_2" class="ui-input-text"><?php echo $this->lang->line('common_address_2'); ?></label>
			<input id="address_2" type="text" value="{{address_2}}">
		</div>
		<div data-role="fieldcontain" class="ui-field-contain ui-body ui-br" >
			<label for="city" class="ui-input-text"><?php echo $this->lang->line('common_city'); ?></label>
			<input id="city" type="text" value="{{city}}">
		</div>
		<div data-role="fieldcontain" class="ui-field-contain ui-body ui-br" >
			<label for="state" class="ui-input-text"><?php echo $this->lang->line('common_state'); ?></label>
			<input name="state" id="state" type="text" value="{{state}}">
		</div>
		<div data-role="fieldcontain" class="ui-field-contain ui-body ui-br" >
			<label for="country" class="ui-input-text"><?php echo $this->lang->line('common_country'); ?></label>
			<input name="country" id="country" type="text" value="{{country}}">
		</div>
		
		<div data-role="fieldcontain" class="ui-field-contain ui-body ui-br" >
		<label for"account_number" class="ui-input-text"><?php echo $this->lang->line('customers_account_number'); ?></label>
		<input name="account_number" id="account_number" type="text" value="{{account_number}}">
			<?php /* echo form_input(array(
		'name'=>'account_number',
		'id'=>'account_number',
		'value'=>$person_info->account_number)
		); */ ?>
		</div>
		
		<div data-role="fieldcontain" class="ui-field-contain ui-body ui-br" >		
		<label for="taxable"  class="ui-input-text"><?php echo $this->lang->line('customers_taxable'); ?></label>
			<select name="taxable" id="taxable" data-role="slider">
			{{#taxable}}
				<option value="0"><?php echo $this->lang->line('common_no'); ?></option>
				<option value="1" selecte><?php echo $this->lang->line('common_yes'); ?></option>
			{{/taxable}}
			{{^taxable}}
				<option value="0" selected><?php echo $this->lang->line('common_no'); ?></option>
				<option value="1"><?php echo $this->lang->line('common_yes'); ?></option>
			{{/taxable}}
			</select>
			<?php //echo form_checkbox('taxable', '1', $person_info->taxable == '' ? TRUE : (boolean)$person_info->taxable);?>
		</div>
	
		<div data-role="fieldcontain" class="ui-field-contain ui-body ui-br">
			<label for="textarea" class="ui-input-text"><?php echo $this->lang->line('common_comments'); ?></label>
			<textarea name="textarea" id="comments">{{comments}}</textarea>
		</div>
		
		<div>
			<div><a href="#" data-icon="delete" data-role="button" data-theme="a"><?php echo $this->lang->line("common_delete")." ".$this->lang->line("customers_customer");?></a></div>
			<fieldset class="ui-grid-a">
				<div class="ui-block-a"><a href="#peopleList" data-icon="back" data-role="button" data-theme="a"><?php echo $this->lang->line("common_cancel");?></a></div>
				<div class="ui-block-c"><a data-icon="check" href="#" data-role="button"data-theme="a"><?php echo $this->lang->line("common_save");?></a></div>
			</fieldset>
		</div>
	
	</div>
</form>


</script>


<?php $this->load->view("mobile/footer"); ?>