var UINestable = function () {

    var updateOutput = function (e) {
        var list = e.length ? e : $(e.target),

            output=window.JSON.stringify(list.nestable('serialize')); 
             
            $.get( "ajax/menu_order.php", { order:output } )
              .done(function( data ) {
                //alert( "Data Loaded: " + data );
              });
          
        
    };


    return {

        init: function () {

            $('#nestable_list_3').nestable({
                group: 1
            })
                .on('change', updateOutput);

            updateOutput($('#nestable_list_3'));


        }

    };

}();