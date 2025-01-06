let page = 1;

let map;

function policy() {
    function getCookie(name) {
        const value = `; ${document.cookie}`;
        const parts = value.split(`; ${name}=`);
        if (parts.length === 2) return parts.pop().split(';').shift();
    }

    if (!getCookie('policyAccepted')) {
        $('.policy').addClass('show').fadeIn(); // Показати банер
    }

    $('#accept').click(function () {
        const expires = new Date();
        expires.setFullYear(expires.getFullYear() + 1);
        document.cookie = `policyAccepted=true; expires=${expires.toUTCString()}; path=/`;
        $('.policy').fadeOut();
    });
    $('.policy__close, .reject').click(function () {
        $('.policy').fadeOut();
    });
}

async function initMap() {
    const { Map } = await google.maps.importLibrary("maps");
    const { AdvancedMarkerElement } = await google.maps.importLibrary("marker");

    // Встановлення центра карти за першою точкою
    const mapCenter = positionMaps[0];

    const map = new Map(document.getElementById("map"), {
        center: { lat: mapCenter.lat, lng: mapCenter.lng },
        zoom: 10, // Рівень збільшення
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

        // Створення інформаційного вікна
        const info = new google.maps.InfoWindow({
            content: position.text
        });

        // Завжди відкривати інформаційне вікно
        info.open(map, marker);

        // Додаткові події (опціонально, можна видалити якщо непотрібно)
        marker.addListener("mouseover", () => {
            info.open(map, marker);
        });

        marker.addListener("mouseout", () => {
            info.close(map, marker);
        });

        map.addListener("click", () => {
            info.close(map, marker);
        });
    });
}
function validateForm(form, func, noreset) {
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
                required: true
            },
            policy_terms: {
                required: true
            },
            company: {
                required: true
            },
            address: {
                required: true
            },
            state: {
                required: true
            },
            post: {
                required: true
            }

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
                required: "Dieses Feld ist erforderlich"
            },
            policy_terms: {
                required: "Sie müssen die Datenschutzerklärung akzeptieren"
            },
            company: {
                required: "Dieses Feld ist erforderlich"
            },
            address: {
                required: "Dieses Feld ist erforderlich"
            },
            state: {
                required: "Dieses Feld ist erforderlich"
            },
            post: {
                required: "Dieses Feld ist erforderlich"
            }
        },
        errorPlacement: function (error, element) {
            if (element.attr("type") === "checkbox") {
                error.insertBefore(element.closest(".form__checkbox").find("input"));
            } else {
                error.insertBefore(element);
            }
        },
        highlight: function (element) {
            $(element).addClass("error");
            $(element).closest(".form__input-wrap").addClass("error");
        },
        unhighlight: function (element) {
            $(element).removeClass("error");
            $(element).closest(".form__input-wrap").removeClass("error");
        },
        submitHandler: function () {
            func();
            noreset ? null : form[0].reset();
        }
    });
    // form.find('select').on('change', function () {
    //     $(this).valid();
    // });
};
function ajaxSend(form, funcSuccess, funcError) {
    let data = form.serialize();
    console.log(data);
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

function counter() {
    let price = $('[data-price]').data('price');
    $(document).on("click", ".form__button-count-minus", function () {
        const counter = $(".form__button-counter span ");
        let currentValue = parseInt(counter.text());

        console.log(1111);
        if (currentValue > 1) {
            let newValue = currentValue - 1;
            counter.text(newValue);
            $('input[name="count"]').val(newValue);
            $('.price span').text(newValue * price);
        }
    });

    $(document).on("click", ".form__button-count-plus", function () {
        console.log(2222);
        const counter = $(".form__button-counter span");
        let currentValue = parseInt(counter.text());
        let newValue = currentValue + 1;

        counter.text(newValue);
        $('input[name="count"]').val(newValue);
        $('.price span').text(newValue * price);
    });
}

function tab() {
    $(".tab__header-item").click(function () {
        $(".tab__header-item").removeClass("active").eq($(this).index()).addClass("active");
        $(".tab__content-item").hide().eq($(this).index()).fadeIn();
    }).eq(0).addClass("active");
}

function showSearch() {

    $(document).on('click', '.header__search-icon', function () {
        if (window.innerWidth <= 666) {
            $('.header__search-wrap').toggleClass('active');
            $(this).toggleClass('active');
        } else {
            $('.header__search-wrap').addClass('active');
            $(this).hide();
            $('.header').addClass('active')
        }
    });
    let searchInput = '.header__search input[name="search"]';
    $(document).on('keydown', searchInput, function () {
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
        $(searchInput).val('');

        $('.header__search-icon').show();
        if (window.innerWidth > 666) {
            $('.header__search-wrap').removeClass('active');
        }
        search();
    });
}

function menuOpen() {
    $(document).on('click', '.header__burger', function () {
        console.log(1111);
        $('.header__menu').toggleClass('active');
        $(this).toggleClass('header__burger-open');
        $('body').toggleClass('hidden');
    });
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
        }
    });
}

function resetModal() {}

function toogleModal(modal, btn) {
    if (!btn) {
        modal.show();
        $('body').addClass('hidden');
        console.log(1111);
        // return false;
    } else {
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
        $('.filter__form input[name="page"]').val(page);
        // $(this).hide()
        let form = $('.filter__form');
        ajaxSend(form, function (res) {
            console.log(111);
            $('.post__list ').append(res);
        }, function () {
            console.log(2222);
        });
    });
}

function accordion() {
    console.log(2223333);
    $(document).on('click', '.shop__header', function () {
        $('.shop__header').show();
        $(this).hide();
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


function frontSlider() {
    $('.shop__item-slider').each(function (index, element) {
        new Swiper(element, {
            slidesPerView: 3,
            spaceBetween: 10,
            navigation: {
                nextEl: $(element).find('.swiper-button-next'),
                prevEl: $(element).find('.swiper-button-prev')
            },
            pagination: {
                el: $(element).find('.swiper-pagination'),
                clickable: true
            }
        });
    });
}

function sliders() {

    const review = new Swiper('.review__slider', {
        slidesPerView: 4.2,
        spaceBetween: 40,
        // loop: true,
        // speed: 1000,
        // effect: 'slide',
        // autoplay: {
        //     delay: 2000,
        //     disableOnInteraction: false
        // },

        navigation: {
            nextEl: ".card__next",
            prevEl: ".card__prev"
        },
        breakpoints: {
            '0': {
                slidesPerView: 1,
                spaceBetween: 30
            },
            '667': {
                slidesPerView: 4.2,
                spaceBetween: 40
            }
        }

    });
}

function filterAjax() {
    page = 1;
    $('.filter__form input[name="page"]').val(page);
    let form = $('.filter__form');
    ajaxSend(form, function (res) {
        $('.post__list > *').remove();
        $('.post__list ').append(res);
    }, function () {
        console.log(2222);
    });
}

function filter() {
    $(document).on('click', '.filter__clear', function () {
        $('.filter__item input , .filter__item select').val('');
        $('.filter__item select').each(function () {
            $(this).prop('selectedIndex', 0);
        });
        $('.filter__item select').trigger('change');
    });
    $(document).on('submit', '.filter__form', function (e) {
        e.preventDefault();
        filterAjax();
    });
    $(document).on('change', '.filter__select select', function () {
        filterAjax();
    });

    let searchInput = '.filter__item input[name="search"]';
    $(document).on('keydown', searchInput, function () {
        clearTimeout($(this).data('timer'));
        let timer = setTimeout(function () {
            filterAjax();
        }, 500);
        $(this).data('timer', timer);
    });
}

function initSlider() {
    $('.card__block').each(function (index) {
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
                prevEl: `.${prevButtonClass}`
            }
        });
    });
}

function appendStar() {
    $('.card__star').each(function () {
        let star = $(this).data('star');
        for (let i = 0; i < star; i++) {
            $(this).prepend(`<div class="card__star-item"></div>`);
        }
    });
}

function partnersSlider() {
    const partners = new Swiper('.partners__slide', {
        slidesPerView: 7,
        spaceBetween: 100,

        lazy: {
            loadOnTransitionStart: true,
            loadPrevNext: true
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
                loop: true
            }
        }
    });
}
function changeMob() {
    if (window.innerWidth <= 666) {

        initSlider();
    } else {
        accordion();
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

function showMore() {
    // Перевірка кількості елементів при завантаженні
    $('.section__more').each(function () {
        const content = $(this).find('.section__form-content');
        const items = content.children();

        if (items.length > 1) {
            $(this).find('.section__more-btn').show();
        }
    });

    // Обробник кліку для кнопки
    $('.section__more-btn').on('click', function () {
        $(this).toggleClass('open');
        const content = $(this).closest('.section__more').find('.section__form-content');

        content.toggleClass('expanded');

        if (content.hasClass('expanded')) {
            $(this).text('Weniger Information');
        } else {
            $(this).text('Mehr Information');
        }
    });
}

function mask(){
    $('input[name="phone"]').on('input', function () {
        let val = $(this).val();
        if (!val.startsWith('+49')) {
            $(this).val('+49 ' + val.replace(/^\+?[0-9]*/, '')); // Retain only non-country code digits
        }
    }).mask('+49 000 00000000', {
        placeholder: "+49 000 00000000",
        clearIfNotMatch: true
    });
}


function addActiveInput(){
    $('.section__search-input input').on('focus', function() {
        $(this).closest('form').addClass('active');
    });

    $('.section__search-input input').on('blur', function() {
       $(this).closest('form').removeClass('active');
    });

    $('.form__input-wrap >  *').on('focus', function() {
        $(this).closest('.form__input-wrap').addClass('active');
    });

    $('.form__input-wrap >  *').on('blur', function() {
        $(this).closest('.form__input-wrap').removeClass('active');
    });


}

$(document).ready(function () {
    console.log(1234567654323456)
    $('select').select2({});
    policy();
    filter();
    mask();
    addActiveInput()
    let subsForm = $('.form__seminar');
    validateForm(subsForm, function () {
        ajaxSend(subsForm, function (res) {
            toogleModal($('.modal__thank'));
        }, function (error) {
            toogleModal($('.modal__thank'));
        });
    });
    let seminar = $('.form__seminar-full\n');
    validateForm(seminar, function () {
        ajaxSend(seminar, function (res) {
            window.location.href = `${res.data.redirect_url}`;
        }, function (error) {
        });
    });
    showMore();
    menuOpen();
    changeMob();
    frontSlider();
    tab();
    showSearch();
    loadMore();
    appendStar();
    partnersSlider();
    counter();
    sliders();
    if( $('#map').length > 0){
        initMap();
    }

    $(window).on('load scroll', checkCounters);
});

$(window).load(function () {});

$(window).resize(function () {});
$(window).scroll(function () {});
//# sourceMappingURL=index.js.map
