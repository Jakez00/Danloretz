@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

<?php
use Carbon\Carbon;
use App\Http\Controllers\AESCipher;
$aes = new AESCipher;
?>


@section('title','DanLoretz - ITEM TYPE')
@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'ITEM TYPE'])
    <div class="container-fluid py-4 divbody">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4 card-profile-bottom">
                    <div class="card-header pb-0 ">
                        <h6>Users</h6>
                    </div>
                    <button type="button" class="btn btn-primary m-3 text-nowrap col-lg-2 col-md-2 col-sm-2 bg-danger rounded-pill" data-bs-toggle="modal" data-bs-target="#additem"><i class="fas fa-plus-circle"></i> &nbsp;&nbsp;ITEM TYPE</button>
    
                    <div class="modal fade" id="additem" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">ADD ITEM CATERGORY</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form id="formadditem" action="itemcatergory/add" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Type of Item">
                                </div>
                                <div class="mb-3">
                                    <textarea type="text" class="form-control" id="description" name="description" placeholder="Description"></textarea>
                                </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary" id="addtype">Add</button>
                            </div>
                            </div>
                        </div>
                    </div>
    
    
                    {{-- edit --}}
                    <div class="modal fade" id="edititem" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form id="formedititem">
                                    @csrf
                                    <input type="hidden" id="id" name="id">
                                    <div class="mb-3">
                                        <input type="text" class="form-control" id="ename" name="ename" placeholder="ITEMS">
                                    </div>
                                    <div class="mb-3">
                                        <textarea type="text" class="form-control" id="edescription" name="edescription" placeholder="Description"></textarea>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary" id="edititem">Update</button>
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
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 text-nowrap">Added by</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-nowrap">Create Date</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($itemtype as $item)
                                    <tr>
                                        <input type="hidden" id="id" value="{{ $aes->encrypt($item->id) }}">
    
                                       <td><p class="mx-3 text-sm font-weight-bold mb-0">{{ $loop->iteration }}</p></td>
                                       <td><p class="mx-3 text-sm font-weight-bold mb-0">{{ $item->itemtypename }}</p></td>
                                       <td class="text-sm font-weight-bold mb-0">{{ $item->description }}</td>
                                       <td class="text-sm font-weight-bold mb-0">{{ $item->username }}</td>
                                       <td class="text-center text-sm font-weight-bold mb-0">{{ Carbon::parse($item->created_at)->format('F d Y') }}</td>
                                       <td class="text-center">
                                        <a class="mx-3" type="submit" data-bs-toggle="modal" data-bs-target="#edititem" id="edit"><i class="fas fa-user-edit"></i></a>
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
    </div>
    <script type="module" src="assets/js/itemtype.js"></script>
@endsection
