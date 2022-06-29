public static function editck($t, $class, $desc, $slug )
    {
        $content = web_cms::where("slug",$slug)->orderBy('id','desc')->first();
        if (Auth::user() && Auth::user()->role_id ==1) {
            if ($content) {
                $body = '<span class="'.$class.'clickable" data-slug="'.$slug.'" data-class="'.$class.'" data-tag="'.$t.'">'.$content->desc.'</span>';
            } else{
                $body = '<span class="'.$class.'clickable" data-slug="'.$slug.'" data-class="'.$class.'" data-tag="'.$t.'"><'.$t.' class="'.$class.'"> '.$desc.' </'.$t.'></span>';
            }
        } else{
            if ($content) {
                $body = $content->desc;
            } else{
                $body = '<'. $t .' class="'.$class.'"> '.$desc.' </'. $t .'>';
            }
        }
        return $body;
    }




    ##################################


    <script src="{{asset('vendors/ckeditor/ckeditor.js')}}" type="text/javascript"></script>


    ############################


$(document).on("click", "#cms-generic", function(){
    $("#cms_form").submit();
})

$(document).on("click", ".clickable", function(){
    var element = $(this)
    var desc = $(this).html();
    var slug = $(this).data("slug");
    var clas = $(this).data("class");
    var tag = $(this).data("tag");
    $("#addcms").remove();
    $.ajax({
        type : 'POST',
        dataType : 'JSON',
        url: "{{route('modalform')}}",
        data: {desc:desc, slug:slug, class:clas, tag:tag, _token:"{{csrf_token()}}"},
        success: function (response) {
            if (response.status == 1) {
                $(response.message).insertAfter(element)
                $("#addcms").modal("show");
                var description = CKEDITOR.replace('description');
                description.on( 'change', function( evt ) {
                    $("#description").text( evt.editor.getData())    
                });
            }
        }
    });
});


##################



public function modalform(Request $request)
    {
        $desc = $_POST['desc'];
        $slug = $_POST['slug'];
        $class = $_POST['class'];
        $tag = $_POST['tag'];
        $body="";
        try{
            $route_url = route('cms_generator');
            $body .='<div id="addcms" class="modal fade" role="dialog">
                        <div class="modal-dialog text-left">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <form class="" id="cms_form" method="POST" action="'.$route_url.'">
                                        <div class="row">
                                            <input type="hidden" name="_token" value="'.csrf_token().'">
                                            <input type="hidden" name="tag" id="tag" value="'.$tag.'">
                                            <input type="hidden" name="class" id="class" value="'.$class.'">
                                            <input type="hidden" name="slug" id="slug" value="'.$slug.'">
                                            <div class="col-md-12 col-sm-6 col-12" id="role-label">
                                                <div class="form-group end-date">
                                                    <div class="d-flex">
                                                        <textarea id="description" required name="desc" class="form-control" required="">'.$desc.'</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button id="discard" class="btn btn-outline-primary" data-dismiss="modal">Close</button>
                                    <button id="cms-generic" type="submit" class="btn btn-primary">Create</button>
                                </div>
                            </div>
                        </div>
                    </div>';
            $status['message'] = $body;
            $status['status'] = 1;
            return json_encode($status);
        }catch(Exception $e) {
            $error = $e->getMessage();
            $status['message'] = $error;
            $status['status'] = 0;
            return json_encode($status);
        }
    }


    #################################



    public function cms_generator(Request $request)
    {
        $token_ignore = ['_token' => ''];
        $post_feilds = array_diff_key($_POST , $token_ignore);
        try {
            $cms = web_cms::where("slug",$_POST['slug'])->first();
            if ($cms) {
                $create = web_cms::where("slug" , $_POST['slug'])->update($post_feilds);
                $msg = "Record has been updated";
            }
            else{
                $create = web_cms::create($post_feilds);
                $msg = "Record has been updated";
            }
          return redirect()->back()->with('message', $msg);
        } catch(Exception $e) {
          $error = $e->getMessage();
          return redirect()->back()->with('error', "Error Code: ".$error);
        }
    }





    ###################






    <?php echo (html_entity_decode(Helper::editck('h2', '', 'BB Sports' ,'h2BB Sports')));?>



