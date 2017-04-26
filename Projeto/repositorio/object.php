<?php include_once("header.php"); ?>

	<script>
		$(document).ready(function()
		{
			object_post();
		});
		
		function sort_by_deposited_date_time(a, b)
		{
			if (a.deposited_date_time < b.deposited_date_time)
				return 1;
			if (a.deposited_date_time > b.deposited_date_time)
				return -1;
			return 0;
		}
		
		function object_post()
		{
			// get agade id and normalize it
			var id = getUrlParameter("id").toString();
			if (id.indexOf(".") == 4)
			{
				// remove version reference, if exists
				if (id.indexOf(".", 5) == 11)
					id = id.substring(0, 11);
				$.post("object_data.php", {id : id}, object_success, "json").error(object_error);
			}
		}
		
		function object_success(r)
		{
			console.log('object_success', r);
			var s;
			
			// slideshow
			$(".object-windows .title").html(r['title']);
			$(".object-windows .subtopic").html(r['subtopic']);
			$(".object-windows .authors").html(r['authors']);
			$(".object-windows img").attr("src", "media/" + r['image']);
			
			// abstract
			$(".object .abstract").html(r['abstract']);
			
			// keywords
			s = "";
			var keywords = r['keywords'].split(",");
			for (var keyword in keywords)
				s += "<div class='keyword'>" + keywords[keyword].trim() + "</div>";
			$(".object .keywords .words").html(s);
			
			// metadata and rights
			s = "";
			var metadata = r['metadata'];
			for (var item in metadata)
				s += "<div class='item'><div class='key'>" + item + "</div><div class='value'>" + metadata[item] + "</div></div>";
			var rights = r['rights'];
			if (rights)
				s += "<div class='item'><div class='key'>Rights</div><div class='value'>" + rights + "</div></div>";
			$(".object .metadata").html(s);
			
			// versions
			var id = r['agadeid'];
			var versions = r['versions'];
			versions.sort(sort_by_deposited_date_time);
			s = "<table cellpadding=0 cellspacing=0 border=0><tr><th>Version Identifier</th><th>Deposited in</th><th>Published in</th><th>Author's Comments</th></tr>";
			for (var version in versions)
			{
				s += "<tr class='version'>";
				s += "<td class='item'><a href='media/" + versions[version].media + "' target='_blank'>" + id + "." + (versions.length - parseInt(version,10)) + "</a></td>";
				s += "<td class='item'>" + versions[version].deposited_date_time.toString().substring(0, 10) + "</td>";
				s += "<td class='item'>" + versions[version].published_date_time.toString().substring(0, 10) + "</td>";
				s += "<td class='item'>" + versions[version].comments + "</td>";
				s == "</tr>";
			}
			s += "</table>";
			$(".object .versions").html(s);
			
			// publication date
			var published_date_time = new Date(Date.parse(versions[versions.length - 1].published_date_time));
			var month = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
			s = month[published_date_time.getMonth()] + " " + published_date_time.getFullYear().toString();
			$(".object-windows .publication-date").html(s);
			
			// quality and reviews
			var quantities = r['quantities'];
			var qualities  = r['qualities'];
			var s1 = "";
			var s2 = "";
			for (var quantity in quantities)
				if (quantity == "Views" || quantity == "Saved")
					s2 += "<div class='quantity more'><div class='key'>" + quantity + "</div><div>" + quantities[quantity] + "</div></div>";
				else
				if (quantity == "Reviews")
				{
					s1 += "<a class='quantity' href='javascript:toggle(\"" + quantity + "\")'><div class='key'>" + quantity + "</div><div>" + quantities[quantity] + "</div></a>";
					for (var quality in qualities)
						s1 += "<div class='quality'><div class='key'>" + quality + "</div><div class='sign " + qualities[quality] + "'></div></div>";
					s1 += "<div class='separator'></div>";
				}
				else
					s2 += "<a class='quantity' href='javascript:toggle(\"" + quantity + "\")'><div class='key'>" + quantity + "</div><div>" + quantities[quantity] + "</div></a>";

			s1 += "<a href='media/" + versions[0].media + "' class='action' target='_blank'>Read</a>";
			$(".object .indicators.head").html(s1);
			$(".object .indicators.bottom").html(s2);
			
			// agade id
			$(".footer .agade-id").html("Adagê Object Identifier: " + id);
		}
		
		function object_error(r)
		{
			console.log('object_error', r);
			$(".object .abstract").html(r.responseText);
			
		}
		
		function toggle(v)
		{
			var e = "." + v.toString().toLowerCase();
			$(e).toggle();
		}
	</script>

	<!-- SLIDESHOW -->
	<div class='section slideshow' style='background-color: #333; padding: 90px 0px 40px 0px;'>
	<div class='section middle object-windows'>
	
		<table border=0 width='100%' height='100%' cellpadding='0' cellspacing='0'><tr>
		<td width='60%'>
			<div class='title'></div>
			<div class='description subtopic'></div>
			<div class='description authors'></div>
			<div class='description publication-date'></div>
		</td>
		<td width='40%'><img src='' style='max-height: 300px'></td>
		</tr></table>
		
	</div>
	</div>

	<!-- CONTENT -->
	<div class='section content' style='background-color: #fff; padding: 60px 0px;'>
	<div class='section middle object'>
		<div class='indicators head'></div>
		<div class='reviews'></div>
		<div class='abstract'></div>
		<div class='keywords'><div class='key'>Keywords</div><div class='words'></div></div>
		<div class='metadata'></div>
		<div class='indicators bottom'></div>
		<div class='versions'></div>
	</div>
	</div>
	
	<!-- FOOTER -->
	<div class='section footer'>
	<div class='section middle'>
		<div class='agade-id'></div>
		<div class='copyright'>&copy; 2016 Agadê</div>
	</div>
	</div>
	
</body>
</html>