<!doctype html>
<html class="no-js" lang="">
<head>
    @include('common/base')
</head>
<body>
    <!-- Left Panel -->
    @include('common/left-sidebar')
    <!-- Left Panel -->

    <!-- Right Panel -->

    <div id="right-panel" class="right-panel">

        <!-- Header-->
        @include('common/header')
        <!-- Header-->

        <div class="content">
            @include('common/message-show')
            <div class="animated fadeIn">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <!-- Credit Card -->
                                <div id="pay-invoice">
                                    <div class="card-body">
                                        <div class="card-title">
                                            <h3 class="text-center">Change Password</h3>
                                        </div>
                                        <hr>
                                        <form action="{{ action('DashboardController@changePasswordUpdate') }}" method="post" name="changePassForm" id="changePassForm">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="userId" id="userId" value="{{ $userId }}">
                                            <div class="form-group">
                                                <label for="oldPassword" class="control-label mb-1">Old Password</label>
                                                <input id="oldPassword" name="oldPassword" type="password" class="form-control @if ($errors->has('oldPassword')) is-invalid @endif" value="{{ old('oldPassword') }}">
                                                @if ($errors->has('oldPassword'))
                                                    @foreach ($errors->get('oldPassword') as $error)
                                                        <span class="help-block formValidationError">{{ $error }}</span>
                                                    @endforeach
                                                @endif
                                            </div>
                                            <div class="form-group">
                                                <label for="newPassword" class="control-label mb-1">New Password</label>
                                                <input id="newPassword" name="newPassword" type="password" class="form-control @if ($errors->has('newPassword')) is-invalid @endif" value="{{ old('newPassword') }}">
                                                @if ($errors->has('newPassword'))
                                                    @foreach ($errors->get('newPassword') as $error)
                                                        <span class="help-block formValidationError">{{ $error }}</span>
                                                    @endforeach
                                                @endif
                                            </div>
                                            <div class="form-group">
                                                <label for="confirmPassword" class="control-label mb-1">Confirm Password</label>
                                                <input id="confirmPassword" name="confirmPassword" type="password" class="form-control @if ($errors->has('confirmPassword')) is-invalid @endif" value="{{ old('confirmPassword') }}">
                                                @if ($errors->has('confirmPassword'))
                                                    @foreach ($errors->get('confirmPassword') as $error)
                                                        <span class="help-block formValidationError">{{ $error }}</span>
                                                    @endforeach
                                                @endif
                                            </div>
                                            <div>
                                                <button id="userCreateBtn" type="submit" class="btn btn-lg btn-info btn-block">
                                                    Update
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                            </div>
                        </div> <!-- .card -->

                    </div>
                </div>

            </div>


        </div><!-- .animated -->
    
        <div class="clearfix"></div>

        @include('common/footer')

    </div><!-- /#right-panel -->

    @include('common/scripts')

</body>
</html>