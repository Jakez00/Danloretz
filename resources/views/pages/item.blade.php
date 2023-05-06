@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

<?php
use Carbon\Carbon;
use App\Http\Controllers\AESCipher;
$aes = new AESCipher;
?>


@section('title','DanLoretz - ITEM')
@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'ITEM'])
    <div class="container-fluid py-4 divbody">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4 card-profile-bottom">
                    <div class="card-header pb-0 text-center">
                        <h2>{{ $itemname }}</h2>
                    </div>
                    <button type="button" class="btn btn-primary m-3 text-nowrap col-lg-2 col-md-2 col-sm-2 bg-danger rounded-pill" data-bs-toggle="modal" data-bs-target="#additem"><i class="fas fa-plus-circle"></i> &nbsp;&nbsp;{{ $itemname }}</button>
    
                    <div class="modal fade" id="additem" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Add {{ $itemname }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form id="formadditem" action="itemcatergory/add" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Item name">
                                </div>
                                <div class="mb-3">
                                    <textarea type="text" class="form-control" id="description" name="description" placeholder="Description"></textarea>
                                </div>
                                <div class="mb-3">
                                    <input type="text" class="form-control" id="price" name="price" placeholder="Price" oninput="if(this.value < 0)this.value = 0">
                                </div>
                                <div class="mb-3">
                                    <input type="number" class="form-control" id="quantity" name="quantity" placeholder="Quantity" oninput="if(this.value < 0)this.value = 0">
                                </div>
                                <div class="mb-3">
                                    <input type="hidden" class="form-control" id="itemID" name="itemID" value="{{ $aes->encrypt($itemID) }}">
                                </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary" id="add">Add</button>
                            </div>
                            </div>
                        </div>
                    </div>
    
    
                    {{-- edit --}}
                    <div class="modal fade" id="edititem" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Edit {{ $itemname }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form id="formedititem">
                                    @csrf
                                    <input type="hidden" id="id" name="id">
                                    <div class="mb-3">
                                        <input type="text" class="form-control" id="ename" name="ename" placeholder="Item name">
                                    </div>
                                    <div class="mb-3">
                                        <textarea type="text" class="form-control" id="edescription" name="edescription" placeholder="Description"></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <input type="text" class="form-control" id="eprice" name="eprice" placeholder="Price" oninput="if(this.value < 0)this.value = 0">
                                    </div>
                                    <div class="mb-3">
                                        <input type="number" class="form-control" id="equantity" name="equantity" placeholder="Quantity" oninput="if(this.value < 0) this.value = 0">
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

                    {{-- addstock --}}
                    <div class="modal fade" id="addstock" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Add stock</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form id="formaddstock">
                                    @csrf
                                    <input type="hidden" id="id" name="id">
                                    <div class="mb-3">
                                        <input type="text" class="form-control" id="stockname" name="stockname" placeholder="Item name" readonly>
                                    </div>
                                    <div class="mb-3">
                                        <input type="number" class="form-control" id="stockquantity" name="stockquantity" placeholder="Quantity of stock to be added" oninput="if (this.value < 0) this.value = 0">
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary" id="addstock">Add</button>
                            </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0 table-hover">
                                <thead >
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No.</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Name</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Description</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2" style="text-align: right;!important">Quantity</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 " style="text-align: right;!important">Price</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 text-nowrap">Added by</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-nowrap">Create Date</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-nowrap">Add Stock</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($item as $items)
                                    <tr>
                                        <input type="hidden" id="id" value="{{ $aes->encrypt($items->id) }}">
    
                                       <td><p class="mx-3 text-sm font-weight-bold mb-0">{{ $loop->iteration }}</p></td>
                                       <td><p class="mx-3 text-sm font-weight-bold mb-0">{{ $items->item_name }}</p></td>
                                       <td><p class="mx-3 text-sm font-weight-bold mb-0">{{ $items->description }}</p></td>
                                       <td style="text-align: right;!important" class="text-sm font-weight-bold mb-0">{{ number_format($items->quantity) }}</td>
                                       <td style="text-align: right;!important" class="text-sm font-weight-bold mb-0">&#8369; {{ number_format($items->price,2) }}</td>
                                       <td class="text-sm font-weight-bold mb-0">{{ $items->username }}</td>
                                       <td class="text-center text-sm font-weight-bold mb-0">{{ Carbon::parse($items->created_at)->format('F d Y') }}</td>
                                       <td class="text-center">
                                        <a class="mx-3" type="submit" data-bs-toggle="modal" data-bs-target="#addstock" id="stock"><i class="fas fa-plus-circle"></i></a>
                                        </td>
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
    <script type="module" src="assets/js/item.js"></script>
@endsection
