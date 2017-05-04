<%
	dim fname,city
	fname=Request.Form("name")
	city=Request.Form("city")
	Response.Write("Caro " & fname & ". ")
	Response.Write(& city & " é um lugar massa de se morar visse.")
%>