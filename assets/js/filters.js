( function( $ ) {
    $(document).ready(function () {
        $('.filter-select span').on('click', function (e) {
            var $this = $(this).parent();
            if ($this.hasClass('active')) {
                $this.removeClass('active');
                $this.children('.filter-select__choices').slideUp();
            } else {
                $('.filter-select.active').children('.filter-select__choices').slideUp();
                $('.filter-select.active').removeClass('active');
                $this.children('.filter-select__choices').slideDown({
                    start: function () {
                        $(this).css({
                            display: "flex"
                        })
                    }
                });
                $this.addClass('active');
            }
        });
        $('.products__filter--labels').on('click', 'span', function () {
            var label_value = $(this).text();
            if ($(this).hasClass('price-span')) {
                $("input[data-val='"+label_value+"']").trigger('click');
            } else {
                $("input[value='"+label_value+"']").trigger('click');
            }
        });


        var button = $( '#loadmore .loadmore-btn' );
        var paged = button.data( 'paged' );
        $('.filter-select .filter-select__choices label input').change(function () {
            var form_data = {
                gender: $("input:checked[name='gender[]']")
                    .map(function(){
                        return $(this).val();
                    }).get(),
                collections: $("input:checked[name='collections[]']")
                    .map(function(){
                        return $(this).val();
                    }).get(),
                price: $("input:checked[name='filt_price[]']")
                    .map(function(){
                        return $(this).val();
                    }).get(),
                instock: $("input:checked[name='in-stock[]']")
                    .map(function(){
                        return $(this).val();
                    }).get(),
                sort: $("input:checked[name='sort']").val(),
            };
            if ($(this).hasClass('price-checkbox')) {
                if(this.checked) {
                    $('.products__filter--labels').append('<span class="price-span">'+ $(this).data('val') +'</span>');
                } else {
                    $('.products__filter--labels span:contains("'+ $(this).data('val') +'")').remove();
                }
            } else if ($(this).hasClass('sort-radio')) {
                if(this.checked) {
                    $('.products__filter--labels span.sort-span').remove();
                    $('.products__filter--labels').append('<span class="sort-span">'+ $(this).val() +'</span>');
                } else {
                    $('.products__filter--labels span:contains("'+ $(this).data('val') +'")').remove();
                }
            } else {
                if(this.checked) {
                    $('.products__filter--labels').append('<span>'+ $(this).val() +'</span>');
                } else {
                    $('.products__filter--labels span:contains("'+ $(this).val() +'")').remove();
                }
            }
            $.ajax({
                type : "post",
                url : myAjax.ajaxurl,
                data : {
                    action: "product_filter",
                    form_data: form_data,
                },
                success: function(response) {
                    $('.products__wrapper').html('');
                    $('.products__wrapper').append(response);
                    button.show();
                    paged = button.data( 'paged' );

                }
            })
        });
        if (button !== null && typeof button !== 'undefined' && button.length !== 0) {
            $(window).scroll(function(){
                var bottomOffset = $(document).height() - button.offset().top - button.height(),
                    maxPages = button.data( 'max_pages' ),
                    form_data = {
                        gender: $("input:checked[name='gender[]']")
                            .map(function(){
                                return $(this).val();
                            }).get(),
                        collections: $("input:checked[name='collections[]']")
                            .map(function(){
                                return $(this).val();
                            }).get(),
                        price: $("input:checked[name='filt_price[]']")
                            .map(function(){
                                return $(this).val();
                            }).get(),
                        instock: $("input:checked[name='in-stock[]']")
                            .map(function(){
                                return $(this).val();
                            }).get(),
                        sort: $("input:checked[name='sort']").val(),
                    };
                if( $(document).scrollTop() > ($(document).height() - bottomOffset - $(window).height()) && !$('body').hasClass('loading') && paged < maxPages){
                    console.log('123');
                    $.ajax({
                        type : 'POST',
                        url : myAjax.ajaxurl,
                        data : {
                            paged : paged,
                            action : 'loadmore',
                            form_data: form_data,
                        },
                        beforeSend: function( xhr){
                            $('body').addClass('loading');
                        },
                        success:function(data){
                            if( data ) {
                                paged++;
                                console.log(paged)
                                $('.products__wrapper').append( data );
                                if( paged == maxPages ) {
                                    button.hide();
                                }
                            }
                            $('body').removeClass('loading');
                        }
                    });
                }
            });
        }
    });
}( jQuery ) );
