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
            <div class="animated">

                <div class="card">
                    <div class="card-header">
                        <i class="mr-2 fa fa-align-justify"></i>
                        <strong class="card-title" v-if="headerText">Place Order</strong>
                    </div>
              </div>
              

          
     
        
        <!-- Place order form -->
        <form action="{{route('placeOrder')}}" method="POST" name="OrderForm" id="OrderForm" class="form-horizontal">
            {{ csrf_field() }}
            <input type="hidden" name="prospectId" value="{{ $prospectDetails['id'] }}" id="prospectId">
            <div class="pop_loader" id="pop_loader">
                <div class="lds-roller"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
            </div>
            <div class="row">
        <div class="col-lg-6">
           
            <div class="card">
                <div class="card-header">
                    <strong>Campaign Information:</strong>
                </div>
                    <div class="card-body card-block">
                        <div class="row form-group">
                            <div class="col col-md-4"><label for="exampleInputName2" class="pr-1  form-control-label">Select Campaign:</label></div>
                        
                            <div class="col-12 col-md-8">
                                <select class="form-control" onchange="ChangeCampaign($(this).val());" name="campaignId" id="campaignId" >
                                    <option value="">Select Campaign</option>
                                    <?php array_walk($campaign_id, function ($campaign_id,$key) use ($campaign_name) { 
                                    ?>
                                    <option value="<?php echo $campaign_id; ?>"><?php echo '('.$campaign_id.') '. $campaign_name[$key];  ?></option> 
                                    <?php
                                        });
                                        ?>
                                </select>
                                    @if ($errors->has('campaignId'))
                                        @foreach ($errors->get('campaignId') as $error)
                                            <span class="help-block formValidationError">{{ $error }}</span>
                                        @endforeach
                                    @endif
                                     <span class="help-block formValidationError error-text"></span>
                                </div>
                        </div>
                    </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <strong>Product Info:</strong>
                </div>
                    <div class="card-body card-block">
                        

                        <div class="row form-group">
                          <div class="col col-md-4">  <label for="exampleInputName2" class="pr-1  form-control-label">Offer:</label></div>
                           <div class="col-12 col-md-8"> 
                               <select class="form-control" name="offer_id" id="offer_id">
                                    <option value="">Select Offer:</option>
                                </select>
                                 @if ($errors->has('offer_id'))
                                        @foreach ($errors->get('offer_id') as $error)
                                            <span class="help-block formValidationError">{{ $error }}</span>
                                        @endforeach
                                    @endif
                           </div>
                        </div>                        
                        <div class="row form-group">
                            <div class="col col-md-4"><label for="exampleInputName2" class="pr-1  form-control-label">Billing Model:</label></div>
                            <div class="col-12 col-md-8"><select class="form-control" name="billing_model_id" id="billing_model_id">
                                <option value="">Select Billing Model</option>
                            </select>
                                    @if ($errors->has('billing_model_id'))
                                        @foreach ($errors->get('billing_model_id') as $error)
                                            <span class="help-block formValidationError">{{ $error }}</span>
                                        @endforeach
                                    @endif
                                </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-4"><label for="exampleInputName2" class="pr-1  form-control-label"> Product:</label></div>
                            <div class="col-12 col-md-8"><select onchange="Changeproduct($(this).val());" class="form-control" name="product_id" id="product_id">
                                <option value="">Select product</option>
                            </select>
                                    @if ($errors->has('product_id'))
                                        @foreach ($errors->get('product_id') as $error)
                                            <span class="help-block formValidationError">{{ $error }}</span>
                                        @endforeach
                                    @endif
                                    </div>
                        </div>
                        {{-- <div class="row form-group">
                           <div class="col col-md-4"> <label for="exampleInputName2" class="pr-1  form-control-label"> Price:</label></div>
                           <div class="col-12 col-md-8"> <input type="text" id="ProductPrice" disabled="disabled" name="ProductPrice" class="form-control"></div>
                        </div> --}}
                        <div class="row form-group">
                            <div class="col col-md-4"><label for="exampleInputName2" class="pr-1  form-control-label">Quantity:</label></div>
                           <div class="col-12 col-md-8"> <input type="text" id="quantity" onkeyup="QtyChange(this.value);" name="quantity" class="form-control"></div>
                        </div>
                        <div>
                        <div class="row form-group">
                            <div class="col col-md-4"><label for="exampleInputName2" class="pr-1  form-control-label"> Shipping Method:</label></div>
                            <div class="col-12 col-md-6"><select onchange="ChangeShipping($(this).val());" class="form-control" name="shippingId" id="shippingId">
                                <option>Select Shipping</option>
                            </select>
                            </div><span>$<span class="ship_price line-height34">0.00</span></span>
                        </div>
                    </div>
                    </div>
                    
            </div>
            <div class="card">
                <div class="card-header">
                    <strong>Shipping / Billing Information:</strong>
                </div>
                <div class="card-body card-block">
                    
                    <div class="row form-group">
                        <div class="col col-md-4"><label for="text-input" class=" form-control-label">Shipping First Name:</label></div>
                            <div class="col-12 col-md-8">
                                <input type="text" id="ShippingFirstName" value="{{ $prospectDetails['fname'] }}" name="ShippingFirstName" class="form-control">
                                    @if ($errors->has('ShippingFirstName'))
                                        @foreach ($errors->get('ShippingFirstName') as $error)
                                        <span class="help-block formValidationError">{{ $error }}</span>
                                    @endforeach
                                @endif
                             </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-4"><label for="text-input" class=" form-control-label">Shipping Last Name:</label></div>
                            <div class="col-12 col-md-8"><input type="text" id="ShippingLastName" name="ShippingLastName" class="form-control" value="{{ $prospectDetails['lname'] }}">
                                @if ($errors->has('ShippingLastName'))
                                    @foreach ($errors->get('ShippingLastName') as $error)
                                        <span class="help-block formValidationError">{{ $error }}</span>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-4"><label for="text-input" class=" form-control-label">Shipping Address:</label></div>
                            <div class="col-12 col-md-8"><input type="text" id="ShippingAddress" name="ShippingAddress" class="form-control" value="{{ $prospectDetails['address'] }}">
                            @if ($errors->has('ShippingAddress'))
                                        @foreach ($errors->get('ShippingAddress') as $error)
                                            <span class="help-block formValidationError">{{ $error }}</span>
                                        @endforeach
                                    @endif
                                </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-4"><label for="text-input" class=" form-control-label">Shipping Address2:</label></div>
                            <div class="col-12 col-md-8"><input type="text" id="ShippingAddress2" name="ShippingAddress2" class="form-control" value="{{ $prospectDetails['address2'] }}"></div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-4"><label for="text-input" class=" form-control-label">Shipping City:</label></div>
                            <div class="col-12 col-md-8"><input type="text" id="ShippingCity" name="ShippingCity" class="form-control" value="{{ $prospectDetails['city'] }}">
                            @if ($errors->has('ShippingCity'))
                                        @foreach ($errors->get('ShippingCity') as $error)
                                            <span class="help-block formValidationError">{{ $error }}</span>
                                        @endforeach
                                    @endif
                                </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-4"><label for="text-input" class=" form-control-label">Shipping Zip Code:</label></div>
                            <div class="col-12 col-md-8"><input type="tel" id="ShippingZipCode" name="ShippingZipCode" class="form-control" value="{{ $prospectDetails['zip_code'] }}">
                            @if ($errors->has('ShippingZipCode'))
                                        @foreach ($errors->get('ShippingZipCode') as $error)
                                            <span class="help-block formValidationError">{{ $error }}</span>
                                        @endforeach
                                    @endif
                                </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-4"><label for="select" class=" form-control-label">Shipping Country:</label></div>
                            <div class="col-12 col-md-8">
                                <select name="ShippingCountry" id="ShippingCountry" class="form-control">
                                    <option value="US">US</option>
                                </select>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-4"><label for="select" class=" form-control-label">Shipping State:</label></div>
                            <div class="col-12 col-md-8">
                                <select name="ShippingState" id="ShippingState" class="form-control">
                                    <?php $states = \Helpers::get_states(); ?>
                                    <option value="">Select State</option>
                                    @foreach ($states  as $key => $value)
                                    <option value="{{$key}}" {{ ($prospectDetails['state'] == $key ? "selected":"") }}>{{$value}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-4"><label for="text-input" class=" form-control-label">Phone:</label></div>
                            <div class="col-12 col-md-8"><input type="tel" id="Phone" name="Phone" class="form-control" value="{{ $prospectDetails['mobile'] }}">
                            @if ($errors->has('Phone'))
                                        @foreach ($errors->get('Phone') as $error)
                                            <span class="help-block formValidationError">{{ $error }}</span>
                                        @endforeach
                                    @endif
                                </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-4"><label for="email-input" class=" form-control-label">Email</label></div>
                            <div class="col-12 col-md-8"><input type="email" id="Email" name="Email" class="form-control" value="{{ $prospectDetails['email'] }}">
                            @if ($errors->has('Email'))
                                        @foreach ($errors->get('Email') as $error)
                                            <span class="help-block formValidationError">{{ $error }}</span>
                                        @endforeach
                                    @endif
                                </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-8"><label class=" form-control-label">Is your billing address the same as this shipping address?</label></div>
                            <div class="col col-md-4">
                                <div class="form-check-inline form-check">
                                    <label for="inline-radio1" class="form-check-label margin-right10">
                                        <input type="radio" id="inline-radio1" name="BillasShipp" @if (!$errors->has('BillingFirstName'))  checked="checked" @endif onchange="BillSameAsShip(this.value);" value="yes" class="form-check-input">Yes
                                    </label>
                                    <label for="inline-radio2" class="form-check-label ">
                                        <input type="radio" id="inline-radio2" name="BillasShipp" onchange="BillSameAsShip(this.value);" value="no" @if ($errors->has('BillingFirstName'))  checked="checked" @endif class="form-check-input">No
                                    </label>
                                </div>
                            </div>
                        </div>
                        
                        <div class="BillingSameAsShipping" @if (!$errors->has('BillingFirstName')) style="display:none;" @endif>
                            <div class="row form-group">
                            <div class="col col-md-4"><label for="text-input" class=" form-control-label">Billing First Name:</label></div>
                                <div class="col-12 col-md-8">
                                    <input type="text" id="BillingFirstName" value="{{ old('BillingFirstName') }}" name="BillingFirstName" class="form-control">
                                        @if ($errors->has('BillingFirstName'))
                                            @foreach ($errors->get('BillingFirstName') as $error)
                                            <span class="help-block formValidationError">{{ $error }}</span>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-4"><label for="text-input" class=" form-control-label">Billing Last Name:</label></div>
                            <div class="col-12 col-md-8"><input type="text" value="{{ old('BillingLastName') }}" id="BillingLastName" name="BillingLastName" class="form-control">
                                    @if ($errors->has('BillingLastName'))
                                        @foreach ($errors->get('BillingLastName') as $error)
                                            <span class="help-block formValidationError">{{ $error }}</span>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-4"><label for="text-input" class=" form-control-label">Billing Address:</label></div>
                                <div class="col-12 col-md-8"><input type="text" value="{{ old('BillingAddress') }}" id="BillingAddress" name="BillingAddress" class="form-control">
                                @if ($errors->has('BillingAddress'))
                                            @foreach ($errors->get('BillingAddress') as $error)
                                                <span class="help-block formValidationError">{{ $error }}</span>
                                            @endforeach
                                        @endif
                                    </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-4"><label for="text-input" class=" form-control-label">Billing Address2:</label></div>
                                <div class="col-12 col-md-8"><input type="text" value="{{ old('BillingAddress2') }}" id="BillingAddress2" name="BillingAddress2" class="form-control"></div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-4"><label for="text-input" class=" form-control-label">Billing City:</label></div>
                                <div class="col-12 col-md-8"><input type="text" value="{{ old('BillingCity') }}" id="BillingCity" name="BillingCity" class="form-control">
                                @if ($errors->has('BillingCity'))
                                            @foreach ($errors->get('BillingCity') as $error)
                                                <span class="help-block formValidationError">{{ $error }}</span>
                                            @endforeach
                                        @endif
                                    </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-4"><label for="text-input" value="{{ old('BillingZipCode') }}" class=" form-control-label">Billing Zip Code:</label></div>
                                <div class="col-12 col-md-8"><input type="tel" id="BillingZipCode" name="BillingZipCode" class="form-control">
                                    @if ($errors->has('BillingZipCode'))
                                            @foreach ($errors->get('BillingZipCode') as $error)
                                                <span class="help-block formValidationError">{{ $error }}</span>
                                            @endforeach
                                        @endif
                                    </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-4"><label for="select" class=" form-control-label">Billing Country:</label></div>
                                <div class="col-12 col-md-8">
                                    <select name="BillingCountry" id="BillingCountry" class="form-control">
                                        <option value="US">US</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-4"><label for="select" class=" form-control-label">Billing State:</label></div>
                                <div class="col-12 col-md-8">
                                    <select name="BillingState" id="BillingState" class="form-control">
                                        <?php $states = \Helpers::get_states(); ?>
                                        <option value="">Select State</option>
                                        @foreach ($states  as $key => $value)
                                        <option value="{{$key}}" {{ (collect(old('BillingState'))->contains('key')) ? 'selected':'' }}>{{$value}}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('BillingState'))
                                            @foreach ($errors->get('BillingState') as $error)
                                                <span class="help-block formValidationError">{{ $error }}</span>
                                            @endforeach
                                        @endif
                                </div>
                            </div>
                        </div>
                        
                    
                </div>
            </div>
            <div class="card">
                <div class="card-header" id="affiliate_wrap">
                    <strong>Affiliate / Sub Affiliate:</strong>
                    <i class="fa fa-angle-down pull-right icon-down" aria-hidden="true"></i>
                </div>
                    <div class="card-body affiliate-block affiliate_wrap">
                        <div class="row form-group">
                            <div class="col col-md-3"><label for="exampleInputName2" class="pr-1  form-control-label">AFID:</label></div>
                           <div class="col-12 col-md-3"> <input type="text" name="AFID" class="form-control"></div>
                        <div class="col col-md-3"><label for="exampleInputName2" class="pr-1  form-control-label">SID:</label></div>
                           <div class="col-12 col-md-3"> <input type="text" name="SID" class="form-control"></div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3"><label for="exampleInputName2" class="pr-1  form-control-label">AFFID:</label></div>
                           <div class="col-12 col-md-3"> <input type="text" name="AFFID" class="form-control"></div>
                        <div class="col col-md-3"><label for="exampleInputName2" class="pr-1  form-control-label">C1:</label></div>
                           <div class="col-12 col-md-3"> <input type="text" name="C1" class="form-control"></div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3"><label for="exampleInputName2" class="pr-1  form-control-label">C2:</label></div>
                           <div class="col-12 col-md-3"> <input type="text" name="C2" class="form-control"></div>
                        <div class="col col-md-3"><label for="exampleInputName2" class="pr-1  form-control-label">C3:</label></div>
                           <div class="col-12 col-md-3"> <input type="text"  name="C3" class="form-control"></div>
                        </div>
                        <div class="row form-group">
                           <div class="col col-md-3"> <label for="exampleInputName2" class="pr-1  form-control-label"> Notes:</label></div>
                           <div class="col-12 col-md-9"> 
                               <textarea name="notes" class="form-control"></textarea></div>
                        </div>
                    </div>
            </div>
            
        </div>
        <div class="col-lg-6">
            <div class="card">
                            <div class="card-header">
                                <strong class="card-title">Order Summary:</strong>
                            </div>
                            <div class="table-stats order-table ov-h">
                                
                                <table class="table ">
                                    <thead>
                                        <tr>
                                            <th class="avatar"><strong>Product</strong></th>
                                            <th><strong>Base</strong></th>
                                            <th><strong>Qty</strong></th>
                                            <th><strong>Total</strong></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="product_details">
                                            <td><span id="pname"></span> </td>
                                            <td> $<span class="name baseprice" id="baseprice">0.00</span> </td>
                                            <td> <span class="product" id="qty"></span> </td>
                                            <td>$<span class="sub_total" >0.00</span></td>
                                        </tr>
                                        <tr>
                                            <td><span class="product">Sub Total:</span></td>
                                            <td></td>
                                            <td></td>
                                            <td>$<span class=" sub_total">0.00</span></td>
                                            </tr>
                                        <tr><td><span class="product">Shipping:</span></td>
                                            <td></td>
                                            <td></td>
                                            <td>$<span class="ship_price">0.00</span></td>
                                        </tr>
                                         <tr><td><strong>Grand Total:</strong> </td><td></td>
                                            <td>  </td>
                                            <td><strong>$<span class="totalPrice" id="totalPrice">0.00</span></strong></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div> <!-- /.table-stats -->
                        </div>
            <div class="card">
                <div class="card-header">
                    <strong>Payment Information:</strong>
                </div>
                    <div class="card-body card-block">
                        <div class="row form-group">
                          <div class="col col-md-4"><label for="select" class=" form-control-label">Payment Type:</label></div>
                                <div class="col-12 col-md-8">
                                <select name="CardType" id="cc_type_n" class="form-control select-fld">
                                    <option value="">Card Type</option>
                                    <option value="visa" {{ (collect(old('CardType'))->contains('visa')) ? 'selected':'' }}>Visa</option>
                                    <option value="master" {{ (collect(old('CardType'))->contains('master')) ? 'selected':'' }}>Master Card</option>
                                    <option value="discover" {{ (collect(old('CardType'))->contains('discover')) ? 'selected':'' }}>Discover</option>
                                </select>
                                @if ($errors->has('CardType'))
                                     @foreach ($errors->get('CardType') as $error)
                                        <span class="help-block formValidationError">{{ $error }}</span>
                                        @endforeach
                                    @endif
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-4"><label for="text-input" class=" form-control-label">Credit Card Number:</label></div>
                            <div class="col-12 col-md-8"><input type="tel" maxlength="16" id="CreditCard" name="CreditCard" class="form-control" value="{{ old('CreditCard') }}" onkeyup="javascript:this.value=this.value.replace(/[^0-9]/g,'');">
                            @if ($errors->has('CreditCard'))
                                     @foreach ($errors->get('CreditCard') as $error)
                                        <span class="help-block formValidationError">{{ $error }}</span>
                                        @endforeach
                                    @endif
                                </div>
                        </div>
                        <div class="row form-group">
                          <div class="col col-md-4"><label for="select" class=" form-control-label">Expiration Date:</label></div>
                                <div class="col-12 col-md-8">
                                    <div class="row">
                                    <div class="col-12 col-md-7">
                                <select name="ExpMonth" id="ExpMonth" class="form-control">
                                    <?php $months = \Helpers::get_months(); ?>
                                    <option value=""> Select Months</option>
                                    @foreach ($months  as $key=>$value)
                                    <option value="{{$key}}" {{ (collect(old('ExpMonth'))->contains($key)) ? 'selected':'' }}> ({{$key}}) {{$value}}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('ExpMonth'))
                                     @foreach ($errors->get('ExpMonth') as $error)
                                        <span class="help-block formValidationError">{{ $error }}</span>
                                        @endforeach
                                    @endif
                                    </div>
                                    <div class="col-12 col-md-5">
                                 <select name="ExpYear" id="ExpYear" class="form-control">
                                    <?php $year = \Helpers::get_years(); 
                                    for ($i = $year; $i < $year + 20; $i++) {
                                    $yr = substr( $i, -2 ); ?>
                                <option value="{{$yr}}" {{ (collect(old('ExpYear'))->contains($yr)) ? 'selected':'' }}>{{$i}}</option>
                            <?php } ?>
                                    
                                </select>
                                @if ($errors->has('ExpYear'))
                                     @foreach ($errors->get('ExpYear') as $error)
                                        <span class="help-block formValidationError">{{ $error }}</span>
                                        @endforeach
                                    @endif
                                    </div>
                                    </div>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-4"><label for="text-input" class=" form-control-label">CVV:</label></div>
                        <div class="col-12 col-md-8"><input type="tel" id="Cvv" value="{{ old('Cvv')}}" maxlength="4" name="Cvv" onkeyup="javascript:this.value=this.value.replace(/[^0-9]/g,'');" class="form-control">
                            @if ($errors->has('Cvv'))
                                     @foreach ($errors->get('Cvv') as $error)
                                        <span class="help-block formValidationError">{{ $error }}</span>
                                        @endforeach
                                    @endif
                                </div>
                        </div>
                        <button type="submit" class="btn btn-success btn-sm">
                                     Process Order
                                </button>
                    </div>
            </div>
        </div>
        
        </div>
        </form>
        </div>
        
    </div><!-- .content -->


    <div class="clearfix"></div>

    @include('common/footer')

</div><!-- /#right-panel -->

<!-- Right Panel -->

@include('common/scripts')

<script type="text/javascript">

    function ChangeCampaign(campaign){
        
        $('.pop_loader').show();
         $.ajax({
            type: 'POST',
            url: "{{route('campaignchange')}}",
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: 'campaign=' + campaign,
            dataType: "json",
            success: function(res) {
                if (res.errors =="yes") {
                    $('.pop_loader').hide();
                    $('.error-text').html(res.error_massage+', Please give the proper access to your API!');

                } else{
                $('.error-text').html('');
                $('.pop_loader').hide();
                $("#offer_id").html(res.offer_ids);
                $("#product_id").html(res.product_ids);
                $("#billing_model_id").html(res.billing_model_ids);
                $("#quantity").val('1');
                $("#shippingId").html(res.shipping_ids);
                $(".ship_price").html(res.ship_price);
                $("#totalPrice").html(res.ship_price);
                }
            }
        });
	}

     function Changeproduct(product){
        $('.pop_loader').show();
        var ship_price = parseFloat($(".ship_price").html()); 
         $.ajax({
            type: 'POST',
            url: "{{route('productchange')}}",
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: 'product=' + product,
            dataType: "json",
            success: function(res) {
                var totalPrice = parseFloat(res.pprice);
                $('.pop_loader').hide();
                $("#pname").html('('+res.product_id+') '+res.pname);
                $("#baseprice").html(res.pprice);
                $("#qty").html('1');
                $(".sub_total").html(res.pprice);
                $("#totalPrice").html(+(totalPrice+ship_price).toFixed(2));
            }
        });
    }
    
    function QtyChange(val){

        var baseprice = $("#baseprice").html(); 
        var total_price = baseprice*val;       
        var ship_price = parseFloat($(".ship_price").html());    
        $(".sub_total").html(+(baseprice*val).toFixed(2));
        $("#totalPrice").html(+(total_price+ship_price).toFixed(2));
        $('#qty').html(val);
    }
    $('#trialCheckbox').click(function(){
        if($(this). prop("checked") == true){
            $('.trial-value').show();
        }else{
             $('.trial-value').hide();
        }
    });
    
    function BillSameAsShip(params) {
        if (params == 'yes') {
            $('.BillingSameAsShipping').fadeOut();
        }
        else{
            $('.BillingSameAsShipping').fadeIn();
        }   
    }
    function ChangeShipping(shipping_id){
        $('.pop_loader').show();
        var baseprice = parseFloat($(".sub_total").html()); 
        console.log(baseprice);
         $.ajax({
            type: 'POST',
            url: "{{route('shippingChange')}}",
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: 'shipping_id=' + shipping_id,
            dataType: "json",
            success: function(res) {
                var ship_price = parseFloat(res.initial_amount);
                console.log(ship_price);
                $('.pop_loader').hide();
                $("#totalPrice").html(+(baseprice+ship_price).toFixed(2));
                $(".ship_price").html(res.initial_amount);
            }
        });
    }
    $('#affiliate_wrap').click(function(){
        $('.affiliate_wrap').toggle('slow');
    });

</script>
</body>
</html>
