$(document).on('click',"#botao",function()
			{
				var senha1 = $("#senha1").val();
				var senha2 = $("#senha2").val();
				var data = {nome:$("#nome").val(),email:$("#email").val(),senha:$("#senha2").val()};
				console.log(data);
				console.log(data['nome']);
				console.log(data['email']);
				console.log(data['senha']);
				if (senha1 == senha2)
				{
					if (data['nome'].length > 0 && data['email'].length > 0 && data['senha'].length > 0)
					{
						$.post("cadastrar.php", data, post_done, "json").fail(post_fail);
						$("#nome").val("");
						$("#email").val("");
						$("#senha1").val("");
						$("#senha2").val("");
					}
					else
		   				alert("Preencha os campos corretamente.");
						$("#senha1").val("");
						$("#senha2").val("");
				}
				else
	   				alert("As senhas digitadas não coincidem.");
					$("#senha1").val("");
					$("#senha2").val("");
				
			});
					
			function post_done(data)
			{
			    console.log(data);
			    alert(data);
			}

			function post_fail(data)
			{
				console.log(data);
			 	alert("Error: " + data);
			}