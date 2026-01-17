<?php
add_shortcode('timed_flashcards', 'tcf_render_app');

function tcf_render_app() {
    if (!is_user_logged_in()) {
        return '<p><strong>Debes iniciar sesión para usar las flashcards.</strong></p>';
    }

    wp_enqueue_style('tcf-ui', TCF_URL . 'assets/css/ui.css');
    wp_enqueue_script('tcf-app', TCF_URL . 'assets/js/app.js', [], false, true);

    ob_start();
    include TCF_PATH . 'templates/app.html';
    return ob_get_clean();
}
