<?php //phpcs:ignore WordPress.Files.Filename.InvalidClassFileName

class Utility{

    public static function log( $log ) {

        if ( true === WP_DEBUG ) {
            if ( is_array( $log ) || is_object( $log ) ) {
                error_log( print_r( $log, true ) );
            } else {
                error_log( $log );
            }
        }
    }

    /**
     * Generates human-readable string.
     *
     * @param string $length Desired length of random string.
     *
     * return string Random string.
     */
    public static function random_string( $length = 6 ) {
        $string     = '';
        $vowels     = array( 'a', 'e', 'i', 'o', 'u' );
        $consonants = array(
            'b', 'c', 'd', 'f', 'g', 'h', 'j', 'k', 'l', 'm',
            'n', 'p', 'r', 's', 't', 'v', 'w', 'x', 'y', 'z',
        );

        $max = $length / 2;
        for ( $i = 1; $i <= $max; $i++ ) {
            $string .= $consonants[ wp_rand( 0, 19 ) ];
            $string .= $vowels[ wp_rand( 0, 4 ) ];
        }

        return $string;
    }

    public static function niceLog( $output ) {
        echo '<pre>', print_r( $output ), '</pre>';
    }
}
