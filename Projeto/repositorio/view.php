<?php include_once("header.php"); ?>

	<div class='section slideshow' style='background-color: rgb(36,66,66); padding: 90px 0px 50px 0px;'>
	<div class='section middle solid-windows'>
	
		<div class='title'>webgraph information</div>
		<div class='description' style='margin-bottom: 40px'>Returned 55 objects</div>
		
		<select>
			<option>Collections</option>
			<option>Articles</option>
			<option>Philately</option>
			<option>Products</option>
			<option>Thesis and Dissertations</option>
		</select>
	
		<select>
			<option>Topics</option>
			<optgroup label='Computer Science'>
			<option>Information Retrieval</option>
			<option>Information Processing</option>
			<option>Information Theory</option>
			</optgroup>
			<optgroup label='Information Science'>
			<option>Information Retrieval</option>
			<option>Information Processing</option>
			<option>Information Theory</option>
			</optgroup>
			<optgroup label='Mathematics'>
			<option>Information Retrieval</option>
			<option>Information Processing</option>
			<option>Information Theory</option>
			</optgroup>
		</select>

		<input type='text' value='Publication date'>
		
	</div>
	</div>
	
	<!-- CONTENT -->
	<script>
		$(document).ready(function()
		{
			$.post("view_data.php", null, view_success, "json").error(view_error);
		});
		
		function view_success(r)
		{
			show_objects(r['objects']);
		}
		
		function view_error(r)
		{
			console.log('view_error', r);
		}
	</script>
	<div class='section content' style='background-color: #eee'>
	<div class='section middle view-container'>
	</div>
	</div>
		

<?php include_once("footer.php"); ?>