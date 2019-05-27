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

        <div class="breadcrumbs">
            <div class="breadcrumbs-inner">
                <div class="row m-0">
                    <div class="col-sm-12">
                        <div class="page-header float-right">
                            <div class="page-title">
                                <ol class="breadcrumb text-right">
                                    <li class="active">
                                    <a class="nav-link" href="{{url('/admin/new-user')}}"><i class="fa fa-plus"></i> Create New User</a>
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
                                <strong class="card-title">All Users</strong>
                            </div>

                            <div class="table-stats order-table ov-h userListTable">
                                <table class="table ">
                                    <thead>
                                        <tr>
                                            <th class="serial">#</th>
                                            <th class="avatar">Avatar</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Mobile</th>
                                            <th>Role</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(!empty($allUsers))
                                            @foreach ($allUsers['data'] as $userKey => $users)
                                                <tr>
                                                    <td class="serial">{{ $userKey+1 }}.</td>
                                                    <td class="avatar">
                                                        <div class="round-img">
                                                            @if($users['avatar'] != '')
                                                            <img class="rounded-circle" src="{{ URL::to('/admin_user_images/'.$users['avatar']) }}" alt="User Avatar">
                                                            @else
                                                            <img class="rounded-circle" src="{{asset('back_end/images/avatar/avatar.png')}}" alt="User Avatar">
                                                            @endif
                                                        </div>
                                                    </td>
                                                    <td> {{ $users['name'] }} </td>
                                                    <td>  <span class="">{{ $users['email'] }}</span> </td>
                                                    <td> <span class="">{{ $users['mobile'] }}</span> </td>
                                                    <td><span class="">{{ $users['user_roles']['name'] }}</span></td>
                                                    <td>
                                                        @if($users['status'] == 1)
                                                            <button type="button" class="btn btn-success btn-sm">Active</button>
                                                        @elseif($users['status'] == 2)
                                                            <button type="button" class="btn btn-danger btn-sm">Inactive</button>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <a class="btn btn-primary userListingAction" href="{{url('/admin/edit-user/'.$users['id'])}}" role="button">
                                                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                                        </a>
                                                        <a class="btn btn-info userListingAction" href="{{url('/admin/view-user/'.$users['id'])}}" role="button">
                                                            <i class="fa fa-eye" aria-hidden="true"></i>
                                                        </a>
                                                        <a class="btn btn-warning userListingAction" href="#" role="button" data-toggle="modal" data-target="#deleteModal" onclick="setUserDeleteId({{ $users['id'] }});">
                                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div> <!-- /.table-stats -->

                            @if(!empty($allUsers))
                            <div class="next_prev">
                                <div class="col-md-12">
                                    <?php if($allUsers['prev_page_url'] != '') { ?>
                                        <a class="btn prev" href="<?php echo $allUsers['prev_page_url'] ?>"> <i class="fa fa-arrow-left"></i> Back</a>
                                    <?php } ?>

                                    <?php if($allUsers['next_page_url'] != '') { ?>
                                        <a class="btn next" href="<?php echo $allUsers['next_page_url'] ?>"> <i class="fa fa-arrow-right"></i> Next</a>
                                    <?php } ?>
                                </div>
                            </div>
                            @endif
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="staticModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title alert alert-danger" id="staticModalLabel">Caution !!!
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </h5>
                    </div>
                    <div class="modal-body">
                        <p>
                           Are you sure you want to delete this user ?
                       </p>
                    </div>
                    <form name="deleteUserForm" id="deleteUserForm" method="post" action="{{ action('UserController@deleteUser') }}">
                        {{ csrf_field() }}
                        <input type="hidden" name="uId" id="uId" value="">
                    </form>
                   
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                        <button type="button" class="btn btn-primary" onclick="deleteUser();">Yes</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="clearfix"></div>

        @include('common/footer')

    </div><!-- /#right-panel -->

<!-- Right Panel -->

@include('common/scripts')

<script type="text/javascript">
    function setUserDeleteId(userId) {
        $("#uId").val(userId);
    }

    function deleteUser()
    {
        $("#deleteUserForm").submit();
    }
</script>

</body>
</html>
