let page = 1

let map;
async function initMap() {
    const { Map } = await google.maps.importLibrary("maps");
    const { AdvancedMarkerElement } = await google.maps.importLibrary("marker");

    map = new Map(document.getElementById("map"), {
        center: { lat: 40.730610, lng: -73.935242 },
        zoom: 6.8,
        linksControl: false,
        panControl: false,
        addressControl: false,
        zoomControl: true,
        fullscreenControl: false,
        enableCloseButton: false,
        mapId: 'adfaf13712c875c8'
    });

    positionMaps.forEach(position => {
        const customMarkerImg = document.createElement("img");
        customMarkerImg.src = mapIcon;
        const marker = new AdvancedMarkerElement({
            position: { lat: position.lat, lng: position.lng },
            map: map,
            content: customMarkerImg
        });
        const info = new google.maps.InfoWindow({
            content: position.text
        });
        google.maps.event.addListener(marker, "mouseover", () => {
            info.open(map, marker);
        });
        google.maps.event.addListener(marker, "click", () => {
            info.open(map, marker);
        });
        google.maps.event.addListener(map, "click", function (event) {
            info.close(map, marker);
        });
        google.maps.event.addListener(marker, "mouseout", () => {
            info.close(map, marker);
        });
    });
}
function validateForm(form, func, noreset){
    form.on("submit", function (e) {
        e.preventDefault();
    });
    $.validator.addMethod("goodMessage", function (value, element) {
        return this.optional(element) || /^[\sаА-яЯіІєЄїЇґҐa-zA-Z0-9._-]{2,100}$/i.test(value);
    }, "Ungültiger Name");

    $.validator.addMethod("goodEmail", function (value, element) {
        return this.optional(element) || /^([a-z0-9_-]+\.)*[a-z0-9_-]+@[a-z0-9_-]+(\.[a-z0-9_-]+)*\.[a-z]{2,62}$/i.test(value);
    }, "Falsche E-Mail");

    form.validate({
        rules: {
            name: {
                required: true

            },
            email: {
                required: true,
                goodEmail: true,
                email: true
            },
            phone: {
                required: true,
                goodEmail: true,
                email: true
            },

        },
        messages: {
            name: {
                required: "Dieses Feld ist erforderlich",
                email: "Ungültiger Name"
            },
            email: {
                required: "Dieses Feld ist erforderlich",
                email: "Falsche E-Mail"
            },
            phone: {
                required: "Dieses Feld ist erforderlich",
            },
        },
        submitHandler: function () {

            noreset ? null : form[0].reset();
        }
    });
    form.find('select').on('change', function () {
        $(this).valid();
    });
};
function ajaxSend(form, funcSuccess, funcError) {
    let data = form.serialize();
    console.log(data)
    $.ajax({
        url: '/wp-admin/admin-ajax.php',
        data: data,
        method: 'POST',
        success: function (res) {
            console.log('success ajax');
            funcSuccess(res);
        },
        error: function (error) {
            console.log('error ajax');
            funcError(error);
        },
        complete: function () {}
    });
}

function tab() {
    $(".tab__header-item").click(function () {
        $(".tab__header-item").removeClass("active").eq($(this).index()).addClass("active");
        $(".tab__content-item").hide().eq($(this).index()).fadeIn();
    }).eq(0).addClass("active");
}




function showSearch() {

    $(document).on('click','.header__search-icon',function (){
        $('.header__search-wrap').addClass('active')
        $(this).hide()
    })
    let searchInput = '.header__search input[name="search"]'
    $(document).on('keydown',searchInput , function () {
        clearTimeout($(this).data('timer'));
        let timer = setTimeout(function () {
            search();
        }, 500);
        $(this).data('timer', timer);
    });

    $(document).on('submit', '.header__search', function (e) {
        e.preventDefault();
        search();
    });

    $(document).on('click', '.header__search-clean', function () {
        $('.header__search').removeClass('focused');
        $(searchInput).val('')
        $('.header__search-wrap').removeClass('active')
        $('.header__search-icon').show()
        search();
    });
}





function menuOpen(){
    $(document).on('click','.header__burger', function (){
        console.log(1111)
        $('.header__menu').toggleClass('active')
        $(this).toggleClass('header__burger-open')
        $('body').toggleClass('hidden')
    })
}

function search() {
    let data = $('.header__search').serialize();
    let searchText = $('.header__search input[name="search"]').val();
    if (searchText.length < 1) {
        $('.header__search-result').hide();
        $('.header__search-clean').hide();

    } else {
        $('.header__search-result').show();
        $('.header__search-clean').show();
    }
    $.ajax({
        url: '/wp-admin/admin-ajax.php',
        data: data,
        method: 'POST',
        success: function (res) {
            console.log('success ajax');
            $('.header__search-result').html(res);
        },
        error: function (error) {
            console.log('error ajax');
        },
    });
}

function resetModal() {

}



function toogleModal(modal, btn ) {
    if(!btn){
        modal.show();
        $('body').addClass('hidden');
        return false;
    } else{
        btn.click(function () {
            button = $(this);
            modal.show();
            $('body').addClass('hidden');
            return false;
        });
    }

    $('.modal__close').click(function () {
        $(this).closest(modal).hide();
        $('body').removeClass('hidden');
        resetModal();
        return false;
    });
    $('.modal__btn-close').click(function () {
        $(this).closest(modal).hide();
        $('body').removeClass('hidden');
        resetModal();
        return false;
    });
    $(document).keydown(function (e) {
        if (e.keyCode === 27) {
            e.stopPropagation();
            resetModal();
            $('body').removeClass('hidden');
        }
    });
    modal.click(function (e) {
        if ($(e.target).closest('.modal__content').length == 0) {
            $(this).hide();
            resetModal();
            $('body').removeClass('hidden');
        }
    });
}


function loadMore() {
    $(document).on('click', '.load__more', function () {
        page++;
        $('.filter__form input[name="page"]').val(page)
        // $(this).hide()
        let form = $('.filter__form')
        ajaxSend(form,function (res){
            console.log(111)
            $('.post__list ').append(res)
        }, function (){
            console.log(2222)
        })
    });
}













function accordion() {
    console.log(2223333)
    $(document).on('click', '.shop__header', function () {
        $('.shop__header').show()
        $(this).hide()
        let wrap = $(this).closest('.shop__item');
        wrap.prevAll().removeClass('shop__open');
        wrap.nextAll().removeClass('shop__open');

        if (wrap.hasClass('shop__open')) {
            wrap.removeClass('shop__open');
        } else {
            wrap.addClass('shop__open');
        }
    });
}


// const shop = new Swiper('.shop__slider', {
//     slidesPerView: 1,
//     centeredSlides: false,
//     loop: true,
//     slideToClickedSlide: true,
//     spaceBetween: 20,
//     speed: 1000,
//     effect: 'slide',
//     autoplay: {
//         delay: 2000,
//         disableOnInteraction: false
//     },
//     navigation: {
//         nextEl: ".shop__next",
//         prevEl: ".shop__prev"
//     },
//     breakpoints: {
//         '0': {
//             slidesPerView: 2.2,
//             centeredSlides: true,
//             spaceBetween: 12
//         },
//         '667': {
//             slidesPerView: 5,
//             spaceBetween: 20,
//             centeredSlides: false
//         },
//     }
// });
// function initSliderShop () {
//     $('.shop__item-slider').each(function() {
//         new Swiper(this, {
//             slidesPerView: 4.5,
//             spaceBetween: 24,
//             // centeredSlides: false,
//             loop: true,
//         });
//     });
// }



function frontSlider(){
    $('.shop__item-slider').each(function (index, element) {
        new Swiper(element, {
            slidesPerView: 3,
            spaceBetween: 10,
            navigation: {
                nextEl: $(element).find('.swiper-button-next'),
                prevEl: $(element).find('.swiper-button-prev'),
            },
            pagination: {
                el: $(element).find('.swiper-pagination'),
                clickable: true,
            },
        });
    });
}

function filterAjax(){
    page = 1;
    $('.filter__form input[name="page"]').val(page)
    let form = $('.filter__form')
    ajaxSend(form,function (res){
        $('.post__list > *').remove()
        $('.post__list ').append(res)

    }, function (){
        console.log(2222)
    })
}

function filter(){
    $(document).on('click','.filter__clear', function (){
        $('.filter__item input , .filter__item select').val('')
        $('.filter__item select').each(function() {
            $(this).prop('selectedIndex', 0);
        });
        $('.filter__item select').trigger('change')
    })
    $(document).on('submit','.filter__form', function (e){
        e.preventDefault()
        filterAjax()
    })
    $(document).on('change','.filter__select select', function (){
        filterAjax()
    })




    let searchInput = '.filter__item input[name="search"]'
    $(document).on('keydown',searchInput , function () {
        clearTimeout($(this).data('timer'));
        let timer = setTimeout(function () {
            filterAjax()
        }, 500);
        $(this).data('timer', timer);
    });
}




function initSlider(){
    $('.card__block').each(function(index) {
        const sliderContainer = $(this);
        const slider = sliderContainer.find('.card__slider');

        // Create unique classes for each slider's navigation buttons
        const nextButtonClass = `card__next-${index}`;
        const prevButtonClass = `card__prev-${index}`;

        // Add these unique classes to the next and prev buttons
        sliderContainer.find('.card__next').addClass(nextButtonClass);
        sliderContainer.find('.card__prev').addClass(prevButtonClass);

        // Initialize Swiper with these unique classes for navigation
        new Swiper(slider[0], {
            slidesPerView: 1.06,
            spaceBetween: 8,
            effect: 'slide',
            navigation: {
                nextEl: `.${nextButtonClass}`,
                prevEl: `.${prevButtonClass}`,
            },
        });
    });
}

function appendStar(){
    $('.card__star').each(function (){
        let star  = $(this).data('star')
        for ( let i= 0; i < star; i++){
            $(this).prepend(`<div class="card__star-item"></div>`)
        }
    })
}


function partnersSlider(){
    const partners = new Swiper('.partners__slide', {
        slidesPerView: 7,
        spaceBetween: 100,

        lazy: {
            loadOnTransitionStart: true,
            loadPrevNext: true,
        },
        loop: true,
        speed: 1000,
        effect: 'slide',
        autoplay: {
            delay: 2000,
            disableOnInteraction: false
        },
        breakpoints: {
            '0': {
                slidesPerView: 2.5,
                centeredSlides: true,
                spaceBetween: 48
            },

            '667': {
                slidesPerView: 7,
                spaceBetween: 100,
                loop: true,
            }
        }
    });
}
function changeMob() {
    if (window.innerWidth <= 666) {


        initSlider()

    } else{
        accordion()
    }
}


// function addClassActive(){
//    $(document).on('click','.choose > *',function (){
//
//        $(this).addClass('active')
//        $(this).nextAll().removeClass('active')
//        $(this).nextAll().removeClass('active')
//    })
// }


function checkCounters() {
    const duration = 2000;
    function animateCounter($counter) {
        const target = parseInt($counter.attr('data-target'), 10);
        const start = 0;
        let startTime = null;

        const updateCount = function (timestamp) {
            if (!startTime) startTime = timestamp;
            const progress = timestamp - startTime;
            const currentValue = Math.min(Math.floor(progress / duration * target), target);

            $counter.text(currentValue);

            if (progress < duration) {
                requestAnimationFrame(updateCount);
            } else {
                $counter.text(target);
            }
        };

        requestAnimationFrame(updateCount);
    };

    function isElementInView(element) {
        const elementTop = $(element).offset().top;
        const elementBottom = elementTop + $(element).outerHeight();
        const viewportTop = $(window).scrollTop();
        const viewportBottom = viewportTop + $(window).height();
        return elementBottom > viewportTop && elementTop < viewportBottom;
    };

    $('.counter').each(function () {
        const $counter = $(this);
        if (isElementInView($counter) && !$counter.hasClass('animated')) {
            $counter.addClass('animated');
            animateCounter($counter);
        }
    });
};

function showMore(){

        $('.section__more-btn').on('click', function () {
            $(this).toggleClass('open')
            const content = $(this).closest('.section__more').find('.section__form-content');

            const items = content.children();

            if (items.length <= 2) {
                $(this).hide();
            }
            content.toggleClass('expanded');


            if (content.hasClass('expanded')) {
                $(this).text('Weniger Information');
            } else {
                $(this).text('Mehr Information');
            }
        });
}



$(document).ready(function () {
    $('select').select2({})
    filter()
    let subsForm = $('.form__seminar');
    validateForm(subsForm, function () {
        ajaxSend(subsForm, function (res) {
            toogleModal($('.modal__thank'))
        }, function (error) {
            toogleModal($('.modal__thank'))
        });
    });
    showMore()
    menuOpen()
    changeMob();
    frontSlider()
    tab();
    showSearch()
    loadMore()
    appendStar()
    partnersSlider()
    $(window).on('load scroll', checkCounters);
});

$(window).load(function () {});

$(window).resize(function () {});
$(window).scroll(function () {});
