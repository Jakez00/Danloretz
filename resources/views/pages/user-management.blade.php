@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

<?php
use Carbon\Carbon;
?>

@section('title','DanLoretz - UserManagement')

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'User Management'])
    <div class="row mt-4 mx-4">
        <div class="col-12">
            <div class="card mb-4 card-profile-bottom">
                <div class="card-header pb-0 ">
                    <h6>Users</h6>
                </div>
                <button type="button" class="btn btn-primary m-3 text-nowrap col-lg-1 col-md-2 col-sm-2" data-bs-toggle="modal" data-bs-target="#adduser"><i class="fas fa-plus-circle"></i> Add User</button>

                <div class="modal fade" id="adduser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add User</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="formadduser" action="user-management/add" method="POST">
                            @csrf
                            <div class="mb-3">
                                <input type="text" class="form-control" id="name" name="name" placeholder="name">
                            </div>
                            <div class="mb-3">
                                <input type="text" class="form-control" id="email" name="email" placeholder="Email Address">
                            </div>
                            <div class="mb-3">
                                <input type="password" class="form-control" id="pass1" name="pass1" placeholder="Password">
                            </div>
                            <div class="mb-3">
                                <input type="password" class="form-control" id="pass2" name="pass2" placeholder="Confirm Password">
                            </div>
                            <div class="mb-3">
                                <select class="form-control" name="role" id="role">
                                    <option value="">--Choose Role--</option>
                                    <option value="1">Super Admin</option>
                                    <option value="2">Admin</option>
                                </select>
                            </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" id="adduser">Add</button>
                        </div>
                        </div>
                    </div>
                </div>


                {{-- edit --}}
                <div class="modal fade" id="edituser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="formedituser" action="user-management/edit" method="POST">
                            @csrf
                            <input type="hidden" id="id" name="id">
                            <div class="mb-3">
                                <input type="text" class="form-control" id="ename" name="ename" placeholder="name">
                            </div>
                            <div class="mb-3">
                                <input type="text" class="form-control" id="eemail" name="eemail" placeholder="Email Address">
                            </div>
                            <div class="mb-3">
                                <select class="form-control" name="erole" id="erole">
                                    <option value="" disabled>--Choose Role--</option>
                                    <option value="1">Super Admin</option>
                                    <option value="2">Admin</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <input type="password" class="form-control" id="epass1" name="epass1" placeholder="Password">
                            </div>
                            <div class="mb-3">
                                <input type="password" class="form-control" id="epass2" name="epass2" placeholder="Confirm Password">
                            </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" id="edituser">Update</button>
                        </div>
                        </div>
                    </div>
                </div>



                
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0 table-hover">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No.</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Name</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Role
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Create Date</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                <tr>
                                    <input type="hidden" id="id" value="{{ $user->id }}">

                                   <td><p class="mx-3 text-sm font-weight-bold mb-0">{{ $loop->iteration }}</p></td>
                                   <td><p class="mx-3 text-sm font-weight-bold mb-0">{{ $user->firstname }} {{ $user->lastname }}</p></td>
                                   <td>
                                    <p class="text-sm font-weight-bold mb-0">
                                    @if ($user->role == 1)
                                        Super Admin
                                    @elseif($user->role == 2)
                                        Admin
                                    @endif</p>
                                    </td>
                                   <td class="text-center">
                                    <p class="text-sm font-weight-bold mb-0">{{ Carbon::parse($user->created_at)->format('F d Y') }}</p>
                                    </td>
                                   <td class="text-center">
                                    <a class="mx-3" type="submit" data-bs-toggle="modal" data-bs-target="#edituser" id="edit"><i class="fas fa-user-edit"></i></a>
                                    @if (session('user_id') !=  $user->id)
                                        <a class="" type="submit" id="delete"><i class="fas fa-trash"></i></a>
                                    @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="assets/js/usermanagement.js"></script>
@endsection



