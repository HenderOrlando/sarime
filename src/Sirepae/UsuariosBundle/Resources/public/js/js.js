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
        var id = $(this).attr('id');
        if($(this).siblings('label').length > 1)
            $(this).hide().siblings('label[for='+id+']').first().addClass('btn btn-default btn-toggle');
        else
            $(this).hide().siblings('label').first().addClass('btn btn-default btn-toggle');
        if($(this).is(':checked'))
            if($(this).siblings('label').length > 1)
                $(this).siblings('label[for='+id+']').first().addClass('active');
            else
                $(this).siblings('label').first().addClass('active');
    });
    $('h1').addClass('title');
    $('button, :button').each(function(){
        if(!$(this).hasClass('btn-primary') && !$(this).hasClass('btn-success') && !$(this).hasClass('btn-info') && !$(this).hasClass('btn-warning') && !$(this).hasClass('btn-danger') && !$(this).hasClass('btn-link') && !$(this).hasClass('btn-default'))
            $(this).addClass('btn-default');
    }).addClass('btn btn-lg');
    $('.panel').each(function(){
        if(!$(this).hasClass('panel-primary') && !$(this).hasClass('panel-success') && !$(this).hasClass('panel-info') && !$(this).hasClass('panel-warning') && !$(this).hasClass('panel-danger') && !$(this).hasClass('panel-link') && !$(this).hasClass('panel-default'))
            $(this).addClass('panel-default');
    });
    $('body').on('click','a.list-group-item.ajax',function(e){
        e.preventDefault();
        var este = $(this),href = este.attr('href');
        $.ajax({
            type: "GET",
            url: href
        }).done(function(json){
            if(!json.error){
                if(json.clear)
                    este.removeClass('active').siblings('a').removeClass('active');
                if(json.add)
                    este.addClass('active');
                else
                    este.removeClass('active');
            }
        });
        return false;
    });
});