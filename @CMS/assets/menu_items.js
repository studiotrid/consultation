$(document).ready(function(){
            var link=$('#link').val();
            if (link=='page'){
                $('#link_page').removeClass('dn');
                $('#link_post').addClass('dn');
                $('#link_custom').addClass('dn');
            }
            else if (link=='post'){
                $('#link_post').removeClass('dn');
                $('#link_page').addClass('dn');
                $('#link_custom').addClass('dn');
            }
            else {
                $('#link_custom').removeClass('dn');
                $('#link_page').addClass('dn');
                $('#link_post').addClass('dn');
            }
            
            $('#link').change(function(){
                var link=$(this).val();
                if (link=='page'){
                    $('#link_page').removeClass('dn');
                    $('#link_post').addClass('dn');
                    $('#link_custom').addClass('dn');
                }
                else if (link=='post'){
                    $('#link_post').removeClass('dn');
                    $('#link_page').addClass('dn');
                    $('#link_custom').addClass('dn');
                }
                else {
                    $('#link_custom').removeClass('dn');
                    $('#link_page').addClass('dn');
                    $('#link_post').addClass('dn');
                }
            });
            
            

         });
         
$('.remove').click(function(e){
    e.preventDefault();

   var link = $(this).attr("href");
    if(confirm("Are you sure?")){
        window.location = link;
    } 
});