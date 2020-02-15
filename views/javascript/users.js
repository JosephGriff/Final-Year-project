$(document).on("click", ".btnEditUser", function(){

    var idUser = $(this).attr("idUser");

    var data = new FormData();
    data.append("idUser", idUser);

    $.ajax({

        url: "ajax/users.ajax.php",
        method: "POST",
        data: data,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        
        success: function(answer){
            
            console.log("answer", answer);

            $("#editName").val(answer["name"]);

            $("#EditUser").val(answer["user"]);

            $("#EditProfile").val(answer["profile"]);

            $("#currentPassword").val(answer["password"]);

        }

    });

});

// Activate or Deactivate User

$(document).on("click", ".btnActivate", function(){

	var userId = $(this).attr("userId");
	var userStatus = $(this).attr("userStatus");

	var datum = new FormData();
 	datum.append("activateId", userId);
  	datum.append("activateUser", userStatus);

  	$.ajax({

	  url:"ajax/users.ajax.php",
	  method: "POST",
	  data: datum,
	  cache: false,
      contentType: false,
      processData: false,
      success: function(answer){
      	
      	console.log("answer", answer);

      	if(window.matchMedia("(max-width:767px)").matches){
		
			swal({
				title: "User Status Updated",
				type: "success",
				confirmButtonText: "Close"	
			}).then(function(result) {

				if (result.value) {
					window.location = "users";
				}

			})

		}
		
      }

  	})

  	if(userStatus == 0){

  		$(this).removeClass('btn-success');
  		$(this).addClass('btn-danger');
  		$(this).html('Deactivated');
  		$(this).attr('userStatus',1);

  	}else{

  		$(this).addClass('btn-success');
  		$(this).removeClass('btn-danger');
  		$(this).html('Activated');
  		$(this).attr('userStatus',0);

  	}

});

// Duplicate Username Check (https://stackoverflow.com/questions/4660850/jquery-ajax-on-username-validation)
$("#newUser").change(function(){

	$(".alert").remove();

	var user = $(this).val();

	var data = new FormData();
 	data.append("validateUser", user);

  	$.ajax({

	  url:"ajax/users.ajax.php",
	  method: "POST",
	  data: data,
	  cache: false,
      contentType: false,
      processData: false,
      dataType: "json",
      success: function(answer){ 

      	console.log("answer", answer);

      	if(answer){

      		$("#newUser").parent().after('<div class="alert alert-warning">Username Already in Use</div>');
      		
      		$("#newUser").val('');
      	}

      }

    });

});

// Delete User

$(document).on("click", ".btnDeleteUser", function(){

	var userId = $(this).attr("userId");
	var username = $(this).attr("username");

	swal({
		title: 'Are you sure you want to delete user?',
		type: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		  cancelButtonColor: '#d33',
		  cancelButtonText: 'Cancel',
		  confirmButtonText: 'Confirm'
		}).then(function(result){

		if(result.value){

		  window.location = "index.php?route=users&userId="+userId+"&username="+username;

		}

	})

});
