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
    $(':checkbox,:radio').each(function(){
        var id = $(this).attr('id');
//        if($(this).siblings('label').length >= 1){
            $(this).parent().addClass('btn-group').attr('data-toggle','buttons');
            var l = $(this).hide().siblings('label[for='+id+']').first().addClass('btn btn-default').append($(this));
            if($(this).is(':checked')){
                l.addClass('active');
            }
//        }
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
    $("select:not(.hide)").select2();
    $('input.datetime, input.time, input.date').each(function(){
        var datos_datetimepicker = {
            language    :  'es'
        }, format = "YYYY-MM-DD HH:mm";
        if($(this).hasClass('time')){
            format = "HH:mm"
            datos_datetimepicker.pickDate = false;
        }else if($(this).hasClass('date')){
            format = "YYYY-MM-DD"
            datos_datetimepicker.pickTime = false;
        }
        console.log($(this).val())
        console.log($(this).val().length)
        if($(this).val().length > 1){
            datos_datetimepicker.defaultDate = moment($(this).val(), format);
        }else{
            datos_datetimepicker.defaultDate = moment().format();
        }
        $(this).datetimepicker(datos_datetimepicker);
    });
    
    $('body').on('click','a.list-group-item.ajax',function(e){
        e.preventDefault();
        var este = $(this),href = este.attr('href');
        $.ajax({
            type: "GET",
            url: href
        }).done(function(json){
            if(!json.error){
                if(json.clear){
                    este.removeClass('active').siblings('a').removeClass('active');
                }
                var n = 0;
                if(json.add){
                    este.addClass('active');
                    n = 1;
                }
                else{
                    este.removeClass('active');
                    n = -1;
                }
                var t = parseInt(este.parents('.panel-primary').find('.total-definidos').text()), 
                    id = este.attr('id');
                este.parents('.panel-primary').find('.total-definidos').text(t+n);
                if(typeof id !== 'undefined' && id !== false){
                    id = id.replace('link-','');
                    t = parseInt($('#num-'+id+'-diagnostico').text());
                    $('#num-'+id+'-diagnostico').text(t+n);
                }
            }
        });
        return false;
    });
    $('.moment-date').each(function(){
        moment().lang('es');
        var text_ = $(this).text();
        $(this).text(moment(text_).fromNow());
        $(this).attr('title',moment(text_).calendar());
    });
});