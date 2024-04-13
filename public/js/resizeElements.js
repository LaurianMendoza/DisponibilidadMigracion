$(window).resize(function() {
    //aqui el codigo que se ejecutara cuando se redimencione la ventana
    var alto = $(window).height();
    var ancho = $(window).width();


    if (ancho > 1370) {
        $('.cont_datos').css('flex-direction', 'row')

        $('.datos_perfil').addClass('col-lg-8')
        $('.datos_perfil').removeClass('w-100')

        $('.foto_perfil').addClass('col-lg-4')
        $('.foto_perfil').removeClass('w-100')

        $('.logoUPV').attr('src','{{asset('logos/logoUPVblanco.png')}}')
        $('.logoUPV').css('width','170px')
        $('.logoUPV').css('height','40px')

    } else if (ancho < 1370) {
        $('.cont_datos').css('flex-direction', 'column')

        $('.datos_perfil').removeClass('col-lg-8')
        $('.datos_perfil').addClass('w-100')

        $('.foto_perfil').removeClass('col-lg-4')
        $('.foto_perfil').addClass('w-100')


        $('.logoUPV').attr('src','{{asset('logos/NewlogoUPVblanco.png')}}')
        $('.logoUPV').css('width','170px')
        $('.logoUPV').css('height','40px')
    }

    if (ancho < 900) {
        $('.titulo_Modulo').removeClass('text-xl')
        $('.titulo_Modulo').addClass('text-m')

        $('.flex-div-row').addClass('flex-div-col')
        $('.flex-div-col').removeClass('flex-div-row')
        $('.form-group').addClass('mb-3')
        $('.cont_referencias').addClass('mb-2')

        $('.btn_editRef').removeClass('w-15')
        $('.btn_editRef').addClass('w-90')

        $('.btn_saveRef').removeClass('w-15')
        $('.btn_saveRef').addClass('w-90')

    } else if (ancho > 900) {
        $('.titulo_Modulo').removeClass('text-m')
        $('.titulo_Modulo').addClass('text-xl')

        $('.flex-div-col').addClass('flex-div-row')
        $('.flex-div-row').removeClass('flex-div-col')
        $('.form-group').removeClass('mb-3')
        $('.cont_referencias').removeClass('mb-2')

        $('.btn_editRef').addClass('w-15')
        $('.btn_editRef').removeClass('w-70')

        $('.btn_saveRef').addClass('w-15')
        $('.btn_saveRef').removeClass('w-70')

    }

    if(ancho < 800){
        $('.ruta-mobile').css('display', 'flex')
        $('.ruta-pc').css('display', 'none')
    }else if(ancho > 800){
        $('.ruta-mobile').css('display', 'none')
        $('.ruta-pc').css('display', 'flex')
    }
})
