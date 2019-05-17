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
            <div class="animated">

                <div class="card">
                    <div class="card-header">
                        <i class="mr-2 fa fa-align-justify"></i>
                        <strong class="card-title" v-if="headerText">Place Order</strong>
                    </div>
                    <div class="card-body">
                      <button type="button" class="btn btn-secondary mb-1" data-toggle="modal" data-target="#mediumModal">
                          Medium
                      </button>
            
                  </div>
              </div>

            <div class="modal fade" id="mediumModal" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="mediumModalLabel">Medium Modal</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>
                                There are three species of zebras: the plains zebra, the mountain zebra and the Grévy's zebra. The plains zebra
                                and the mountain zebra belong to the subgenus Hippotigris, but Grévy's zebra is the sole species of subgenus
                                Dolichohippus. The latter resembles an ass, to which it is closely related, while the former two are more
                                horse-like. All three belong to the genus Equus, along with other living equids.
                            </p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="button" class="btn btn-primary">Confirm</button>
                        </div>
                    </div>
                </div>
            </div>
     
        
        <!-- Place order form -->
        <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <strong>Campaign Information:</strong>
                </div>
                    <div class="card-body card-block">
                        <div class="row form-group">
                            <div class="col col-md-4"><label for="exampleInputName2" class="pr-1  form-control-label">Select Campaign:</label></div>
                        
                            <div class="col-12 col-md-8"><select class="form-control" name="campaig_id" >
                                <option>Select Campaign</option>
                                <?php array_walk($campaign_id, function ($campaign_id,$key) use ($campaign_name) { 
                                ?>
                                <option value="<?php echo $campaign_id; ?>"><?php echo '('.$campaign_id.') '. $campaign_name[$key];  ?></option> 
                                <?php
                                    });
                                    ?>
                            </select></div>
                        </div>
                    </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <strong>Product Info:</strong>
                </div>
                    <div class="card-body card-block">
                        <div class="row form-group">
                          <div class="col col-md-3">  <label for="exampleInputName2" class="pr-1  form-control-label">Offer:</label></div>
                           <div class="col-12 col-md-9"> 
                               <select class="form-control" name="campaig_id">
                                    <option>Select Offer:</option>
                                </select>
                           </div>
                        </div>
                        <div class="checkbox">
                            <label for="exampleInputName2" class="pr-1  form-control-label">Trial?</label>
                            <label for="checkbox" class="form-check-label ">
                                <input type="checkbox" id="trialProduct" name="trial" value="" class="form-check-input">
                            </label>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3"><label for="exampleInputName2" class="pr-1  form-control-label">Trial Product:</label></div>
                            <div class="col-12 col-md-9"><select class="form-control" name="product">
                                <option>Select product:</option>
                            </select></div>
                        </div>
                        <div class="row form-group">
                           <div class="col col-md-3"> <label for="exampleInputName2" class="pr-1  form-control-label">Trial Price:</label></div>
                           <div class="col-12 col-md-9"> <input type="text" id="trialPrice" name="trialPrice" class="form-control"></div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3"><label for="exampleInputName2" class="pr-1  form-control-label">Quantity:</label></div>
                           <div class="col-12 col-md-9"> <input type="text" id="trialQuantity" name="trialQuantity" class="form-control"></div>
                        </div>
                    </div>
            </div>
            <div class="card">
                <div class="card-header">
                                <strong>Shipping / Billing Information:</strong>
                </div>
                <div class="card-body card-block">
                    <form action="#" method="post" enctype="multipart/form-data" class="form-horizontal">
                    <div class="row form-group">
                        <div class="col col-md-3"><label for="text-input" class=" form-control-label">Shipping First Name:</label></div>
                                        <div class="col-12 col-md-9"><input type="text" id="ShippingFirstName" name="ShippingFirstName" class="form-control"><small class="form-text text-muted">This is a help text</small></div>
                        </div>
                                    <div class="row form-group">
                                        <div class="col col-md-3"><label for="text-input" class=" form-control-label">Shipping Last Name:</label></div>
                                        <div class="col-12 col-md-9"><input type="text" id="ShippingLastName" name="ShippingLastName" class="form-control"><small class="form-text text-muted">This is a help text</small></div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-3"><label for="text-input" class=" form-control-label">Shipping Address:</label></div>
                                        <div class="col-12 col-md-9"><input type="text" id="ShippingAddress" name="ShippingAddress" class="form-control"><small class="form-text text-muted">This is a help text</small></div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-3"><label for="text-input" class=" form-control-label">Shipping Address2:</label></div>
                                        <div class="col-12 col-md-9"><input type="text" id="ShippingAddress2" name="ShippingAddress2" class="form-control"><small class="form-text text-muted">This is a help text</small></div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-3"><label for="text-input" class=" form-control-label">Shipping City:</label></div>
                                        <div class="col-12 col-md-9"><input type="text" id="ShippingCity" name="ShippingCity" class="form-control"><small class="form-text text-muted">This is a help text</small></div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-3"><label for="text-input" class=" form-control-label">Shipping Zip Code:</label></div>
                                        <div class="col-12 col-md-9"><input type="tel" id="ShippingZipCode" name="ShippingZipCode" class="form-control"><small class="form-text text-muted">This is a help text</small></div>
                                    </div>
                        <div class="row form-group">
                                        <div class="col col-md-3"><label for="select" class=" form-control-label">Shipping Country:</label></div>
                                        <div class="col-12 col-md-9">
                                            <select name="select" id="select" class="form-control">
                                                <option value="0">select Country</option>
                                                <option value="1">Option #1</option>
                                                <option value="2">Option #2</option>
                                                <option value="3">Option #3</option>
                                            </select>
                                        </div>
                        </div>
                        <div class="row form-group">
                                        <div class="col col-md-3"><label for="select" class=" form-control-label">Shipping State:</label></div>
                                        <div class="col-12 col-md-9">
                                            <select name="select" id="select" class="form-control">
                                                <option value="0">select State</option>
                                                <option value="1">Option #1</option>
                                                <option value="2">Option #2</option>
                                                <option value="3">Option #3</option>
                                            </select>
                                        </div>
                        </div>
                                    <div class="row form-group">
                                        <div class="col col-md-3"><label for="text-input" class=" form-control-label">Phone:</label></div>
                                        <div class="col-12 col-md-9"><input type="tel" id="Phone" name="Phone" class="form-control"><small class="form-text text-muted">This is a help text</small></div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-3"><label for="email-input" class=" form-control-label">Email</label></div>
                                        <div class="col-12 col-md-9"><input type="email" id="Email" name="Email" class="form-control"><small class="help-block form-text">Please enter your email</small></div>
                                    </div>
                        <div class="row form-group">
                                        <div class="col col-md-10"><label class=" form-control-label">Is your billing address the same as this shipping address?</label></div>
                                        <div class="col col-md-2">
                                            <div class="form-check-inline form-check">
                                                <label for="inline-radio1" class="form-check-label ">
                                                    <input type="radio" id="inline-radio1" name="BillasShipp" value="yes" class="form-check-input">Yes
                                                </label>
                                                <label for="inline-radio2" class="form-check-label ">
                                                    <input type="radio" id="inline-radio2" name="BillasShipp" value="no" class="form-check-input">No
                                                </label>
                                            </div>
                                        </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <strong>Affiliate / Sub Affiliate:</strong>
                </div>
                    <div class="card-body card-block">
                        <div class="row form-group">
                          
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
                                            <th class="avatar">Product</th>
                                            <th>Base</th>
                                            <th>Qty</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td> #5469 </td>
                                            <td>  <span class="name">Louis Stanley</span> </td>
                                            <td> <span class="product">iMax</span> </td>
                                            <td><span class="count">231</span></td>
                                        </tr>
                                        <tr>
                                           
                                            <td> #5468 </td>
                                            <td>  <span class="name">Gregory Dixon</span> </td>
                                            <td> <span class="product">iPad</span> </td>
                                            <td><span class="count">250</span></td>
                                            
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
                          <div class="col col-md-3"><label for="select" class=" form-control-label">Payment Type:</label></div>
                                <div class="col-12 col-md-9">
                                <select name="select" id="select" class="form-control">
                                    <option>Card Type</option>
                                    <option value="visa">Visa</option>
                                    <option value="masterCard">Master Card</option>
                                </select>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3"><label for="text-input" class=" form-control-label">Credit Card Number:</label></div>
                            <div class="col-12 col-md-9"><input type="tel" id="CreditCard" name="CreditCard" class="form-control"><small class="form-text text-muted">This is a help text</small></div>
                        </div>
                        <div class="row form-group">
                          <div class="col col-md-3"><label for="select" class=" form-control-label">Expiration Date:</label></div>
                                <div class="col-12 col-md-9">
                                <select name="ExpMonth" id="ExpMonth" class="form-control">
                                    <option value="0">Month</option>
                                </select>
                                 <select name="ExpYear" id="ExpYear" class="form-control">
                                    <option value="0">year</option>
                                </select>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3"><label for="text-input" class=" form-control-label">CVV:</label></div>
                            <div class="col-12 col-md-9"><input type="tel" id="Cvv" name="Cvv" class="form-control"><small class="form-text text-muted">This is a help text</small></div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-sm">
                                     Process Order
                                </button>
                    </div>
            </div>
        </div>
        
        </div>
        </div>
        
    </div><!-- .content -->
    

    <div class="clearfix"></div>

    @include('common/footer')

</div><!-- /#right-panel -->

<!-- Right Panel -->

@include('common/scripts')

</body>
</html>
