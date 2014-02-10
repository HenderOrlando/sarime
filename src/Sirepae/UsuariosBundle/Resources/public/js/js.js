/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
var imagenes = {
    'slide5.jpg': 'slide1.jpg',
    'slide1.jpg': 'slide2.jpg',
    'slide2.jpg': 'slide3.jpg',
    'slide3.jpg': 'slide4.jpg',
    'slide4.jpg': 'slide5.jpg',
};

function backSlide(seg, id){
    if(typeof seg === 'undefined')
        seg = 5000;
    if(typeof id === 'undefined')
        $('.back-slide').each(function(){
            id = $(this);
            setTimeout(function(){
                backSlide(seg,id);
            },seg);
        });
    else{
        var img = $(id).find('img'),
            src = img.attr('src'),
            src_ = src.split('/'),
            ant = src_.pop();
        img.stop().animate({opacity:0},function(){
            src_[src_.length] = imagenes[ant];
            img.attr('src',src_.join('/')).stop().animate({opacity:1});
        });
    }
    setTimeout(function(){
        backSlide(seg,id);
    },seg);
        
}
$(function(){
    $('html').on('click','.btn-toggle', function(){
        $(this).toggleClass('active');
    });
    backSlide();
    $('input:not(:checkbox):not(:radio), textarea').addClass('form-control')
    $('table').addClass('table table-striped')
    $(':checkbox').each(function(){
        $(this).hide().siblings('label').first().addClass('btn btn-default btn-toggle');
        if($(this).is(':checked'))
            $(this).siblings('label').first().addClass('active');
    });
    $('button, :button').each(function(){
        if(!$(this).hasClass('btn-primary') && !$(this).hasClass('btn-success') && !$(this).hasClass('btn-info') && !$(this).hasClass('btn-warning') && !$(this).hasClass('btn-danger') && !$(this).hasClass('btn-link'))
            $(this).addClass('btn-default');
    }).addClass('btn btn-lg');
});