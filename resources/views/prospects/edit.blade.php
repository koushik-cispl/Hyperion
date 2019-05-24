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
                                            <h3 class="text-center">Edit Prospect Details</h3>
                                        </div>
                                        <hr>
                                        <form action="{{route('prospects.update',$prospectDetails['id'])}}" method="post" name="prospectForm" id="prospectForm">
                                            {{ csrf_field() }}
                                            <input name="_method" type="hidden" value="PUT">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="fname" class="control-label mb-1">First Name</label>
                                                        <input id="fname" name="fname" type="text" class="form-control @if ($errors->has('fname')) is-invalid @endif" value="{{ $prospectDetails['fname'] }}">
                                                        @if ($errors->has('fname'))
                                                            @foreach ($errors->get('fname') as $error)
                                                                <span class="help-block formValidationError">{{ $error }}</span>
                                                            @endforeach
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="lname" class="control-label mb-1">Last Name</label>
                                                        <input id="lname" name="lname" type="text" class="form-control @if ($errors->has('lname')) is-invalid @endif" value="{{ $prospectDetails['lname'] }}">
                                                        @if ($errors->has('lname'))
                                                            @foreach ($errors->get('lname') as $error)
                                                                <span class="help-block formValidationError">{{ $error }}</span>
                                                            @endforeach
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- <div class="row">
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="email" class="control-label mb-1">Email</label>
                                                        <input id="email" name="email" type="text" class="form-control @if ($errors->has('email')) is-invalid @endif" value="{{ $prospectDetails['email'] }}">
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
                                                        <input id="mobile" name="mobile" type="tel" class="form-control @if ($errors->has('mobile')) is-invalid @endif" value="{{ $prospectDetails['mobile'] }}">
                                                        @if ($errors->has('mobile'))
                                                            @foreach ($errors->get('mobile') as $error)
                                                                <span class="help-block formValidationError">{{ $error }}</span>
                                                            @endforeach
                                                        @endif
                                                    </div>
                                                </div>
                                            </div> -->
                                            <div class="form-group">
                                                <label for="address" class="control-label mb-1">Address</label>
                                                <textarea id="address" name="address" class="form-control @if ($errors->has('address')) is-invalid @endif">{{ $prospectDetails['address'] }}</textarea>
                                                @if ($errors->has('address'))
                                                    @foreach ($errors->get('address') as $error)
                                                        <span class="help-block formValidationError">{{ $error }}</span>
                                                    @endforeach
                                                @endif
                                            </div>
                                            <div class="form-group">
                                                <label for="address2" class="control-label mb-1">Address 2</label>
                                                <textarea id="address2" name="address2" class="form-control @if ($errors->has('address2')) is-invalid @endif">{{ $prospectDetails['address2'] }}</textarea>
                                                @if ($errors->has('address2'))
                                                    @foreach ($errors->get('address2') as $error)
                                                        <span class="help-block formValidationError">{{ $error }}</span>
                                                    @endforeach
                                                @endif
                                            </div>
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="city" class="control-label mb-1">City</label>
                                                        <input id="city" name="city" type="text" class="form-control @if ($errors->has('city')) is-invalid @endif" value="{{ $prospectDetails['city'] }}">
                                                        @if ($errors->has('city'))
                                                            @foreach ($errors->get('city') as $error)
                                                                <span class="help-block formValidationError">{{ $error }}</span>
                                                            @endforeach
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="state" class="control-label mb-1">State</label>
                                                        <input id="state" name="state" type="text" class="form-control @if ($errors->has('state')) is-invalid @endif" value="{{ $prospectDetails['state'] }}">
                                                        @if ($errors->has('state'))
                                                            @foreach ($errors->get('state') as $error)
                                                                <span class="help-block formValidationError">{{ $error }}</span>
                                                            @endforeach
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="zip" class="control-label mb-1">Zip Code</label>
                                                        <input id="zip" name="zip" type="text" class="form-control @if ($errors->has('zip')) is-invalid @endif" value="{{ $prospectDetails['zip_code'] }}">
                                                        @if ($errors->has('zip'))
                                                            @foreach ($errors->get('zip') as $error)
                                                                <span class="help-block formValidationError">{{ $error }}</span>
                                                            @endforeach
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="plus4" class="control-label mb-1">Plus4</label>
                                                        <input id="plus4" name="plus4" type="text" class="form-control @if ($errors->has('plus4')) is-invalid @endif" value="{{ $prospectDetails['plus4'] }}">
                                                        @if ($errors->has('plus4'))
                                                            @foreach ($errors->get('plus4') as $error)
                                                                <span class="help-block formValidationError">{{ $error }}</span>
                                                            @endforeach
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="deliveryP" class="control-label mb-1">DeliveryP</label>
                                                        <input id="deliveryP" name="deliveryP" type="text" class="form-control @if ($errors->has('deliveryP')) is-invalid @endif" value="{{ $prospectDetails['delivery_p'] }}">
                                                        @if ($errors->has('deliveryP'))
                                                            @foreach ($errors->get('deliveryP') as $error)
                                                                <span class="help-block formValidationError">{{ $error }}</span>
                                                            @endforeach
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="crrt" class="control-label mb-1">CRRT</label>
                                                        <input id="crrt" name="crrt" type="text" class="form-control @if ($errors->has('crrt')) is-invalid @endif" value="{{ $prospectDetails['crrt'] }}">
                                                        @if ($errors->has('crrt'))
                                                            @foreach ($errors->get('crrt') as $error)
                                                                <span class="help-block formValidationError">{{ $error }}</span>
                                                            @endforeach
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="check_digi" class="control-label mb-1">Check Digi</label>
                                                        <input id="check_digi" name="check_digi" type="text" class="form-control @if ($errors->has('check_digi')) is-invalid @endif" value="{{ $prospectDetails['check_digi'] }}">
                                                        @if ($errors->has('check_digi'))
                                                            @foreach ($errors->get('check_digi') as $error)
                                                                <span class="help-block formValidationError">{{ $error }}</span>
                                                            @endforeach
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="return_cod" class="control-label mb-1">Return COD</label>
                                                        <input id="return_cod" name="return_cod" type="text" class="form-control @if ($errors->has('return_cod')) is-invalid @endif" value="{{ $prospectDetails['return_cod'] }}">
                                                        @if ($errors->has('return_cod'))
                                                            @foreach ($errors->get('return_cod') as $error)
                                                                <span class="help-block formValidationError">{{ $error }}</span>
                                                            @endforeach
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="dpv" class="control-label mb-1">DPV</label>
                                                        <input id="dpv" name="dpv" type="text" class="form-control @if ($errors->has('dpv')) is-invalid @endif" value="{{ $prospectDetails['dpv'] }}">
                                                        @if ($errors->has('dpv'))
                                                            @foreach ($errors->get('dpv') as $error)
                                                                <span class="help-block formValidationError">{{ $error }}</span>
                                                            @endforeach
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="lot" class="control-label mb-1">Lot</label>
                                                        <input id="lot" name="lot" type="text" class="form-control @if ($errors->has('lot')) is-invalid @endif" value="{{ $prospectDetails['lot'] }}">
                                                        @if ($errors->has('lot'))
                                                            @foreach ($errors->get('lot') as $error)
                                                                <span class="help-block formValidationError">{{ $error }}</span>
                                                            @endforeach
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="finder" class="control-label mb-1">Finder</label>
                                                        <input id="finder" name="finder" type="text" class="form-control @if ($errors->has('finder')) is-invalid @endif" value="{{ $prospectDetails['finder'] }}">
                                                        @if ($errors->has('finder'))
                                                            @foreach ($errors->get('finder') as $error)
                                                                <span class="help-block formValidationError">{{ $error }}</span>
                                                            @endforeach
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="key" class="control-label mb-1">Key</label>
                                                        <input id="key" name="key" type="text" class="form-control @if ($errors->has('key')) is-invalid @endif" value="{{ $prospectDetails['p_key'] }}">
                                                        @if ($errors->has('key'))
                                                            @foreach ($errors->get('key') as $error)
                                                                <span class="help-block formValidationError">{{ $error }}</span>
                                                            @endforeach
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div>
                                                <button id="prospectCreateBtn" type="submit" class="btn btn-lg btn-info btn-block">
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


        </div>
    
        <div class="clearfix"></div>

        @include('common/footer')

    </div><!-- /#right-panel -->

@include('common/scripts')

<script type="text/javascript">
    function changeState(countryId)
    {
        $("#stateLoader").fadeIn("slow");
        $.ajax({
            type: 'POST',
            url: "{{url('admin/statechange')}}",
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: 'countryId=' + countryId,
            dataType: "json",
            success: function(res) {
                $("#stateLoader").fadeOut("slow");
                $("#state").html(res.options);
                //$('.selectpicker').selectpicker('refresh');
            }
        });
    }
</script>

</body>
</html>