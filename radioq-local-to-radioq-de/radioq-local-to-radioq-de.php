<?php
/*
Plugin Name: Radioq.local to Radioq.de
Plugin URI: https://github.com/hija/radioq-local-to-radioq-de
Description: Changes Email on Registration from radioq.local to radioq.de
Author: Hilko Janßen
Version: 1.0.0
Author URI: https://hilko.eu/
*/


if ( ! defined( 'WPINC' ) ) exit;


function radioq_local_to_de($user_email) {
		if(substr($user_email, -strlen('radioq.local')) === 'radioq.local'){
			write_log('Radioq.local to Radioq.de: Found new register request with .local email!');
			$firstpart = substr($user_email, 0, strlen($user_email)-strlen('radioq.local'));
			$finalmail = $firstpart . 'radioq.de';
			write_log('Radioq.local to Radioq.de: Changed ' . $user_email . ' to ' . $finalmail);
			return $finalmail;
		}
}

add_filter('pre_user_email', 'radioq_local_to_de');

if (!function_exists('write_log')) {
    function write_log($log) {
        if (true === WP_DEBUG) {
            if (is_array($log) || is_object($log)) {
                error_log(print_r($log, true));
            } else {
                error_log($log);
            }
        }
    }
}
