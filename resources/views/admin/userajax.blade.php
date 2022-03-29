<table class="table table-hover">
    <thead class="text-danger">
        <th>S.#</th>
        <th>Name</th>
        <th>Image</th>
        <th>Location</th>
        <th>Role</th>
        <th>Action</th>
    </thead>
    <tbody>
        @php $counter = 1; @endphp
        @foreach($users as $sUser)
        <tr>
            <td>{{ $counter }}</td>
            <td>{{ ucwords($sUser->first_name." ".$sUser->last_name) }}</td>
            <td><img src="@if($sUser->profile_image){{ URL::to('public/images/userImages/'.$sUser->profile_image) }}
                        @else
                        {{ URL::to('public/images/userImages/no-user.png') }}
                        @endif" class="img-raised rounded-circle img-fluid" width="50px" height="50px"></td>
            <td>{{ $sUser->location }}</td>
            <td>{{ $sUser->role }}</td>
            <td>
                <a class="" title="View Profile"
                    data-toggle="modal" data-target="#myModal{{ $sUser->id }}">
                    <i class="fa fa-eye" aria-hidden="true"></i>
                </a> &nbsp;
                <div class="modal" id="myModal{{ $sUser->id }}" tabindex="-1" role="dialog">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content card card-profile">
                            <div class="card-avatar">
                                <a href="javascript:;">
                                    <img class="img" src="
                                      @if($sUser->profile_image)
                                        {{ URL::to('public/images/userImages/'.$sUser->profile_image) }}
                                      @else
                                        {{ URL::to('public/images/userImages/no-user.png') }}
                                      @endif" />
                                </a>
                            </div>
                            <div class="card-body">
                                <h6 class="card-category text-gray">{{ $sUser->role }}</h6>
                                <h4 class="card-title">{{ $sUser->name }}</h4>
                                <hr>
                                <div class="card-description row" style="color:black;">
                                    <div class="col-sm-6">
                                        Gender: {{ $sUser->gender }}<br>
                                        Birthday: {{ $sUser->birthday }}<br>
                                    </div>
                                    <div class="col-sm-6">
                                        Email: {{ $sUser->email }}<br>
                                        Phone: {{ $sUser->phone }}<br>
                                    </div>
                                    <div class="col-sm-12">
                                        Location: {{ $sUser->location }}<br>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-danger btn-round"
                                    data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>

                <a class="" title="Edit User" data-toggle="modal" data-target="#myEditModal{{ $sUser->id }}">
                    <i class="fa fa-pencil" aria-hidden="true"></i>
                </a> &nbsp;
                <div class="modal" id="myEditModal{{ $sUser->id }}" tabindex="-1" role="dialog">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <form action="{{ route('admin-edit-users') }}" method="post">
                                @csrf
                                <input type="text" value="{{ $sUser->id }}" name="id" hidden>
                                <div class="modal-header">
                                    <h5 class="modal-title">Edit User</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <i class="material-icons">clear</i>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group row">
                                        <label>User Role:</label>
                                        <select name="role_id" class="form-control">
                                            <option value="1" @if($sUser->role_id == 1) {{ 'selected' }}@endif>Admin</option>
                                            <option value="3"@if($sUser->role_id == 3) {{ 'selected' }}@endif>Manager</option>
                                            <option value="2"@if($sUser->role_id == 2) {{ 'selected' }}@endif>User</option>
                                        </select>
                                    </div>
                                    <div class="form-group row">
                                        <input type="text" class="col-sm-6 form-control" placeholder="Enter First Name"
                                            name="first_name" value="{{ $sUser->first_name }}" required>
                                        <input type="text" class="col-sm-6 form-control" placeholder="Enter Last Name"
                                            value="{{ $sUser->last_name }}" name="last_name" required>
                                    </div>
                                    <div class="form-group row">
                                        <input type="email" class="col-sm-6 form-control" placeholder="Email"
                                            name="email" value="{{ $sUser->email }}" disabled>
                                        <input type="text" class="col-sm-6 form-control" placeholder="Phone"
                                            value="{{ $sUser->phone }}" name="phone" required>
                                    </div>
                                    <div class="form-group row">
                                        <input type="date" class="col-sm-6 form-control" placeholder="Birthday"
                                            value="{{ $sUser->birthday }}" autocomplete="" name="birthday" required>
                                        <input type="text" class="col-sm-6 form-control" placeholder="Location"
                                            value="{{ $sUser->location }}" autocomplete="" name="location" required>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-warning btn-round">Edit
                                        User</button>
                                    <button type="button" class="btn btn-danger btn-round"
                                        data-dismiss="modal">Close</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <a class="" title="Delete User" data-toggle="modal" data-target="#myDeleteModal{{ $sUser->id }}">
                    <i class="fa fa-trash" aria-hidden="true"></i>
                </a>
                <div class="modal" id="myDeleteModal{{ $sUser->id }}" tabindex="-1" role="dialog">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <form action="{{ route('admin-edit-users') }}" method="post">
                                @csrf
                                <input type="text" value="{{ $sUser->id }}" name="id" hidden>
                                <div class="modal-header">
                                    <h5 class="modal-title">Delete User</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <i class="material-icons">clear</i>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    Are you sure you want to delete this user?
                                </div>
                                <div class="modal-footer">
                                    <a href="{{ route('admin-delete-users',['id'=>$sUser->id]) }}" type="button" class="btn btn-warning btn-round">Delete</a>
                                    <button type="button" class="btn btn-danger btn-round"
                                        data-dismiss="modal">Cancel</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </td>
        </tr>
        @php $counter++; @endphp
        @endforeach
    </tbody>
</table>