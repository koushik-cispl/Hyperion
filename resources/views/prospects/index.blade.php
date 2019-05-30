<!doctype html>
<html class="no-js" lang="">

<?php
$userRole = \Helpers::checkRolePermissions();
?>

<?php
if(isset($_GET['search']))
{
    $serachTerm = $_GET['search'];
}
else
{
    $serachTerm = '';
}

if(isset($_GET['page']))
{
    $pageCount = $_GET['page'] - 1;
    $resultCount = 50 * $pageCount;
}
else
{
    $resultCount = 0;
}

if(isset($_GET['sort']))
{
    $sortBy = $_GET['sort'];
}
else
{
    $sortBy = '';
}

if(isset($_GET['direction']))
{
    $directionBy = $_GET['direction'];
}
else
{
    $directionBy = '';
}

if (App::environment('local'))
{
    $env = "local";
}
else
{
    $env = "production";
}
?>

<head>
    @include('common/base')
</head>
<body>
    <!-- Left Panel -->
    @include('common/left-sidebar')
    <!-- Left Panel -->

    <!-- Right Panel -->
    <link href="{{asset('back_end/css/drag-style.css')}}" rel="stylesheet" type="text/css">
    <script src="{{asset('back_end/js/jquery-3.0.0.js')}}" type="text/javascript"></script>
    <!-- <script src="{{asset('back_end/js/script.js')}}" type="text/javascript"></script> -->

    <div id="right-panel" class="right-panel">

        <!-- Header-->
        @include('common/header')
        <!-- Header-->

        <div class="breadcrumbs">
            <div class="breadcrumbs-inner">
                <div class="row m-0">
                    <div class="col-sm-12">
                        <div class="page-header float-right">
                            <div class="page-title">
                                <ol class="breadcrumb text-right">
                                    <li class="active">
                                    <a class="nav-link" data-toggle="modal" data-target="#csvModal" href="javascript:void(0)"><i class="fa fa-plus"></i> Upload CSV file</a>
                                    <a class="nav-link" href="{{route('prospects.create')}}"><i class="fa fa-plus"></i> Create New Prospect</a>
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="content">
            @include('common/message-show')
            <div class="animated fadeIn listingCls">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title" style="margin-right: 10px;">Prospect List</strong>

                                <button data-toggle="modal" data-target="#deleteModal" id="deleteBtn" style="display: none;" type="button" class="btn btn-danger">Delete</button>

                                <form class="pull-right" autocomplete="off" name="prospectsSearch" id="prospectsSearch" action="{{ action('ProspectsController@searchProspect') }}" method="get">
                                    <input type="text" name="search" id="search" value="<?php echo $serachTerm; ?>" placeholder=" Search by name">
                                </form>
                            </div>

                            <div class="table-stats order-table ov-h userListTable">
                                <table class="table ">
                                    <thead>
                                        <tr>
                                            <th><input type="checkbox" name="bulkDelete" id="bulkDelete" value=""></th>
                                            <th class="serial">#</th>
                                            <th>@sortablelink('fname', 'Name')</th>
                                            <th>@sortablelink('address')</th>
                                            <th>@sortablelink('state')</th>
                                            <th>@sortablelink('city')</th>
                                            <th>Zip Code</th>
                                            <?php if($userRole == 1) { ?>
                                            <th>Created By</th>
                                            <?php } ?>
                                            <th>@sortablelink('created_at', 'Created At')</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(!empty($allProspects))
                                            @foreach ($allProspects['data'] as $prospectKey => $prospects)
                                                <tr>
                                                    <td><input type="checkbox" name="prospectCheckbox" id="prospect{{$prospects['id']}}" class="eachProspect" value="{{$prospects['id']}}"></td>
                                                    <td class="serial">{{ $prospectKey+1+$resultCount }}.</td>
                                                    <td> {{ $prospects['fname'].' '.$prospects['lname'] }} </td>
                                                    <td>{{ $prospects['address'] }}</td>
                                                    <td>{{ $prospects['state'] }}</td>
                                                    <td>{{ $prospects['city'] }}</td>
                                                    <td>{{ $prospects['zip_code'] }}</td>
                                                    <?php if($userRole == 1) { ?>
                                                    <td>{{ $prospects['prospect_created_user']['name'] }}</td>
                                                    <?php } ?>
                                                    <td>{{ $prospects['created_at'] }}</td>
                                                    <td class="action_icon_td">
                                                        <a class="btn btn-primary userListingAction" href="{{route('prospects.edit',$prospects['id'])}}" role="button" title="Edit Prospect">
                                                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                                        </a>
                                                        <a class="btn btn-info userListingAction" href="{{route('prospects.show',$prospects['id'])}}" role="button" title="View Prospect">
                                                            <i class="fa fa-eye" aria-hidden="true"></i>
                                                        </a>
                                                        <a class="btn btn-success userListingAction" href="{{url('/admin/select-campaign/'.$prospects['id'])}}" role="button" title="Place Order">
                                                            <i class="fa fa-cart-plus" aria-hidden="true"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div> <!-- /.table-stats -->

                            @if(!empty($allProspects))
                            <div class="next_prev">
                                <div class="col-md-12">
                                    <?php if($allProspects['prev_page_url'] != '') {

                                        $prev_page_url = $allProspects['prev_page_url'];

                                        if($serachTerm != '')
                                        {
                                            $prev_page_url = $prev_page_url.'&search='.$serachTerm;
                                        }
                                        if($directionBy != '' || $sortBy != '')
                                        {
                                            $prev_page_url = $prev_page_url.'&sort='.$sortBy.'&direction='.$directionBy;
                                        }
                                    ?>
                                        <a class="btn prev" href="<?php echo $prev_page_url; ?>"> <i class="fa fa-arrow-left"></i> Back</a>
                                    <?php } ?>

                                    <?php if($allProspects['next_page_url'] != '') {
                                        
                                        $next_page_url = $allProspects['next_page_url'];

                                        if($serachTerm != '')
                                        {
                                            $next_page_url = $next_page_url.'&search='.$serachTerm;
                                        }
                                        if($directionBy != '' || $sortBy != '')
                                        {
                                            $next_page_url = $next_page_url.'&sort='.$sortBy.'&direction='.$directionBy;
                                        }
                                    ?>
                                        <a class="btn next" href="<?php echo $next_page_url; ?>"> <i class="fa fa-arrow-right"></i> Next</a>
                                    <?php } ?>
                                </div>
                            </div>
                            @endif
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="csvModal" tabindex="-1" role="dialog" aria-labelledby="staticModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">
                            Upload or Drag File here
                        </h5>
                        <h5 class="modal-title alert alert-danger" id="errorTextH5" style="display: none;">
                            <p id="errorText"></p>
                            <button type="button" class="close close-test" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </h5>
                        <h5 class="modal-title alert alert-success" id="successTextH5" style="display: none;">
                            <p id="successText"></p>
                            <button type="button" class="close close-succes" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </h5>
                    </div>
                    <div class="modal-body">
                        <div class="dragcontainer model-test">
                            <form name="fileUploadForm" id="fileUploadForm" action="javascript:void(0);" method="post" enctype="multipart/form-data">
                                <input type="file" name="file" id="file">

                                <!-- Drag and Drop container-->
                                <div class="upload-area"  id="uploadfile">
                                    <h1>Drag and Drop file here Or Click to select file <span>(.CSV Format)</span></h1>
                                </div>

                                <div class="pop_loader pop_loader2" id="prospectLoader" style="display: none;">
                                    <div class="lds-roller lds-roller2"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
                                </div>
                                <button type="submit" onclick="uploadCsvFile();" name="fileUploadBtn" id="fileUploadBtn">UPLOAD</button>

                                <div id="waitingMessage" class="waitingMessage" style="display: none;"></div>

                                <div class="prgrsbar" id="prgrsbarDiv" style="display: none;">
                                    <div class="progress" style="display: block;">
                                        <div class="bar" id="barFileUpload"></div >
                                        <div class="percent" id="percentFileUpload">0%</div >
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="staticModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title alert alert-danger">
                            Delete Prospect !!!
                        </h5>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to delete the selected prospects ?</p>
                    </div>
                    <form name="deleteProspectForm" id="deleteProspectForm" method="post" action="{{ action('ProspectsController@deleteProspect') }}">
                        {{ csrf_field() }}
                        <input type="hidden" name="prospectIds" id="prospectIds" value="">
                    </form>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                        <button type="button" class="btn btn-primary" onclick="deleteProspects();">Yes</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="clearfix"></div>

        @include('common/footer')

    </div><!-- /#right-panel -->

@include('common/scripts')

<script type="text/javascript">

    var prospectValues = [];
    var allProspectValues = '';
            
    /*$("#bulkDelete").click(function () {
        $('input:checkbox').not(this).prop('checked', this.checked);
    });*/

    $('#bulkDelete').click(function(){
        if($(this).prop("checked")) {
            prospectValues = [];
            $(".eachProspect").prop("checked", true);
            $.each($("input[name='prospectCheckbox']:checked"), function(){
                prospectValues.push($(this).val());
            });
        } else {
            prospectValues = [];
            $(".eachProspect").prop("checked", false);
            $.each($("input[name='prospectCheckbox']:checked"), function(){
                prospectValues.push('');
            });
        }
        allProspectValues = prospectValues.join(",");
        checkDelete(allProspectValues);
    });

    $('.eachProspect').click(function() {
        if ($(this).is(':checked')) {
            prospectValues.push($(this).val());
        }
        else
        {
            prospectValues.splice($.inArray($(this).val(), prospectValues),1);
        }
        allProspectValues = prospectValues.join(",");
        checkDelete(allProspectValues);
    });

    function checkDelete(allProspectValues)
    {
        if(allProspectValues != '')
        {
            $("#deleteBtn").fadeIn('slow');
        }
        else
        {
            $("#deleteBtn").fadeOut('slow');
        }
    }

    function deleteProspects()
    {
        $("#prospectIds").val(allProspectValues);
        setTimeout(function(){ 
            $("#deleteProspectForm").submit();
        }, 200);
    }

    
    var sendingFiles;

    $( document ).ready(function() {

        // preventing page from redirecting
        $("html").on("dragover", function(e) {
            e.preventDefault();
            e.stopPropagation();
            $("h1").text("Drag your file here.");
        });

        $("html").on("drop", function(e) { e.preventDefault(); e.stopPropagation(); });

        // Drag enter
        $('.upload-area').on('dragenter', function (e) {
            e.stopPropagation();
            e.preventDefault();
            $("h1").text("Drop your file here.");
        });

        // Drag over
        $('.upload-area').on('dragover', function (e) {
            e.stopPropagation();
            e.preventDefault();
            $("h1").text("Drop your file here.");
        });

        // Drop
        $('.upload-area').on('drop', function (e) {
            e.stopPropagation();
            e.preventDefault();

            $("h1").text("Click on the upload button.");

            var file = e.originalEvent.dataTransfer.files;
            var fd = new FormData();

            fd.append('file', file[0]);
            sendingFiles = fd;
        });

        // Open file selector on div click
        $("#uploadfile").click(function(){
            $("#file").click();
        });

        // file selected
        $("#file").change(function(){

            /*var fileExtension = ['csv'];
            if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
                alert("Only '.csv' formats are allowed.");
            }
            else
            {
                
            }*/
            $("h1").text("Click on the upload button.");

            var fd = new FormData();
            var files = $('#file')[0].files[0];

            fd.append('file',files);
            sendingFiles = fd;
        });
    });

    function uploadCsvFile()
    {
        $("#prospectLoader").fadeIn('slow');
        $("#fileUploadBtn").addClass('disableBtn').prop("disabled", true).text("Uploading...");

        showCustomMessage();
        
        $.ajax({
            url: "{{url('admin/uploadcsv')}}",
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'post',
            data: sendingFiles,

            cache: false,
            contentType: false,
            processData: false,

            success: function(response)
            {
                $("#prospectLoader").fadeOut('slow');
                $("#fileUploadBtn").removeClass('disableBtn').prop("disabled", false).text("UPLOAD");
                
                var jsonData = $.parseJSON(response); 
                var status = jsonData.status;
                var message = jsonData.message;
                if(status == 0)
                {
                    $("#errorText").html(message);
                    $("#errorTextH5").fadeIn('slow');                    
                }
                else if(status == 1)
                {
                    $("#successText").html(message);
                    $("#successTextH5").fadeIn('slow');
                }
                $("#waitingMessage").html("").fadeOut('slow');
                setTimeout(function(){ 
                    location.reload();
                }, 3000);
            }
        });
    }

    function showCustomMessage()
    {
        var currentEnv = "{{ $env }}";
        if(currentEnv == 'local')
        {
            var firstMessageTimimg = 10000;
            var secondMessageTimimg = 20000;
            var thirdMessageTimimg = 40000;
            var fourthMessageTimimg = 50000;
        }
        else
        {
            var firstMessageTimimg = 20000;
            var secondMessageTimimg = 40000;
            var thirdMessageTimimg = 100000;
            var fourthMessageTimimg = 130000;
        }

        setTimeout(function(){ 
            $("#waitingMessage").html('Your uploaded file is being processed.').fadeIn('slow');
        }, firstMessageTimimg);
        setTimeout(function(){ 
            $("#waitingMessage").html('It seems your uploaded file contains large data. It will take some time to upload.').fadeIn('slow');
        }, secondMessageTimimg);
        setTimeout(function(){ 
            $("#waitingMessage").html("Please wait for a while. It's almost there.").fadeIn('slow');
        }, thirdMessageTimimg);
        setTimeout(function(){ 
            $("#waitingMessage").html("File is uploaded. It's syncing with the database. Please wait for a few more seconds.").fadeIn('slow');
        }, fourthMessageTimimg);
    }
</script>

</body>
</html>