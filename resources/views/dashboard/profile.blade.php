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
            <div class="animated fadeIn">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <!-- Credit Card -->
                                <div id="pay-invoice">
                                    <div class="card-body">
                                        <div class="card-title">
                                            <h3 class="text-center">Edit Profile</h3>
                                        </div>
                                        <hr>
                                        <form action="{{ action('DashboardController@profileUpdate') }}" method="post" name="userForm" id="userForm" enctype="multipart/form-data">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="userId" id="userId" value="{{ $userDetails['id'] }}">
                                            <input type="hidden" name="userAvatar" id="userAvatar" value="{{ $userDetails['avatar'] }}">

                                            <div class="form-group">
                                                <label for="name" class="control-label mb-1">Name</label>
                                                <input id="name" name="name" type="text" class="form-control @if ($errors->has('name')) is-invalid @endif" value="{{ $userDetails['name'] }}">
                                                @if ($errors->has('name'))
                                                    @foreach ($errors->get('name') as $error)
                                                        <span class="help-block formValidationError">{{ $error }}</span>
                                                    @endforeach
                                                @endif
                                            </div>
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="email" class="control-label mb-1">Email</label>
                                                        <input id="email" name="email" type="text" class="form-control @if ($errors->has('email')) is-invalid @endif" value="{{ $userDetails['email'] }}">
                                                        @if ($errors->has('email'))
                                                            @foreach ($errors->get('email') as $error)
                                                                <span class="help-block formValidationError">{{ $error }}</span>
                                                            @endforeach
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="mobile" class="control-label mb-1">Mobile</label>
                                                        <input id="mobile" name="mobile" type="tel" class="form-control @if ($errors->has('mobile')) is-invalid @endif" value="{{ $userDetails['mobile'] }}">
                                                        @if ($errors->has('mobile'))
                                                            @foreach ($errors->get('mobile') as $error)
                                                                <span class="help-block formValidationError">{{ $error }}</span>
                                                            @endforeach
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="image" class="control-label">Image</label>
                                                        <input type="file" id="image" name="image" class="form-control-file" accept="image/png, image/jpeg">
                                                    </div>
                                                </div>
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