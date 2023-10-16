$(document).ready(function(){
  $("#ConfirmPassword").on("keyup change", function(e){
     checkPasswordMatch();
     checkPasswordStrength()
 });
 $("#NewPassword").on("keyup change", function(e){
   checkPasswordStrength();
    checkPasswordChange();
});

    $(".ajax-form").submit(function(e){
    var form = $(this);
        $.post("processor/processes.php", form.serialize(), function(response) {
            var data = JSON.parse(response);
            if(data.code == 'yes'){
                  Swal.fire({
                  icon: 'success',
                  title: 'Success',
                  text: data.message
                      })
                setTimeout(function(){ window.location = data.url; }, 3000);
            }
            if(data.code == 'no'){
                 Swal.fire({
                  icon: 'error',
                  title: 'Sorry',
                  text: data.message
                })
            }

        });

        return false;
});

    $("#to_select").children('option:gt(0)').show();
    $("#from_select").change(function() {
        $("#to_select").children('option').show();
        $("#to_select").children("option[value^=" + $(this).val() + "]").hide()
    })

    $("#from_select").children('option:gt(0)').show();
    $("#to_select").change(function() {
        $("#from_select").children('option').show();
        $("#from_select").children("option[value^=" + $(this).val() + "]").hide()
    })

    var today = new Date();
var dd = today.getDate();
var mm = today.getMonth()+1;
var yyyy = today.getFullYear();
 if(dd<10){
        dd='0'+dd
    }
    if(mm<10){
        mm='0'+mm
    }

today = yyyy+'-'+mm+'-'+dd;
document.getElementById("datefield").setAttribute("min", today);


});

function check_user()
        {
            $.ajax({
                type: "POST",
                data: {
                    echeck: $('#echeck').val(),
                },
                url: "processor/processes.php",
                success: function(data)
                {
                    if(data === 'no')
                    {
                        $('#usercheck').css('color', 'red').html("This email already exists!");
                            $(':input[type="submit"]').prop('disabled', true);
                    }
                    else if(data === 'yes')
                    {
                        $('#usercheck').css('color', 'green').html("Email available for registration.");
                            if($('#PasswordMatch').html() == "Passwords match!"){
                              $(':input[type="submit"]').prop('disabled', false);
                            } else if($('#PasswordMatch').html() == "Passwords do not match!" || $('#PasswordMatch').html() == ""){
                              $(':input[type="submit"]').prop('disabled', true);
                            }
                        //$("#regg").prop('disabled', false);
                    }
                }
            })
        }

        function checkPasswordMatch() {
            var password = $("#NewPassword").val();
            var confirmPassword = $("#ConfirmPassword").val();
            if(password != ""){
            if (password != confirmPassword){
                $("#PasswordMatch").css('color', 'red').html("Passwords do not match!");
                $(':input[type="submit"]').prop('disabled', true);
            }else{
                $("#PasswordMatch").css('color', 'green').html("Passwords match!");
                if($('#usercheck').html() == "Email available for registration."){
                  $(':input[type="submit"]').prop('disabled', false);
                } else if($('#usercheck').html() == "This email already exists!" || $('#usercheck').html() == ""){
                $(':input[type="submit"]').prop('disabled', true);
                  alert("Make corrections on email field to continue.");
                  return false;
                }

              }
            }
        }

        function checkPasswordChange() {
            var password = $("#NewPassword").val();
            var confirmPassword = $("#ConfirmPassword").val();
         if(confirmPassword != ""){
           if (password != confirmPassword){
               $("#PasswordMatch").css('color', 'red').html("Passwords do not match!");
               $(':input[type="submit"]').prop('disabled', true);
           }else{
               $("#PasswordMatch").css('color', 'green').html("Passwords match!");
               if($('#usercheck').html() == "Email available for registration."){
                 $(':input[type="submit"]').prop('disabled', false);
               } else if($('#usercheck').html() == "This email already exists!" || $('#usercheck').html() == ""){
               $(':input[type="submit"]').prop('disabled', true);
               }

             }
         }

        }

        function checkPasswordStrength() {
        	var number = /([0-9])/;
        	var alphabets = /([a-zA-Z])/;
        	var special_characters = /([~,!,@,#,$,%,^,&,*,-,_,+,=,?,>,<])/;
        	var password = $('#NewPassword').val().trim();
        	if (password.length < 6) {
        		$('#password-strength-status').removeClass();
        		$('#password-strength-status').addClass('weak-password');
        		$('#password-strength-status').html("Weak (should be atleast 6 characters.)");
            $(':input[type="submit"]').prop('disabled', true);
        	} else {
        		if (password.match(number) && password.match(alphabets) && password.match(special_characters)) {
        			$('#password-strength-status').removeClass();
        			$('#password-strength-status').addClass('strong-password');
        			$('#password-strength-status').html("Strong");
              $(':input[type="submit"]').prop('disabled', false);
        		}
        		else {
        			$('#password-strength-status').removeClass();
        			$('#password-strength-status').addClass('medium-password');
        			$('#password-strength-status').html("Medium (should include alphabets, numbers and special characters.)");
              $(':input[type="submit"]').prop('disabled', true);
        		}
        	}
        }
