jQuery( document ).ready( function( $ ){

    $( '#customize-control-relia_preset_theme_color input[type=radio]' ).each( function() {

        var selector = $(this);

        if( selector.val()  === 'gapers' ) {

            selector.parent('label').append('<span class="theme-color" style="background: #0080e0;"></span>')

        }

        if( selector.val()  === 'gold' ) {

            selector.parent('label').append('<span class="theme-color" style="background: #ccaa66;"></span>')

        }

        if( selector.val()  === 'green' ) {

            selector.parent('label').append('<span class="theme-color" style="background: #8fc464;"></span>')

        }

        if( selector.val()  === 'teal' ) {

            selector.parent('label').append('<span class="theme-color" style="background: #55d6b8;"></span>')

        }

        if( selector.val()  === 'blue' ) {

            selector.parent('label').append('<span class="theme-color" style="background: #1f8aa5;"></span>')

        }

        if( selector.val()  === 'purple' ) {

            selector.parent('label').append('<span class="theme-color" style="background: #9f6eea;"></span>')

        }

        if( selector.val()  === 'red' ) {

            selector.parent('label').append('<span class="theme-color" style="background: #c93838;"></span>')

        }


    });

});
