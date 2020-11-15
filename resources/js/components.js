$(document).ready(function() {

    let inputs = [];
    let type;

    // Adicone os inputs em um array
    for (let index = 0; index < $('.input').length; index++) {
        inputs.push($('.input')[index]);
    };

    // Inputmask para gerar as mascáras 
    $('#cnpj').inputmask("99.999.999/9999-99");
    $('#cpf').inputmask('999.999.999-99');
    $('#cnpjC').inputmask("99.999.999/9999-99");
    $('#cep').inputmask("99999-999");

    // Efeito para campos que iniciam com valor
    inputs.forEach(input => {
        if ($(input).val().length > 0) {
            $(input).siblings().addClass('is-active-label');
            $(input).siblings().css('color', 'grey');
        }
    });

    animationInput();

    // Animação nos inputs
    function animationInput() {
        let textarea = $('#descricao');

        $('.input').focus(function() {
            if ($(this).parent().hasClass('is-invalid')) {
                $(this).siblings().css('color', 'red');
            } else {
                let id = $(this).attr('id');
                if (id == 'search') {
                    $(this).siblings().css('color', '#4285f4');
                    $(this).addClass('is-active-search');
                } else {
                    $(this).siblings().css('color', '#a8cf45');
                    $(this).addClass('is-active');
                }
            }

            if ($(this)[0] == textarea[0]) {
                $(this).siblings().addClass('is-active-tx');
            } else {
                $(this).siblings().addClass('is-active-label');
            }
        });

        // Animação nos inputs
        $('.input').focusout(function() {

            if ($(this).val() === "") {
                if ($(this)[0] == textarea[0]) {
                    $(this).siblings().removeClass('is-active-tx');
                } else {
                    $(this).siblings().removeClass('is-active-label');
                }
            }

            let id = $(this).attr('id');
            if (id == 'search') {
                $(this).removeClass('is-active-search');
            } else {
                $(this).removeClass('is-active');
            }

            if ($(this).parent().hasClass('is-invalid')) {
                $(this).siblings().css('color', 'red');
            } else {
                $(this).siblings().css('color', 'grey');
            }
        });
    }

    // Define o carousel
    let swiper = new Swiper('.swiper-container', {
        loop: true,
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        autoplay: {
            delay: 3500,
            disableOnInteraction: false,
        }
    });

    // Define os atributos dos campos do modal
    $('.user > .col').on('click', function() {
        let name = $(this).attr('data-name');
        let container = $('.label-float').first();
        let input = container.find('input');
        let label = container.find('label');
        let title = $('#modal-login-label');
        let inputHide = $('#type');
        let inputPassword = $('.senha');
        let inputCheck = $('.checkbox');
        if (name == 'representante') {
            title.html('Login do Representante');
            inputHide.val('representante');
            input.inputmask('999.999.999-99');
            input.attr('name', 'cpf');
            label.html('CPF');
            inputPassword.val('');
            inputCheck.prop('checked', false);
            input.val('');
            type = 'representante';
        } else {
            if (name == 'empresa') {
                inputHide.val('empresa');
                title.html('Login da Empresa');
                type = 'empresa';
            } else {
                inputHide.val('comerciante');
                title.html('Login do Comerciante');
                inputType.val('comerciante');
                type = 'comerciante';
            }
            input.inputmask('99.999.999/9999-99');
            input.attr('name', 'cnpj');
            label.html('CNPJ');
            inputPassword.val('');
            inputCheck.prop('checked', false);
            input.val('');
        }
    });

    // Controla o z-index dos modais
    $('#modal-selected').on({
        'show.bs.modal': function() {
            var idx = $('#modal-selected:visible').length;
            $(this).css('z-index', 1040 + (10 * idx));
        },
        'shown.bs.modal': function() {
            var idx = ($('#modal-selected:visible').length) - 1; // raise backdrop after animation.
            $('.modal-backdrop').not('.stacked')
                .css('z-index', 1039 + (10 * idx))
                .addClass('stacked');
        },
        'hidden.bs.modal': function() {
            if ($('#modal-selected:visible').length > 0) {
                // restore the modal-open class to the body element, so that scrolling works
                // properly after de-stacking a modal.
                setTimeout(function() {
                    $(document.body).addClass('modal-open');
                }, 0);
            }
        }
    });

    $('#valor').on('keypress', function(event) {
        return (moeda(this, '.', ',', event));
    })

    function moeda(a, e, r, t) {
        let n = "",
            h = j = 0,
            u = tamanho2 = 0,
            l = ajd2 = "",
            o = window.Event ? t.which : t.keyCode;
        if (13 == o || 8 == o)
            return !0;
        if (n = String.fromCharCode(o), -1 == "0123456789".indexOf(n))
            return !1;
        for (u = a.value.length,
            h = 0; h < u && ("0" == a.value.charAt(h) || a.value.charAt(h) == r); h++)
        ;
        for (l = ""; h < u; h++)
            -
            1 != "0123456789".indexOf(a.value.charAt(h)) && (l += a.value.charAt(h));
        if (l += n,
            0 == (u = l.length) && (a.value = ""),
            1 == u && (a.value = "0" + r + "0" + l),
            2 == u && (a.value = "0" + r + l),
            u > 2) {
            for (ajd2 = "",
                j = 0,
                h = u - 3; h >= 0; h--)
                3 == j && (ajd2 += e,
                    j = 0),
                ajd2 += l.charAt(h),
                j++;
            for (a.value = "",
                tamanho2 = ajd2.length,
                h = tamanho2 - 1; h >= 0; h--)
                a.value += ajd2.charAt(h);
            a.value += r + l.substr(u - 2, u)
        }
        return !1
    }
})