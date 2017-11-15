<!-- SCRIPTS -->
<!-- JQuery -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js"
        integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh"
        crossorigin="anonymous"></script>

<!-- Modular Admin JS -->
<script src="{{ url('themes/modularadmin/js/vendor.js') }}"></script>

<!-- Bootstrap JS -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js"
        integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn"
        crossorigin="anonymous"></script>

<!-- Modular Admin JS -->
<script src="{{ url('themes/modularadmin/js/app.js') }}"></script>

<!-- Custom Text Editor -->
<script src="{{ url('vendor/tinymce/tinymce.min.js') }}"></script>
<!-- <script src="{{--{{ url('js/ckbasic/ckeditor.js') }}--}}"></script> -->

<!-- Hostel JS -->
<script src="{{ url('admin/js/custom.js') }}"></script>

<!-- Config Text Editor -->
<script>
    var stdEditorConfig = {
        'path_absolute': '{{ URL::to("/") }}/',
        'selector': 'textarea.tm_std',
        'plugins': [
            "advlist autolink lists link image charmap print preview hr anchor pagebreak",
            "searchreplace wordcount visualblocks visualchars code fullscreen",
            "insertdatetime media nonbreaking save table contextmenu directionality",
            "emoticons template paste textcolor colorpicker textpattern"
        ],
        toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
        relative_urls: false,
        file_browser_callback : function(field_name, url, type, win) {
            var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
            var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

            var cmsURL = stdEditorConfig.path_absolute + 'laravel-filemanager?field_name=' + field_name;
            if (type == 'image') {
                cmsURL = cmsURL + "&type=Images";
            } else {
                cmsURL = cmsURL + "&type=Files";
            }

            tinyMCE.activeEditor.windowManager.open({
                file : cmsURL,
                title : 'Filemanager',
                width : x * 0.8,
                height : y * 0.8,
                resizable : "yes",
                close_previous : "no"
            });
        }
    };
    tinymce.init(stdEditorConfig);

    var commentEditorConfig = {
        'path_absolute': '',
        'selector': 'textarea.tm_comment',
        'plugins': [
            "wordcount",
            "emoticons",
        ],
        'menu': "none",
    };
    tinymce.init(commentEditorConfig);
</script>

<!-- lfm JS -->
<script src="{{ url('vendor/laravel-filemanager/js/lfm.js') }}"></script>

@yield('scripts')
