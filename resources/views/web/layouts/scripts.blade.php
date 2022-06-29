

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script src="{{asset('vendors/ckeditor/ckeditor.js')}}" type="text/javascript"></script>

<script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<script src="{{asset('web/js/jquery-3.6.0.min.js')}}"></script>
<script src="{{asset('web/js/bootstrap.min.js')}}"></script>
<script src="{{asset('web/js/popper.min.js')}}"></script>
<script src="{{asset('web/js/slick.min.js')}}"></script>
<script src="{{asset('web/js/fontawesome.js')}}"></script>
<script src="{{asset('web/js/custom.js')}}"></script>
<script src="{{asset('web/js/intlTelInput.js')}}"></script>
<script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>






<script type="text/javascript">
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




$('#sports').change(function(){
    var sports_id= $(this).val();
    console.log(sports_id);
    $.ajax({
        type : 'POST',
        dataType : 'JSON',
        url: "{{route('register_team')}}",
        data: {sports_id:sports_id, _token:"{{csrf_token()}}"},
        success: function (response) {
            if (response.status == 1) {
                $("#register_team").remove();
                $(response.message).insertAfter("#sports_register_team");
            }
        }
    });
});
</script>


<script>
    // var input = document.querySelector("#phone");
    // window.intlTelInput(input, {
    //     utilsScript:"{{asset('web/js/utils.js')}}",
    // });
</script>
    <!-- <script type="text/javascript">
        var slider = document.getElementById("myRange");
        var output = document.getElementById("demoo");
        slider.oninput = function() {
            output.innerHTML = this.value;
        }
    </script> -->
    <!-- <script type="text/javascript">
        $('.hdr-menu').on('click', ' li', function() {
            $('.hdr-menu li.active').removeClass('active');
            $(this).addClass('active');
        });
    </script> -->
    <script src="{{asset('web/js/slick.min.js')}}"></script>
    <script type="text/javascript">
    $('.card-deck a').fancybox({
            caption : function( instance, item ) {
                return $(this).parent().find('.card-text').html();
            }
        });
</script>

    <script>

        jQuery(document).ready(function ($) {
            $('.laptop-slider').slick({
                slidesToShow: 1,
                slidesToScroll: 1,
                infinite: true,
                dots: false,
                arrows: false,
                speed: 1000,
                touchMove: false,
                responsive: [{
                    breakpoint: 769,
                    settings: {
                        arrows: false,
                        dots: true,
                        touchMove: true
                    }
                }]
            });


            $(document).on("click", ".smallnav img", function () {
                var di = $(this).data("index");
                $('.laptop-slider').slick('slickGoTo', di);

            });


        });




    </script>
    <script>
  

  // $(document).ready(function(){
  //   var description = CKEDITOR.replace( 'description' );
  //   description.on( 'change', function( evt ) {
  //       $("#description").text( evt.editor.getData())    
  //   });
  // })
  @if(Session::has('message'))
  toastr.options =
  {
    "closeButton" : true,
    "progressBar" : true,
    "debug": false,
    "positionClass": "toast-bottom-right",
  }
        toastr.success("{{ session('message') }}");
  @endif

  @if(Session::has('error'))
  toastr.options =
  {
    "closeButton" : true,
    "progressBar" : true,
    "debug": false,
    "positionClass": "toast-bottom-right",
  }
        toastr.error("{{ session('error') }}");
  @endif

  @if(Session::has('info'))
  toastr.options =
  {
    "closeButton" : true,
    "progressBar" : true,
    "debug": false,
    "positionClass": "toast-bottom-right",
  }
        toastr.info("{{ session('info') }}");
  @endif

  @if(Session::has('warning'))
  toastr.options =
  {
    "closeButton" : true,
    "progressBar" : true,
    "debug": false,
    "positionClass": "toast-bottom-right",
  }
        toastr.warning("{{ session('warning') }}");
  @endif
</script>
<script>
  AOS.init();
</script>
@yield('script')


