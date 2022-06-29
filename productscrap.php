 else if ($slug == 'product') {
            $route_url = route('product_generator', $slug);
            $category= category::where("is_active",1)->where("is_deleted",0)->get();
            // $fabric= product_variation::where("is_active",1)->where("is_deleted",0)->where("type", "fabric")->get();
            $colour= product_variation::where("is_active",1)->where("is_deleted",0)->where("type", "colour")->get();
            $body = '<div id="productdiv" class="productdiv">
            <form class="productForm" id="generic-form" method="POST" enctype="multipart/form-data" action="'.$route_url.'">
                    <input type="hidden" name="_token" value="'.csrf_token().'">
                    <input type="hidden" name="record_id" id="record_id" value="">

                    <div class="row" id="row">
                        <div id="assignrole"></div>
                        
                        <div class="col-md-12 col-sm-6 col-12" id="rank-label">
                            <div class="form-group start-date">
                                <label for="category_id">Choose a Category:</label>
                                <div class="d-flex">
                                    <select name="categoryid" class="form-control" id="categoryid">
                                    <option selected="true" disabled="disabled">Select Category</option>';
                                    if ($category) {
                                        foreach($category as $key => $val){
                                            $body.='<option value="'.$val->id.'">'.$val->name.'</option>';
                                        }
                                    }
                                    $body.='</select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-6 col-12" id="rank-label">
                            <div class="form-group start-date">
                                <label for="start-date" class="">Product Name:</label>
                                <div class="d-flex">
                                    <input id="name" placeholder="Product Name" name="name" class="form-control" type="text" autocomplete="off" required="" required/>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-6" id="rank-label">
                            <div class="form-group start-date">
                                <label for="start-date" class="">Tag Price:</label>
                                <div class="d-flex">
                                    <input id="tagprice" placeholder="Tag Price" name="tagprice" class="form-control" type="text" autocomplete="off" required="" required/>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-6 im" id="rank-label">
                            <div class="form-group start-date">
                                <label for="start-date" class="">Tag Image:</label>
                                <div class="d-flex">
                                    <input type="file" id="picture" placeholder="Tag Image" name="picture" class="form-control" required="" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-6 col-12" id="role-label">
                            <div class="form-group end-date">
                                <label for="end-date" class="">Description:</label>
                                <div class="d-flex">
                                    <textarea id="description" required name="desc" class="form-control"  required="" required></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-6 col-12">
                        <span id="add" class="btn btn-outline-primary">Add</span>
                        </div>';
                        $body.='
                        <div class="col-md-12 col-sm-6 col-12" id="role-label">
                        <div class="row" id="var">
                        <div class="col-md-12 col-sm-6 col-12" id="role-label">
                        <div class="row" id="repeted">
                        <div class="col-md-2 col-sm-6 col-2 prc" id="rank-label">
                            <div class="form-group start-date">
                                <label for="start-date" class="">Price:</label>
                                <div class="d-flex">
                                    <input id="price" placeholder="Price" name="price[]" class="form-control" type="text" autocomplete="off" required="" required/>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-2 col-sm-6 col-2 stc" id="rank-label">
                            <div class="form-group start-date">
                                <label for="start-date" class="">Stock:</label>
                                <div class="d-flex">
                                    <input id="stock" placeholder="Stock" name="stock[]" class="form-control" type="text" autocomplete="off" required="" required/>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 col-4 sk" id="rank-label">
                            <div class="form-group start-date">
                                <label for="start-date" class="">SKU:</label>
                                <div class="d-flex">
                                    <input id="sku" placeholder="SKU" name="sku[]" class="form-control" type="text" autocomplete="off" required="" required/>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 col-4 im" id="rank-label">
                            <div class="form-group start-date">
                                <label for="start-date" class="">Image:</label>
                                <div class="d-flex">
                                    <input type="file" id="image" placeholder="Image" name="image[]" class="form-control" required="" required>
                                </div>
                            </div>
                        </div>
                        </div>
                        </div>
                        </div>
                        </div>
                    </div>
                </form>
                </div>';
            return $body;
        }







        <a class="btn btn-primary" href="'.$url.'">View List</a>








                    <!-- <div><img alt="slide" src="{{asset($product->picture)}}" data-index={{$key}} /></div> -->


                    <!-- <div class="selectors">
                    <table>
                        @foreach ($var as $key => $val)
                        <tr>
                            <td>{{ $type[$key]["type"]  }}</td>
                            <td>
                                <div class="input-group mb-3">
                                    {!!$val!!}
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                </div> -->

                {{--
                <div class="smallnav">
                    @foreach ($variation as $key => $v)
                        <div><img alt="slide" src="{{asset($v->image)}}" data-index={{$key}} /></div>
                    @endforeach
                </div>
                --}}





                {{--
                <div class="selectors">
                    <table>
                        @foreach ($var as $key => $val)
                        <tr>
                            <td>{{ $type[$key]["type"]  }}</td>
                            <td>
                                <div class="input-group mb-3">
                                    {!!$val!!}
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                </div>
                --}}