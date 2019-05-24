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
                                            <h3 class="text-center">View Prospect Details</h3>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="fname" class="control-label mb-1">First Name</label>
                                                    <input id="fname" name="fname" type="text" class="form-control" value="{{ $prospectDetails['fname'] }}" readonly="readonly">
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="lname" class="control-label mb-1">Last Name</label>
                                                    <input id="lname" name="lname" type="text" class="form-control" value="{{ $prospectDetails['lname'] }}" readonly="readonly">
                                                </div>
                                            </div>
                                        </div>
                                        <!-- <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="email" class="control-label mb-1">Email</label>
                                                    <input id="email" name="email" type="text" class="form-control" value="{{ $prospectDetails['email'] }}" readonly="readonly">
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="mobile" class="control-label mb-1">Mobile</label>
                                                    <input id="mobile" name="mobile" type="tel" class="form-control" value="{{ $prospectDetails['mobile'] }}" readonly="readonly">
                                                </div>
                                            </div>
                                        </div> -->
                                        <div class="form-group">
                                            <label for="address" class="control-label mb-1">Address</label>
                                            <textarea id="address" name="address" class="form-control" readonly="readonly">{{ $prospectDetails['address'] }}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="address" class="control-label mb-1">Address2</label>
                                            <textarea id="address" name="address" class="form-control" readonly="readonly">{{ $prospectDetails['address2'] }}</textarea>
                                        </div>
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="city" class="control-label mb-1">City</label>
                                                    <input id="city" name="city" type="text" class="form-control" value="{{ $prospectDetails['city'] }}" readonly="readonly">
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="state" class="control-label mb-1">State</label>
                                                    <input id="state" name="state" type="text" class="form-control" value="{{ $prospectDetails['state'] }}" readonly="readonly">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="zip" class="control-label mb-1">Zip Code</label>
                                                    <input id="zip" name="zip" type="text" class="form-control" value="{{ $prospectDetails['zip_code'] }}" readonly="readonly">
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="plus4" class="control-label mb-1">Plus4</label>
                                                    <input id="plus4" name="plus4" type="text" class="form-control" value="{{ $prospectDetails['plus4'] }}" readonly="readonly">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="deliveryP" class="control-label mb-1">DeliveryP</label>
                                                    <input id="deliveryP" name="deliveryP" type="text" class="form-control" value="{{ $prospectDetails['delivery_p'] }}" readonly="readonly">
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="crrt" class="control-label mb-1">CRRT</label>
                                                    <input id="crrt" name="crrt" type="text" class="form-control" value="{{ $prospectDetails['crrt'] }}" readonly="readonly">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="check_digi" class="control-label mb-1">Check Digi</label>
                                                    <input id="check_digi" name="check_digi" type="text" class="form-control" value="{{ $prospectDetails['check_digi'] }}" readonly="readonly">
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="return_cod" class="control-label mb-1">Return COD</label>
                                                    <input id="return_cod" name="return_cod" type="text" class="form-control" value="{{ $prospectDetails['return_cod'] }}" readonly="readonly">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="dpv" class="control-label mb-1">DPV</label>
                                                    <input id="dpv" name="dpv" type="text" class="form-control" value="{{ $prospectDetails['dpv'] }}" readonly="readonly">
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="lot" class="control-label mb-1">Lot</label>
                                                    <input id="lot" name="lot" type="text" class="form-control" value="{{ $prospectDetails['lot'] }}" readonly="readonly">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="finder" class="control-label mb-1">Finder</label>
                                                    <input id="finder" name="finder" type="text" class="form-control" value="{{ $prospectDetails['finder'] }}" readonly="readonly">
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="key" class="control-label mb-1">Key</label>
                                                    <input id="key" name="key" type="text" class="form-control" value="{{ $prospectDetails['p_key'] }}" readonly="readonly">
                                                </div>
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

<!-- Right Panel -->

@include('common/scripts')

</body>
</html>