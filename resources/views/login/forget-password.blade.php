<!doctype html>
<html class="no-js" lang="">
<head>
    @include('common/base')
</head>

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
                    <form name="forgetPassForm" id="forgetPassForm" method="post" action="javascript:void(0);">
                    	{{ csrf_field() }}
                                               
                        @include('common/message-show')

                        <div class="alert alert-danger alert-block" id="accountError" style="display: none;">
                        </div>

                        <div class="form-group">
                            <label>Email address</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="Email">
                            <span id="emailError" class="errormessage" style="display: none"></span>
                        </div>

                        <div class="checkbox">
                            <label class="pull-right">
                                <a href="{{url('/admin/login')}}">Remember Password?</a>
                            </label>
                        </div>

                        <button type="submit" onclick="submitForgetPassForm();" name="forgetPassSubmit" id="forgetPassSubmit" class="btn btn-primary btn-flat m-b-15">Submit <i id="loginLoader" class="fa fa-spinner" style="display: none" ></i></button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @include('common/scripts')

    <script type="text/javascript">
      function submitForgetPassForm()
      {
        $("#accountError").html('This section is under development.').fadeIn('slow');
      }
    </script>

</body>
</html>