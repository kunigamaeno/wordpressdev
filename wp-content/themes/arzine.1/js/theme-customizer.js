( function( $ ) {
    wp.customize( 'blogname', function( value ) {
        value.bind( function( to ) {
            $( '.blog-title a' ).html( to );
        } );
    } );
    wp.customize( 'blogdescription', function( value ) {
        value.bind( function( to ) {
            $( '.site-description' ).html( to );
        } );
    } );
    wp.customize( 'background_color', function( value ) {
        value.bind( function( to ) {
            if ( '#ffffff' == to || '#fff' == to || '' == to )
                $( 'body' ).addClass( 'custom-background-white' );
            else if ( '' == to )
                $( 'body' ).addClass( 'custom-background-empty' );
            else
                $( 'body' ).removeClass( 'custom-background-empty custom-background-white' );
        } );
    } );
} )( jQuery );