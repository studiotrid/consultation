    $('.audioModul').on('click',function(e){ 
            var audio = $(this).data('audio');
            window.open('https://coach.profesionalnaastrologija.com/audio/' + audio, 'name'); 
    });
    
    $('.cartModul').on('click',function(e){ 
            var cart = $(this).data('cart');
            window.open('https://coach.profesionalnaastrologija.com/images/' + cart, 'name'); 
    });

    $('.box').on('click',function(e){ 
            var tip = $(this).data('tip');
            document.location.href = '/type/' + tip + '/'; 
    });