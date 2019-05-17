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
                                            <div class="row">
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
                                            </div>
                                            <div class="form-group">
                                                <label for="address" class="control-label mb-1">Address</label>
                                                <textarea id="address" name="address" class="form-control @if ($errors->has('address')) is-invalid @endif">{{ $prospectDetails['address'] }}</textarea>
                                                @if ($errors->has('address'))
                                                    @foreach ($errors->get('address') as $error)
                                                        <span class="help-block formValidationError">{{ $error }}</span>
                                                    @endforeach
                                                @endif
                                            </div>
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="country" class="control-label">Country</label>
                                                        <select name="country" id="country" class="form-control selectpicker @if ($errors->has('country')) is-invalid @endif" data-live-search="true" onchange="changeState($(this).val());">
                                                            <option value="">Please select a country</option>
                                                            @if(!empty($countryData))
                                                                @foreach ($countryData as $country)
                                                                    <option value="{{ $country['id'] }}" {{ ($prospectDetails['country'] == $country['id'] ? "selected":"") }}>{{ $country['name'] }}</option>
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                        @if ($errors->has('country'))
                                                            @foreach ($errors->get('country') as $error)
                                                                <span class="help-block formValidationError">{{ $error }}</span>
                                                            @endforeach
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="state" class="control-label">State</label>
                                                        <i id="stateLoader" class="fa fa-spinner" style="display: none" ></i>
                                                        <select name="state" id="state" class="form-control @if ($errors->has('state')) is-invalid @endif" data-live-search="true">
                                                            <option value="">Please select a state</option>
                                                            @if(!empty($stateData))
                                                                @foreach ($stateData as $state)
                                                                    <option value="{{ $state['id'] }}" {{ ($prospectDetails['state'] == $state['id'] ? "selected":"") }}>{{ $state['name'] }}</option>
                                                                @endforeach
                                                            @endif
                                                        </select>
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
                                                        <label for="zip" class="control-label mb-1">Zip Code</label>
                                                        <input id="zip" name="zip" type="text" class="form-control @if ($errors->has('zip')) is-invalid @endif" value="{{ $prospectDetails['zip_code'] }}">
                                                        @if ($errors->has('zip'))
                                                            @foreach ($errors->get('zip') as $error)
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