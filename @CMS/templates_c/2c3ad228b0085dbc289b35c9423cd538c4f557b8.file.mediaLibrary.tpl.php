<?php /* Smarty version Smarty-3.1.17, created on 2014-08-03 14:05:09
         compiled from "/home/denem/public_html/new/@CMS/templates/mediaLibrary.tpl" */ ?>
<?php /*%%SmartyHeaderCode:96410771053de25755cdc27-75264437%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2c3ad228b0085dbc289b35c9423cd538c4f557b8' => 
    array (
      0 => '/home/denem/public_html/new/@CMS/templates/mediaLibrary.tpl',
      1 => 1404995497,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '96410771053de25755cdc27-75264437',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.17',
  'unifunc' => 'content_53de2575630ba9_57317217',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53de2575630ba9_57317217')) {function content_53de2575630ba9_57317217($_smarty_tpl) {?>          <div class="col-md-12">
               <blockquote>
                  <p style="font-size:16px">File Upload widget with multiple file selection, drag&amp;drop support, progress bars and preview images for jQuery.<br>
                     Supports cross-domain, chunked and resumable file uploads and client-side image resizing.<br>
                     Works with any server-side platform (PHP, Python, Ruby on Rails, Java, Node.js, Go etc.) that supports standard HTML form file uploads.
                  </p>
               </blockquote>
               <br>
               <form id="fileupload" action="#" method="POST" enctype="multipart/form-data">
                  <!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
                  <div class="row fileupload-buttonbar">
                     <div class="col-lg-7">
                        <!-- The fileinput-button span is used to style the file input field as button -->
                        <span class="btn green fileinput-button">
                        <i class="icon-plus"></i>
                        <span>Add files...</span>
                        <input type="file" name="files[]" multiple>
                        </span>

                        <button type="reset" class="btn yellow cancel">
                        <i class="icon-ban-circle"></i>
                        <span>Cancel upload</span>
                        </button>
                        <button type="button" class="btn red delete">
                        <i class="icon-trash"></i>
                        <span>Delete</span>
                        </button>
                        <input type="checkbox" class="toggle">
                        <!-- The loading indicator is shown during file processing -->
                        <span class="fileupload-loading"></span>
                     </div>
                     <!-- The global progress information -->
                     <div class="col-lg-5 fileupload-progress fade">
                        <!-- The global progress bar -->
                        <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
                           <div class="progress-bar progress-bar-success" style="width:0%;"></div>
                        </div>
                        <!-- The extended global progress information -->
                        <div class="progress-extended">&nbsp;</div>
                     </div>
                  </div>
                  <!-- The table listing the files available for upload/download -->
                  <table role="presentation" class="table table-striped clearfix">
                     <tbody class="files"></tbody>
                  </table>
               </form>
               <div class="panel panel-success">
                  <div class="panel-heading">
                     <h3 class="panel-title">Limitations</h3>
                  </div>
                  <div class="panel-body">
                     <ul>
                        <li>The maximum file size for uploads is <strong>5 MB</strong>.</li>
                        <li>Only image files (<strong>JPG, GIF, PNG</strong>) are allowed.</li>
                  
                     </ul>
                  </div>
               </div>
            </div>


 <script id="template-upload" type="text/x-tmpl">
      {% for (var i=0, file; file=o.files[i]; i++) { %}
          <tr class="template-upload fade">
              <td>
                  <span class="preview"></span>
              </td>
              <td>
                  <p class="name">{%=file.name%}</p>
                  {% if (file.error) { %}
                      <div><span class="label label-danger">Error</span> {%=file.error%}</div>
                  {% } %}
              </td>
              <td>
                  <p class="size">{%=o.formatFileSize(file.size)%}</p>
                  {% if (!o.files.error) { %}
                      <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
                      <div class="progress-bar progress-bar-success" style="width:0%;"></div>
                      </div>
                  {% } %}
              </td>
              <td>
                  {% if (!o.files.error && !i && !o.options.autoUpload) { %}
                      <button class="btn blue start">
                          <i class="icon-upload"></i>
                          <span>Start</span>
                      </button>
                  {% } %}
                  {% if (!i) { %}
                      <button class="btn red cancel">
                          <i class="icon-ban-circle"></i>
                          <span>Cancel</span>
                      </button>
                  {% } %}
              </td>
          </tr>
      {% } %}
   </script>

   <script id="template-download" type="text/x-tmpl">
      {% for (var i=0, file; file=o.files[i]; i++) { %}
          <tr class="template-download fade">
              <td>
                  <span class="preview">
                      {% if (file.thumbnailUrl) { %}
                          <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" data-gallery><img src="{%=file.thumbnailUrl%}"></a>
                      {% } %}
                  </span>
              </td>
              <td>
                  <p class="name">
                      {% if (file.url) { %}
                          <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" {%=file.thumbnailUrl?'data-gallery':''%}>{%=file.name%}</a>
                      {% } else { %}
                          <span>{%=file.name%}</span>
                      {% } %}
                  </p>
                  {% if (file.error) { %}
                      <div><span class="label label-danger">Error</span> {%=file.error%}</div>
                  {% } %}
              </td>
              <td>
                  <span class="size">{%=o.formatFileSize(file.size)%}</span>
              </td>
              <td>
                  {% if (file.deleteUrl) { %}
                      <button class="btn red delete" data-type="{%=file.deleteType%}" data-url="{%=file.deleteUrl%}"{% if (file.deleteWithCredentials) { %} data-xhr-fields='{"withCredentials":true}'{% } %}>
                          <i class="icon-trash"></i>
                          <span>Delete</span>
                      </button>
                      <input type="checkbox" name="delete" value="1" class="toggle">
                  {% } else { %}
                      <button class="btn yellow cancel">
                          <i class="icon-ban-circle"></i>
                          <span>Cancel</span>
                      </button>
                  {% } %}
              </td>
          </tr>
      {% } %}
   </script>
<?php }} ?>
