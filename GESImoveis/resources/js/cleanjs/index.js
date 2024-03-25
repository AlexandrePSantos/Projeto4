$("#login").submit(function() {
				var msg_invalido = "Username e Password são obrigatórios";
				var msg_password = "Dados errados";
				var msg_success = "Login efectuado com sucesso!";
				var valid = $("#login").valid();
				if (valid == false) {
					$.scojs_message(msg_invalido, $.scojs_message.TYPE_ERROR);
				} else {

					$.ajax({
						type : 'POST',
						url : 'server/login.php',
						dataType : 'json',
						data : {
							username : $("#username").val(),
							password : $("#password").val()

						}
					}).done(function(resposta) {
						if (resposta.errors == false) {
							if (resposta.tipoutilizador == 1) {
								setTimeout(window.location.href = 'dashboard.php', 500);
								$.scojs_message(msg_success, $.scojs_message.TYPE_OK);
							}else{
								setTimeout(window.location.href = 'inputs.php', 500);
								$.scojs_message(msg_success, $.scojs_message.TYPE_OK);
							}

						} else {

							$.scojs_message(msg_password, $.scojs_message.TYPE_ERROR);

						}
					});
					return false;
				}
			});

			$("#login").validate({

				rules : {
					username : {
						required : true
					},
					password : {
						required : true
					}
				},
				messages : {
					username : {
						required : "Username é obrigatório"
					},
					password : {
						required : "Password é obrigatório"
					}

				}
			});