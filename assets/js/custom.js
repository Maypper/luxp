( function( $ ) {
    var $swiperSelector = $('.basic-swiper');
    $swiperSelector.each(function(index) {
        var $this = $(this);
        $this.addClass('swiper-slider-' + index);
        var swiper = new Swiper('.swiper-slider-' + index, {
            direction: 'horizontal',
            loop: false,
            freeMode: false,
            spaceBetween: 10,
            breakpoints: {
                992: {
                    slidesPerView: 4
                },
                768: {
                    slidesPerView: 2
                },
                320: {
                    slidesPerView: 1.1
                }
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev'
            },
            scrollbar: {
                el: '.swiper-scrollbar',
                draggable: true,
                dragSize: '210'
            }
        });
    });
    $('.slider-4-slides').each(function(index) {
        var $this = $(this);
        $this.addClass('slider-4-slides-' + index);
        var swiper = new Swiper('.slider-4-slides-' + index, {
            direction: 'horizontal',
            loop: false,
            freeMode: false,
            spaceBetween: 10,
            breakpoints: {
                992: {
                    slidesPerView: 6,
                },
                320: {
                    slidesPerView: 1.4
                }
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev'
            },
            scrollbar: {
                el: '.swiper-scrollbar',
                draggable: true,
                dragSize: '210'
            }
        });
        swiper.on('slideChange', function(swiper_index) {
            var curr_slide_index = swiper_index.snapIndex;
            var curr_slide_el = swiper.slides[curr_slide_index];
            $('.slider-4-slides-' + index + ' .swiper-slide.hovered').removeClass('hovered');
            curr_slide_el.classList.add('hovered');
        });
    });
    $('.full-width-swiper').each(function(index) {
        var $this = $(this);
        $this.addClass('swiper-full-width-slider-' + index);

        var swiper = new Swiper('.swiper-full-width-slider-' + index, {
            direction: 'horizontal',
            loop: false,
            freeMode: false,
            spaceBetween: 0,
            slidesPerView: 1,
            pagination: {
                el: '.swiper-pagination',
                type: 'bullets',
                clickable: true,
            },
        });
    });
    $('.collection-slider').each(function(index) {
        var $this = $(this);
        $this.addClass('collection-slider-' + index);
        var swiper = new Swiper('.collection-slider-' + index, {
            direction: 'horizontal',
            loop: true,
            freeMode: false,
            spaceBetween: 0,
            slidesPerView: 1,
            crossFade: true,
            effect: 'fade',
            autoplay: {
                delay: 300,
                disableOnInteraction: false,
            },
        });
        swiper.autoplay.stop();
        $this.on('mouseenter', function () {
            swiper.autoplay.start();
        });
        $this.on('mouseleave', function () {
            swiper.autoplay.stop();
        });
    });
    $('.vertical-slider').each(function(index) {
        var $this = $(this);
        $this.addClass('vertical-slider-' + index);
        var swiper = new Swiper('.vertical-slider-' + index, {
            direction: 'horizontal',
            loop: false,
            freeMode: false,
            spaceBetween: 0,
            slidesPerView: 1,
        });
        $('.vertical-pagination span').on('click', function () {
            $('.vertical-pagination span.active').removeClass('active');
            var index = $(this).data('num');
            swiper.slideTo(index);
            $(this).addClass('active');
        })
    });
    var comment_slider = new Swiper('.comments-slider', {
        direction: 'horizontal',
        loop: false,
        freeMode: false,
        spaceBetween: 10,
        breakpoints: {
            992: {
                slidesPerView: 3
            },
            320: {
                grid: {
                    rows: 3,
                    fill: "row",
                },
                spaceBetween: 5,
            }
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev'
        },
        scrollbar: {
            el: '.swiper-scrollbar',
            draggable: true,
            dragSize: '210'
        }
    });
    $(document).ready(function () {
        $('video.custom-controls').click(function () {
            var $this = $(this);
            if ($this.hasClass('paused')) {
                $this.removeClass('paused');
                $(this).next().removeClass('paused');
                this.play();
            } else {
                $this.addClass('paused');
                $(this).next().addClass('paused');
                this.pause();
            }
        });
        $('.changeble-width-slides .swiper-slide').mouseover(function () {
            $('.changeble-width-slides .swiper-slide').removeClass('hovered');
            $(this).addClass('hovered');
        });
        $('.burger-menu').click(function (event) {
            event.preventDefault();
            $('.mobile-menu').addClass('opened');
        });
        $('.burger-close').click(function (event) {
            event.preventDefault();
            $('.mobile-menu').removeClass('opened');
        });
        $('.mobile-menu .menu > li.menu-item-has-children > a').click(function (event) {
           event.preventDefault();
           var $this = $(this);
           if ($this.hasClass('active')) {
               $this.removeClass('active');
               $this.next().slideUp();
           } else {
               $('.mobile-menu .menu > li.menu-item-has-children > a.active').removeClass('active');
               $('.mobile-menu .menu > li.menu-item-has-children .sub-menu').slideUp();
               $this.addClass('active');
               $this.next().slideDown();
           }
        });
        if ( ! String.prototype.getDecimals ) {
            String.prototype.getDecimals = function() {
                var num = this,
                    match = ('' + num).match(/(?:\.(\d+))?(?:[eE]([+-]?\d+))?$/);
                if ( ! match ) {
                    return 0;
                }
                return Math.max( 0, ( match[1] ? match[1].length : 0 ) - ( match[2] ? +match[2] : 0 ) );
            }
        }
        // Quantity "plus" and "minus" buttons
        $( document.body ).on( 'click', '.plus, .minus', function() {
            var $qty        = $( this ).closest( '.quantity' ).find( '.qty'),
                currentVal  = parseFloat( $qty.val() ),
                max         = parseFloat( $qty.attr( 'max' ) ),
                min         = parseFloat( $qty.attr( 'min' ) ),
                step        = $qty.attr( 'step' );

            // Format values
            if ( ! currentVal || currentVal === '' || currentVal === 'NaN' ) currentVal = 0;
            if ( max === '' || max === 'NaN' ) max = '';
            if ( min === '' || min === 'NaN' ) min = 0;
            if ( step === 'any' || step === '' || step === undefined || parseFloat( step ) === 'NaN' ) step = 1;

            // Change the value
            if ( $( this ).is( '.plus' ) ) {
                if ( max && ( currentVal >= max ) ) {
                    $qty.val( max );
                } else {
                    $qty.val( ( currentVal + parseFloat( step )).toFixed( step.getDecimals() ) );
                }
            } else {
                if ( min && ( currentVal <= min ) ) {
                    $qty.val( min );
                } else if ( currentVal > 0 ) {
                    $qty.val( ( currentVal - parseFloat( step )).toFixed( step.getDecimals() ) );
                }
            }

            // Trigger change event
            $qty.trigger( 'change' );
        });
        $('.open-comment-form').on('click', function (event) {
            event.preventDefault();
            $(this).addClass('hidden');
            $('.review-form-collapse').slideDown();s
        })
    });
}( jQuery ) );
