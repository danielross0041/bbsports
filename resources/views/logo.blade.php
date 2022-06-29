@extends('layouts.main')

@section('content')

<main>

    <div class="container-fluid site-width">

        <!-- START: Breadcrumbs-->

        <div class="row">

            <div class="col-12 align-self-center">

                <div class="sub-header mt-3 py-3 align-self-center d-sm-flex w-100 rounded">

                    <div class="w-sm-100 mr-auto"><h4 class="mb-0">Logo</h4></div>



                    <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">

                        <li class="breadcrumb-item">Home</li>

                        <li class="breadcrumb-item">Dashboard</li>

                        <li class="breadcrumb-item active"><a href="#">Logo</a></li>

                    </ol>

                </div>

            </div>

        </div>

        <!-- END: Breadcrumbs-->

        <!-- START: Card Data-->

        <div class="row">

            <div class="col-12 mt-3">

                <div class="card">

                    <div class="card-header justify-content-between align-items-center flx-sec">

                        <h4 class="card-title">Logo</h4>

                        @if($mainLogo)

                        @php $path = $mainLogo->image; @endphp

                        @else

                        @php $path = "web/images/logo.png"; @endphp

                        @endif

                        <a href="#"><img src="{{asset($path)}}" width="100" alt="{{$user->name}}" class="img-fluid " id="blah"></a>

                        <form method="POST" action="{{route('change_logo')}}" enctype="multipart/form-data" id="form-image-upload">

                        @csrf

                        <input type="file" id="upload-img" name="pic_attach" style=""/> 

                        </form>

                    </div>

                    {{--
                    <div class="card-body">

                        <div class="table-responsive">

                            <table id="example" class="display table dataTable table-striped table-bordered">

                                <thead>

                                    <tr>

                                        <th>S. No</th>

                                        <th>Logo</th>

                                    </tr>

                                </thead>

                                    @foreach($logo as $key=>$val)

                                    <tr>

                                        <td>

                                            {{++$key}}

                                        </td>

                                        <td>

                                            <img style="width:80px;height:80px;" src="{{asset($val->image)}}">

                                        </td>

                                    </tr>

                                    @endforeach

                                <tfoot>

                                    <tr>

                                        <th>S. No</th>

                                        <th>Logo</th>

                                    </tr>

                                </tfoot>

                            </table>

                        </div>

                    </div>
                    --}}

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

<script>

    $('document').ready(function(){

        $('#blah').click(function(){ 

            $('#upload-img').trigger('click'); 

        });    

    });

    

    $("#upload-img").change(function(e) {

        var val = $(this).val();

        console.log(val);

        if (val.match(/(?:gif|jpg|png|bmp|jfif)$/)) {

            console.log("here");

            if (confirm('Do you really want to change logo?')) {

                $("#form-image-upload").submit();

            } else {

                alert('No image has been updated');

            }

        }

    });

    

    

</script>

@endsection

