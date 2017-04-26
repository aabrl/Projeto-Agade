<?php include_once("header.php"); ?>

	<script>
		$(document).ready(function()
		{
			$.post("collections_data.php", null, collections_success, "json").error(collections_error);
		});
		
		function sort_by_name(a, b)
		{
			if (a.name < b.name)
				return -1;
			if (a.name > b.name)
				return 1;
			return 0;
		}
		
		function collections_success(r)
		{
			// collections
			var collections = r['collections'];
			collections.sort(sort_by_name);
			var collections_hash = {};
			for (i in collections)
			{
				collections_hash[collections[i].id_collection] = i;
				collections[i].topics = new Array;
			}
			
			// topics
			var topics = r['topics'];
			for (var j in topics)
			{
				var i = collections_hash[topics[j].id_collection];
				collections[i].topics.push(topics[j]);
			}
			
			var topics_hash = {};
			for (var i in collections)
			{
				collections[i].topics.sort(sort_by_name);
				for (var j in collections[i].topics)
				{
					topics_hash[collections[i].topics[j].id_topic] = {i, j};
					collections[i].topics[j].subtopics = new Array;
				}
			}

			// subtopics
			var subtopics = r['subtopics'];
			for (var k in subtopics)
			{
				var x = topics_hash[subtopics[k].id_topic];
				var i = x.i;
				var j = x.j;
				collections[i].topics[j].subtopics.push(subtopics[k]);
			}
			for (var i in collections)
				for (var j in collections[i].topics)
					collections[i].topics[j].subtopics.sort(sort_by_name);
			
			// fill the select control at the slideshow
			var o = "<option></option>";
			for (var i in collections)
				o += '<option>' + collections[i].name + '</option>';
			$('#collections_select').html(o);
			
			// build collections presentation
			var s = '';
			for (var i in collections)
			{
				var c = collections[i];
				s += "<a name='" + c.name + "'></a>";
				s += "<div class='title'>" + c.name + "</div>";
				s += "<div class='description'>" + c.description + "</div>";
				s += "<div class='topics'>";
				
				// count and create the container of each collection
				var rows = 0;
				for (var j in c.topics)
					rows += 2 + Object.keys(c.topics[j]).length;

				// organize the collections in sections
				var max_height = Math.floor(rows / 4);
				var height = 0;
				var column = 1;
				var f = "";
				
				for (var j in c.topics)
				{		
					if (max_height > height)
					{
						f += "<div class='header'>" + c.topics[j].name + "</div>";
						for (var k in c.topics[j].subtopics)
							f += "<a href=''>" + c.topics[j].subtopics[k].name + "</a>";
						height += Object.keys(c.topics[j]).length + 2;
					}
					
					if (max_height <= height)
					{
						s += "<div class='section'>" + f + "</div>";				
						rows -= height;
						max_height = Math.floor(rows / (4 - column));
						height = 0;
						f = "";
						column++;
					}
				}
				
				s += "</div>";
			}
			
			$('.section.collection').html(s);
		}
		
		function collections_error(r)
		{
			console.log('collections_error', r);
		}
		
		function collections_change()
		{
			var anchor = document.getElementById("collections_select").value;
			console.log(anchor);
			window.location.href = "#" + anchor;
		}
	</script>

	<!-- SLIDESHOW -->
	<style>
		@keyframes animatedBackground {
			0% { background-position: 0px 0px; }
			100% { background-position: 200px -25px; }
		}
	</style>
	<div class='section slideshow' style='background-color: none; background-image: linear-gradient(to top, rgba(0,0,0,0.25), rgba(0,0,0,0.0)), url("images/panel_of_stamps.jpg"); background-size: auto 575px; animation: animatedBackground 3s linear 1 forwards;'>
	<div class='section middle transparent-windows'>
	
		<table cellpadding='0' cellspacing='0' style='position: relative; z-index: 1;'><tr><td>
			<div class='title'>Collections</div>
			<div class='description'>
				Featuring our philatelic collection with over 6.500 brazilian stamps.<br>
				Discover objects by browsing our collections organized by topics:<br>
				<select id='collections_select' onchange='collections_change()'></div>	
			<div class='description'></select>
			</div>
		</td></tr></table>
		<div style='background-image: linear-gradient(to bottom, rgba(0,0,0,0.6), rgba(0,0,0,0.6)); z-index: 0; position: absolute; top: 190px; width: 220px; height: 70px; margin: 0px 390px; -webkit-filter: blur(30px); -moz-filter: blur(30px); -o-filter: blur(30px); -ms-filter: blur(30px); filter: blur(30px);'></div>
		<div style='background-image: linear-gradient(to bottom, rgba(0,0,0,0.4), rgba(0,0,0,0.4)); z-index: 0; position: absolute; top: 270px; width: 640px; height: 80px; margin: 0px 180px; -webkit-filter: blur(30px); -moz-filter: blur(30px); -o-filter: blur(30px); -ms-filter: blur(30px); filter: blur(30px);'></div>

	</div>
	</div>

	<!-- CONTENT -->
	<div class='section content' style='background-color: #fff; padding-top: 20px;'>
	<div class='section middle collection silver'>

		<!--		
		<a name='stamps'></a>
		<div class='title'>Philately</div>
		<div class='description'>Collection of stamps, letters and mails curated by Diego Salcedo.</div>
		<div class='topics'>
			<div class='section'>
				<div class='header'>Commemorative stamps</div>
				<a href=''>Carnival</a>
				<a href=''>Institutions</a><br>
				<div class='header'>Rare stamps</div>
				<a href=''>Olho de Boi</a>
			</div>
			<div class='section'>
				<div class='header'>World wide stamps</div>
				<a href=''>Argentina</a>
				<a href=''>Brazil</a>
				<a href=''>England</a>
				<a href=''>Japan</a>
				<a href=''>Spain</a>
				<a href=''>United States</a>
			</div>
			<div class='section'>
				<div class='header'>Historical letters</div>
				<a href=''>Charles Darwin</a>
				<a href=''>Joaquim Nabuco</a>
				<a href=''>Pedro Cabral</a>
			</div>
		</div>
		
		<a name='products'></a>
		<div class='title'>Products</div>
		<div class='description'>Collection of products made companies and reviewed by consumers around the world.</div>
		<div class='topics'>
			<div class='section'>
				<div class='header'>Consumer products</div>
				<a href=''>Television</a>
				<a href=''>Radio</a>
				<a href=''>Computer</a>
				<a href=''>Car</a>
				<a href=''>Bike</a>
				<a href=''>Software</a>
			</div>
			<div class='section'>
				<div class='header'>Commercial products</div>
				<a href=''>Computer stations</a>
				<a href=''>Software</a>
			</div>
			<div class='section'>
				<div class='header'>Industrial products</div>
				<a href=''>Gas stations</a>
				<a href=''>Fuel</a>
				<a href=''>Software</a>
			</div>
		</div>	
	
		<a name='thesis'></a>
		<div class='title'>Thesis and Dissertations</div>
		<div class='description'>Collection of thesis and dissertations moderated by Bruno Ávila and reviewed by researchers around the world.</div>
		<div class='topics'>
			<div class='section'>
				<div class='header'>Computer Science</div>
				<a href=''>Algorithms and data structures</a>
				<a href=''>Artificial inteligence</a>
				<a href=''>Bioinformatics</a>
				<a href=''>Computational complexity</a>
				<a href=''>Databases</a>
				<a href=''>Discrete Mathematics</a>
				<a href=''>Formal language and Automata</a>
				<a href=''>Human-computer interations</a>
				<a href=''>Logic in Computer Science</a>
				<a href=''>Networks</a>
				<a href=''>Operating systems</a>
				<a href=''>Programming languages</a>
				<a href=''>Quantum computing</a>
				<a href=''>Robotics</a>
				<a href=''>Software engineering</a>
			</div>
			<div class='section'>
				<div class='header'>Economics</div>
				<a href=''>Game theory</a>
				<a href=''>Accounting</a><br>
				<div class='header'>Information Science</div>
				<a href=''>Bibliometric</a>
				<a href=''>Digital libraries</a>
				<a href=''>Digital media</a>
				<a href=''>Information retrieval</a>
				<a href=''>Information Theory</a>
				<a href=''>Information management</a>
				<a href=''>Information processing</a>
				<a href=''>Specialized databases</a>
				<a href=''>Quantum information</a>
			</div>
			<div class='section'>
				<div class='header'>Mathematics</div>
				<a href=''>Algebraic Geometry</a>
				<a href=''>Algebraic Topology</a>
				<a href=''>Analysis of PDEs</a>
				<a href=''>Category Theory</a>
				<a href=''>Classical Analysis and ODEs</a>
				<a href=''>Combinatorics</a>
				<a href=''>Commutative Algebra</a>
				<a href=''>Complex Variables</a>
				<a href=''>Differential Geometry</a>
				<a href=''>Dynamical Systems</a>
				<a href=''>Functional Analysis</a>
				<a href=''>General Mathematics</a>
				<a href=''>General Topology</a>
				<a href=''>Group Theory</a>
				<a href=''>History and Overview</a>
				<a href=''>Information Theory</a>
				<a href=''>K-Theory and Homology</a>
				<a href=''>Logic</a>
				<a href=''>Mathematical Physics</a>
				<a href=''>Metric Geometry</a>
				<a href=''>Number Theory</a>
				<a href=''>Numerical Analysis</a>
				<a href=''>Operator Algebras</a>
				<a href=''>Optimization and Control</a>
				<a href=''>Probability</a>
				<a href=''>Quantum Algebra</a>
				<a href=''>Representation Theory</a>
				<a href=''>Rings and Algebras</a>
				<a href=''>Spectral Theory</a>
				<a href=''>Statistics Theory</a>
				<a href=''>Symplectic Geometry</a>
			</div>
			<div class='section'>
				<div class='header'>Medicine</div>
				<a href=''>Anatomy</a>
				<a href=''>Biology</a><br>
				<div class='header'>Web Science</div>
				<a href=''>Search Engines</a>
				<a href=''>Webgraph</a>
			</div>
		</div>
		-->
		
	</div>
	</div>
	
<?php include_once("footer.php"); ?>