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
                                            <h3 class="text-center">New CRM Details</h3>
                                        </div>
                                        <div class="form-error">
                                            @include('common.message-show')
                                        </div>
                                        <hr>
                                     <form action="{{route('crm.store')}}" method="POST" name="result-form" enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                            <div class="form-group">
                                                <label for="cc-payment" class="control-label mb-1">CRM Name</label>
                                                <input id="crm_name" name="crm_name" type="text" class="form-control @if ($errors->has('crm_name')) is-invalid @endif" value="{{old('crm_name')}}">
                                                @if ($errors->has('crm_name'))
                                                    @foreach ($errors->get('crm_name') as $error)
                                                        <span class="help-block formValidationError">{{ $error }}</span>
                                                    @endforeach
                                                @endif
                                            </div>
                                            <div class="form-group has-success">
                                                <label for="cc-name" class="control-label mb-1">Instance</label>
                                            <input id="endpoint" name="endpoint" type="text" class="form-control @if ($errors->has('endpoint')) is-invalid @endif" value="{{old('endpoint')}}">
                                            @if ($errors->has('endpoint'))
                                                    @foreach ($errors->get('endpoint') as $error)
                                                        <span class="help-block formValidationError">{{ $error }}</span>
                                                    @endforeach
                                                @endif
                                            </div>
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="cc-exp" class="control-label mb-1">User</label>
                                                        <input id="crm_user" name="crm_user" type="text" class="form-control @if ($errors->has('crm_user')) is-invalid @endif" value="{{ old('crm_user') }}" >
                                                        @if ($errors->has('crm_user'))
                                                            @foreach ($errors->get('crm_user') as $error)
                                                                <span class="help-block formValidationError">{{ $error }}</span>
                                                            @endforeach
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <label for="x_card_code" class="control-label mb-1">Password</label>
                                                    <div class="input-group">
                                                    <input id="crm_password" name="crm_password" type="text" class="form-control @if ($errors->has('crm_password')) is-invalid @endif" value="{{old('crm_password')}}">
                                                        @if ($errors->has('crm_password'))
                                                            @foreach ($errors->get('crm_password') as $error)
                                                                <span class="help-block formValidationError">{{ $error }}</span>
                                                            @endforeach
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div>
                                                <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                                    Submit
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


        </div>

        <div class="clearfix"></div>

        @include('common/footer')

    </div><!-- /#right-panel -->

@include('common/scripts')

</body>
</html>
