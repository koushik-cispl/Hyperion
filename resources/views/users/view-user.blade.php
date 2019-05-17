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
                                            <h3 class="text-center">View User Details</h3>
                                        </div>
                                        <hr>
                                        
                                            <div class="form-group">
                                                <label for="name" class="control-label mb-1">Name</label>
                                                <input id="name" name="name" type="text" class="form-control" value="{{ $userDetails['name'] }}" readonly="readonly">
                                            </div>
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="email" class="control-label mb-1">Email</label>
                                                        <input id="email" name="email" type="text" class="form-control" value="{{ $userDetails['email'] }}" readonly="readonly">
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="mobile" class="control-label mb-1">Mobile</label>
                                                        <input id="mobile" name="mobile" type="tel" class="form-control" value="{{ $userDetails['mobile'] }}" readonly="readonly">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="image" class="control-label">Image</label>
                                                        @if($userDetails['avatar'] != '')
                                                        <img class="view-image-circle" src="{{ URL::to('/admin_user_images/'.$userDetails['avatar']) }}" alt="User Avatar">
                                                        @else
                                                        <img class="view-image-circle" src="{{asset('back_end/images/avatar/avatar.png')}}" alt="User Avatar">
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="role" class="control-label">Role</label>
                                                        <input id="role" name="role" type="tel" class="form-control" value="{{ $userDetails['user_roles']['name'] }}" readonly="readonly">
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <label for="status" class="control-label mb-1">Status</label>
                                                    <input id="status" name="status" type="tel" class="form-control" value="{{ ($userDetails['status'] == 1 ? 'Active':'Inactive') }}" readonly="readonly">
                                                </div>
                                            </div>
                                            
                                    </div>
                                </div>

                            </div>
                        </div> <!-- .card -->

                    </div>
                </div>

            </div>


        </div>

        <div class="clearfix"></div>

        @include('common/footer')

    </div><!-- /#right-panel -->

@include('common/scripts')

</body>
</html>