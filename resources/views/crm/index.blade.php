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

        <div class="breadcrumbs" style="display: none;">
            <div class="breadcrumbs-inner">
                <div class="row m-0">
                    <div class="col-sm-12">
                        <div class="page-header float-right">
                            <div class="page-title">
                                <ol class="breadcrumb text-right">
                                    <li class="active">
                                    <a class="nav-link" href="{{route('crm.create')}}"><i class="fa fa-plus"></i> Add New CRM</a>
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="content">
            @include('common.message-show')
            <div class="animated fadeIn listingCls">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title">CRM Details</strong>
                            </div>
                            <div class="table-stats order-table ov-h">
                                <table class="table ">
                                    <thead>
                                        <tr>
                                            <th class="serial">#</th>
                                            <th class="avatar">Name</th>
                                            <th>Endpoint</th>
                                            <th>User</th>
                                            <th>Password</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                            @foreach ($crms as $key => $crm)
                                                
                                            <tr>
                                            <td class="serial">{{$key+1}}</td>
                                            <td class="avatar">{{$crm->api_name}}</td>
                                            <td> {{$crm->api_endpoint}} </td>
                                            <td>  <span class="name">{{$crm->api_username}}</span> </td>
                                            <td> <span class="product">{{$crm->api_password}}</span> </td>
                                            <td>
                                            <a class="badge badge-complete" href="{{route('crm.edit',$crm->id)}}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                            <span style="display:none;">
                                            <button class="badge badge-danger" onclick="if(confirm('Are you sure want to delete?')){
                                                event.preventDefault();
                                                document.getElementById('delete_form_{{$crm->id}}').submit();
                                                }else{
                                                event.preventDefault();
                                                }">Delete</button>
                                            <form style="display:none;" action="{{route('crm.destroy',$crm->id)}}" method="POST" id="delete_form_{{$crm->id}}">
                                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                                <input name="_method" type="hidden" value="DELETE">
                                                </span>
                                            </form>
                                            </td>
                                            </tr>
                                            @endforeach
                                        
                                       
                                    </tbody>
                                </table>
                            </div> <!-- /.table-stats -->
                        </div>
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
