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
                                <strong class="card-title">Prospect List</strong>
                            </div>

                            <div class="table-stats order-table ov-h userListTable">
                                <table class="table ">
                                    <thead>
                                        <tr>
                                            <th class="serial">#</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Mobile</th>
                                            <th>Address</th>
                                            <th>Country</th>
                                            <th>State</th>
                                            <th>Created At</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(!empty($allProspects))
                                            @foreach ($allProspects['data'] as $prospectKey => $prospects)
                                                <tr>
                                                    <td class="serial">{{ $prospectKey+1 }}.</td>
                                                    <td> {{ $prospects['fname'].' '.$prospects['lname'] }} </td>
                                                    <td>  <span class="">{{ $prospects['email'] }}</span> </td>
                                                    <td> <span class="">{{ $prospects['mobile'] }}</span> </td>
                                                    <td><span class="">{{ $prospects['address'] }}</span></td>
                                                    <td><span class="">{{ $prospects['prospects_country']['name'] }}</span></td>
                                                    <td><span class="">{{ $prospects['prospects_state']['name'] }}</span></td>
                                                    <td><span class="">{{ $prospects['created_at'] }}</span></td>
                                                    <td>
                                                        <a class="btn btn-primary userListingAction" href="{{route('prospects.edit',$prospects['id'])}}" role="button" title="Edit Prospect">
                                                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                                        </a>
                                                        <a class="btn btn-info userListingAction" href="{{route('prospects.show',$prospects['id'])}}" role="button" title="View Prospect">
                                                            <i class="fa fa-eye" aria-hidden="true"></i>
                                                        </a>
                                                        <a class="btn btn-success userListingAction" href="#" role="button" title="Place Order">
                                                            <i class="fa fa-credit-card-alt" aria-hidden="true"></i>
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
                                    <?php if($allProspects['prev_page_url'] != '') { ?>
                                        <a class="btn prev" href="<?php echo $allProspects['prev_page_url'] ?>"> <i class="fa fa-arrow-left"></i> Back</a>
                                    <?php } ?>

                                    <?php if($allProspects['next_page_url'] != '') { ?>
                                        <a class="btn next" href="<?php echo $allProspects['next_page_url'] ?>"> <i class="fa fa-arrow-right"></i> Next</a>
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
                        <!-- <h5 class="modal-title alert alert-danger" id="staticModalLabel">Caution !!!
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </h5> -->
                    </div>
                    <div class="modal-body">
                        <div class="dragcontainer">
                            <form name="fileUploadForm" id="fileUploadForm" action="javascript:void(0);" method="post" enctype="multipart/form-data">
                                <input type="file" name="file" id="file">

                                <!-- Drag and Drop container-->
                                <div class="upload-area"  id="uploadfile">
                                    <h1>Drag and Drop file here<br/>Or<br/>Click to select file</h1>
                                </div>

                                <button type="submit" onclick="uploadCsvFile();" name="fileUploadBtn" id="fileUploadBtn">UPLOAD</button>
                            </form>
                        </div>
                    </div>
                    
                   
                    <!-- <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                        <button type="button" class="btn btn-primary" onclick="deleteUser();">Yes</button>
                    </div> -->
                </div>
            </div>
        </div>

        <div class="clearfix"></div>

        @include('common/footer')

    </div><!-- /#right-panel -->

@include('common/scripts')

<script type="text/javascript">
    
    var sendingFiles;

    $( document ).ready(function() {

        // preventing page from redirecting
        $("html").on("dragover", function(e) {
            e.preventDefault();
            e.stopPropagation();
            $("h1").text("Drag here");
        });

        $("html").on("drop", function(e) { e.preventDefault(); e.stopPropagation(); });

        // Drag enter
        $('.upload-area').on('dragenter', function (e) {
            e.stopPropagation();
            e.preventDefault();
            $("h1").text("Drop");
        });

        // Drag over
        $('.upload-area').on('dragover', function (e) {
            e.stopPropagation();
            e.preventDefault();
            $("h1").text("Drop");
        });

        // Drop
        $('.upload-area').on('drop', function (e) {
            e.stopPropagation();
            e.preventDefault();

            $("h1").text("Upload");

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
                var fd = new FormData();

                var files = $('#file')[0].files[0];

                fd.append('file',files);
                sendingFiles = fd;
            }*/
            var fd = new FormData();
            var files = $('#file')[0].files[0];

            fd.append('file',files);
            sendingFiles = fd;
        });
    });

    function uploadCsvFile()
    {
        $.ajax({
            url: "{{url('admin/uploadcsv')}}",
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'post',
            data: sendingFiles,
            contentType: false,
            processData: false,
            //dataType: 'json',
            success: function(response){
                console.log(response)
            }
        });
    }
</script>

</body>
</html>