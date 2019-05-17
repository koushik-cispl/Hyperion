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
                                            <h3 class="text-center">Edit CRM Details</h3>
                                        </div>
                                        <div class="form-error">
                                            @include('common.message-show')
                                        </div>

                                        <hr>
                                     <form action="{{route('crm.update',$crm->id)}}" method="POST" name="result-form" enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                        <input name="_method" type="hidden" value="PUT">
                                            <div class="form-group">
                                                <label for="cc-payment" class="control-label mb-1">CRM Name</label>
                                            <input id="crm_name" name="crm_name" value="{{$crm->api_name}}" type="text" class="form-control" aria-required="true" aria-invalid="false">
                                            </div>
                                            <div class="form-group has-success">
                                                <label for="cc-name" class="control-label mb-1">Instance</label>
                                                <input id="endpoint" value="{{$crm->api_endpoint}}" name="endpoint" type="text" class="form-control cc-name valid" data-val="true" data-val-required="Please enter the name on card" autocomplete="cc-name" aria-required="true" aria-invalid="false" aria-describedby="cc-name">
                                                <span class="help-block field-validation-valid" data-valmsg-for="cc-name" data-valmsg-replace="true"></span>
                                            </div>
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="cc-exp" class="control-label mb-1">User</label>
                                                        <input id="crm_user" value="{{$crm->api_username}}" name="crm_user" type="text" class="form-control cc-exp" value="" data-val="true" data-val-required="Please enter the card expiration" data-val-cc-exp="Please enter a valid month and year" >
                                                        <span class="help-block" data-valmsg-for="cc-exp" data-valmsg-replace="true"></span>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <label for="x_card_code" class="control-label mb-1">Password</label>
                                                    <div class="input-group">
                                                        <input id="crm_password" value="{{$crm->api_password}}" name="crm_password" type="text" class="form-control cc-cvc" value="" data-val="true" data-val-required="Please enter the security code" data-val-cc-cvc="Please enter a valid security code" autocomplete="off">
                                                        
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
