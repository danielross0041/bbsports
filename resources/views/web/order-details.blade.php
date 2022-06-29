@extends('layouts.main')
 @section('content')
<main>
    <div class="container-fluid site-width">
        <!-- START: Breadcrumbs-->
        <div class="row">
            <div class="col-12 align-self-center">
                <div class="sub-header mt-3 py-3 align-self-center d-sm-flex w-100 rounded">
                    <div class="w-sm-100 mr-auto"><h4 class="mb-0">Order Inquiry</h4></div>

                    <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                        <li class="breadcrumb-item">Home</li>
                        <li class="breadcrumb-item">Dashboard</li>
                        <li class="breadcrumb-item active"><a href="#">Inquiry</a></li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- END: Breadcrumbs-->
        <!-- START: Card Data-->
        <div class="row">
            <div class="col-12 mt-3">
                <div class="card">
                    <div class="card-header justify-content-between align-items-center">
                        <h4 class="card-title">Order Inquiry</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example" class="display table dataTable table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>S. No</th>
                                        <th>Product</th>
                                        <th>Colour</th>
                                        <th>Size</th>
                                        <th>Quantity</th>
                                        <th>Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($orders_details)
                                    @foreach ($orders_details as $key => $orders)
                                    <?php
                                    $product = App\Models\product::where('id', $orders->product_id)->first();
                                    $colour = App\Models\colour::where('id',$orders->colour)->first();
                                    $size = App\Models\size::where('id',$orders->size)->first();
                                    ?>
                                        <tr>
                                            <td>{{++$key}}</td>
                                            <td>{{$product->name}}</td>
                                            @if($colour)
                                            <td>{{$colour->name}}</td>
                                            <td>{{$size->name}}</td>
                                            @else
                                            <td>-</td>
                                            <td>-</td>
                                            @endif
                                            <td>{{$orders->qty}}</td>
                                            <td>{{$orders->cost}}</td>
                                    @endforeach
                                    @endif
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>S. No</th>
                                        <th>Product</th>
                                        <th>Colour</th>
                                        <th>Size</th>
                                        <th>Quantity</th>
                                        <th>Amount</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END: Card DATA-->
    </div>
</main>

@endsection 
@section('css')
<style type="text/css"></style>
@endsection 
@section('js') 
@endsection
