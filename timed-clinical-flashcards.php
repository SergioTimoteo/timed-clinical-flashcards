<?php
/*
Plugin Name: Timed Clinical Flashcards
Description: Flashcards tipo Anki con SM-2 para Timed Clinical
Version: 1.0.0
Author: Timed Clinical
*/

if (!defined('ABSPATH')) exit;

define('TCF_PATH', plugin_dir_path(__FILE__));
define('TCF_URL', plugin_dir_url(__FILE__));

require_once TCF_PATH . 'includes/db.php';
require_once TCF_PATH . 'includes/sm2.php';
require_once TCF_PATH . 'includes/api.php';
require_once TCF_PATH . 'includes/shortcodes.php';

register_activation_hook(__FILE__, 'tcf_install');

function tcf_install() {
    tcf_create_tables();
}
