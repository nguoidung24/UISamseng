<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  </head>
  <body style="display: flex; justify-content: center;">

    <!--
      Adding the `tinymce-editor` element with various options set as attributes.
    -->
    <tinymce-editor
      api-key="lmy2o3rr661is2d2hfjxe5lns2u5lreh7uq134g8duxb5dzw"
      height="768"
      width="1122"
      menubar="file edit view insert format tools table help"
      plugins="preview importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media codesample table charmap pagebreak nonbreaking anchor insertdatetime advlist lists wordcount help charmap quickbars emoticons accordion"
      toolbar="undo redo | accordion accordionremove | blocks fontfamily fontsize | bold italic underline strikethrough | code | align numlist bullist | link image | table media | lineheight outdent indent| forecolor backcolor removeformat | charmap emoticons | code fullscreen preview | save print | pagebreak anchor codesample | ltr rtl"
      content_style=""
      >

      <!-- Adding some initial editor content -->
      &lt;p&gt;Welcome to the TinyMCE Web Component example!&lt;/p&gt;

    </tinymce-editor>

    <!--
      Sourcing the `tinymce-webcomponent` from jsDelivr,
      which sources TinyMCE from the Tiny Cloud.
    -->
    <script src="https://cdn.jsdelivr.net/npm/@tinymce/tinymce-webcomponent@2/dist/tinymce-webcomponent.min.js"></script>

  </body>
</html>
{{-- 


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>CKEditor 5 – Classic editor</title>
    <script src="https://cdn.ckeditor.com/ckeditor5/41.3.1/classic/ckeditor.js"></script>
</head>
<body>
    <h1>Classic editor</h1>
    <div id="editor">
        <p>This is some sample content.</p>
    </div>
    <script>
        ClassicEditor
            .create( document.querySelector( '#editor' ) )
            .catch( error => {
                console.error( error );
            } );
    </script>
</body>
</html> --}}
