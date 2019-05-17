<!doctype html>
<html class="no-js" lang="">
<head>
    @include('common/base')
</head>

<?php
  if(isset($_COOKIE['userEmail']) && isset($_COOKIE['userPassword']))
  {
    $userEmail = $_COOKIE['userEmail'];
    $userPassword = $_COOKIE['userPassword'];
    $remember = 1;
  }
  else
  {
    $userEmail = '';
    $userPassword = '';
    $remember = 0;
  }
?>

<body class="bg-dark">

    <div class="sufee-login d-flex align-content-center flex-wrap">
        <div class="container">
            <div class="login-content">
                <div class="login-logo">
                    <a href="{{url('/admin/login')}}">
                        <img class="align-content" src="{{asset('back_end/images/logo.png')}}" alt="">
                    </a>
                </div>
                <div class="login-form">
                    <form name="loginForm" id="loginForm" method="post" action="javascript:void(0);">
                    	{{ csrf_field() }}
                                               
                        @include('common/message-show')

                        <div class="alert alert-danger alert-block" id="accountError" style="display: none;">
                        </div>

                        <div class="form-group">
                            <label>Email address</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="Email" value="{{ $userEmail }}">
                            <span id="emailError" class="errormessage" style="display: none"></span>
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password" id="password" class="form-control" placeholder="Password" value="{{ $userPassword }}">
                            <span id="passwordError" class="errormessage" style="display: none"></span>
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="remember" id="remember" value="{{ $remember }}" @if($remember == 1) checked="checked" @endif> Remember Me
                            </label>
                            <label class="pull-right">
                                <a href="{{url('/admin/forget-password')}}">Forgotten Password?</a>
                            </label>

                        </div>
                        <button type="submit" onclick="submitLoginForm();" name="loginSubmit" id="loginSubmit" class="btn btn-success btn-flat m-b-30 m-t-30">Sign in <i id="loginLoader" class="fa fa-spinner" style="display: none" ></i></button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @include('common/scripts')

    <script type="text/javascript">

        $( document ).ready(function() {
          $("#remember").change(function() {
            if(this.checked) {
              $("#remember").val(1);
            }
            else
            {
              $("#remember").val(0);
            }
          });
        });

        function submitLoginForm()
        {
          var email = $("#email").val();
          var password = $("#password").val();
          var remember = $("#remember").val();

          if(email == '')
          {
              $("#email").addClass('error');
              $("#emailError").html('Please enter your email in valid format.').fadeIn('slow');
              var emailErrorCheck = 1;
          }
          else
          {
              $("#email").removeClass('error');
              $("#emailError").html('').fadeOut('slow');
              var emailErrorCheck = 0;
          }

          if(password == '')
          {
              $("#password").addClass('error');
              $("#passwordError").html('Please enter your password.').fadeIn('slow');
              var passwordErrorCheck = 1;
          }
          else
          {
              $("#password").removeClass('error');
              $("#passwordError").html('').fadeOut('slow');
              var passwordErrorCheck = 0;
          }

          if(emailErrorCheck == 0 && passwordErrorCheck == 0) {
              $("#loginLoader").fadeIn('slow');
              $('#loginSubmit').prop("disabled", true);
              $.ajax({
                  type: "POST",
                  url: "{{url('admin/login-submit')}}",
                  headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  },
                  data: { email:email, password:password, remember:remember },
                  success: function(result)
                  {
                    $("#loginLoader").fadeOut('slow');
                    $('#loginSubmit').prop("disabled", false);

                    var jsonData = $.parseJSON(result); 
                    var returnData = jsonData.success;
                    var returnMessage = jsonData.messageType;
                    var userId = jsonData.userId;
                    if(returnData == 0) {
                      $("#password").addClass('error');
                      $("#passwordError").html(returnMessage).fadeIn('slow');
                    } else if(returnData == 2) {
                        $("#accountError").html('<strong>'+returnMessage+'</strong>').fadeIn('slow');
                        setTimeout(function(){
                          $("#accountError").html('').fadeOut('slow');
                        }, 4000);
                    } else {
                      window.location.href = "{{url('/admin/set-session')}}"+'/'+userId;
                    }
                  }
              });
          }
        }

        $('#email').keyup(function () {
          var $email = this.value;
          validateEmail($email);
        });

        function validateEmail(fieldValue) {
          if(fieldValue == '') {
              $("#email").addClass('error');
              $("#emailError").html('Please put an valid email format').fadeIn('slow');
          } else {
              var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
              if (!emailReg.test(fieldValue)) {
                  $("#email").addClass('error');
                  $("#emailError").html('Please put an valid email format.').fadeIn('slow');
                  $('#loginSubmit').prop('disabled', true);
              } else {
                  var fieldType = "email";
                  checkValueExists(fieldType,fieldValue);
                  $("#email").removeClass('error');
                  $("#emailError").html('').fadeOut('slow');
                  $('#loginSubmit').prop('disabled', false);
              }
          }
        }

        function checkValueExists(fieldType,fieldValue)
        {
            $.ajax({
                type: 'POST',
                url: "{{url('admin/check-value-exist')}}",
                headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: 'fieldType=' + fieldType + '&fieldValue=' + fieldValue,
                success: function(res) {
                    if(res == 'found')
                    {
                        $("#email").removeClass('error');
                        $("#emailError").html('').fadeOut('slow');
                        $('#loginSubmit').prop("disabled", false);
                    } else {
                        $("#email").addClass('error');
                        $("#emailError").html('This email does not exist.').fadeIn('slow');
                        $('#loginSubmit').prop("disabled", true);
                    }
                }
            });
        }
    </script>

</body>
</html>