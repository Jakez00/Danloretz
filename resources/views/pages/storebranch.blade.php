@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

<?php
use Carbon\Carbon;
use App\Http\Controllers\AESCipher;
$aes = new AESCipher;
?>

@section('title','DanLoretz - Store Braches')

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Store Branches'])
    <div class="row mt-4 mx-4">
        <div class="col-12">
            <div class="card mb-4 card-profile-bottom">
                <div class="card-header pb-0 ">
                    <h6>Users</h6>
                </div>
                <button type="button" class="btn btn-primary m-3 text-nowrap col-lg-1 col-md-2 col-sm-2 bg-danger rounded-pill" data-bs-toggle="modal" data-bs-target="#addstore"><i class="fas fa-plus-circle"></i> &nbsp;&nbsp;STORE</button>

                <div class="modal fade" id="addstore" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add Store</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="formaddstore" action="storebranch/add" method="POST">
                            @csrf
                            <div class="mb-3">
                                <input type="text" class="form-control" id="name" name="name" placeholder="Name of Store">
                            </div>
                            <div class="mb-3">
                                <textarea type="text" class="form-control" id="description" name="description" placeholder="Description"></textarea>
                            </div>
                            <div class="mb-3">
                                <input type="text" class="form-control" id="location" name="location" placeholder="Location">
                            </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" id="addstore">Add</button>
                        </div>
                        </div>
                    </div>
                </div>


                {{-- edit --}}
                <div class="modal fade" id="editstore" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="formeditstore" action="storebranch/edit" method="POST">
                                @csrf
                                <input type="hidden" id="id" name="id">
                                <div class="mb-3">
                                    <input type="text" class="form-control" id="ename" name="ename" placeholder="Name of Store">
                                </div>
                                <div class="mb-3">
                                    <textarea type="text" class="form-control" id="edescription" name="edescription" placeholder="Description"></textarea>
                                </div>
                                <div class="mb-3">
                                    <input type="text" class="form-control" id="elocation" name="elocation" placeholder="Location">
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" id="editstore">Update</button>
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
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 ">Description</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Location</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 text-nowrap">Added by</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-nowrap">Create Date</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($stores as $store)
                                <tr>
                                    <input type="hidden" id="id" value="{{ $aes->encrypt($store->id) }}">


                                   <td><p class="mx-3 text-sm font-weight-bold mb-0">{{ $loop->iteration }}</p></td>
                                   <td><p class="mx-3 text-sm font-weight-bold mb-0">{{ $store->storename }}</p></td>
                                   <td class="text-sm font-weight-bold mb-0">{{ $store->description }}</td>
                                   <td class="text-sm font-weight-bold mb-0">{{ $store->location }}</td>
                                   <td class="text-sm font-weight-bold mb-0">{{ $store->username }}</td>
                                   <td class="text-center text-sm font-weight-bold mb-0">{{ Carbon::parse($store->created_at)->format('F d Y') }}</td>
                                   <td class="text-center">
                                    <a class="mx-3" type="submit" data-bs-toggle="modal" data-bs-target="#editstore" id="edit"><i class="fas fa-user-edit"></i></a>
                                    <a class="" type="submit" id="delete"><i class="fas fa-trash"></i></a>
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
    <script src="assets/js/store.js"></script>
@endsection



