<?php
if (!defined('ABSPATH')) exit;

add_action('wp_ajax_tcf_answer_card', 'tcf_answer_card');

function tcf_answer_card() {
    if (!is_user_logged_in()) {
        wp_send_json_error('No autorizado');
    }

    global $wpdb;
    $user_id = get_current_user_id();

    $card_id = intval($_POST['card_id']);
    $quality = intval($_POST['quality']); // 0–5

    $table = $wpdb->prefix . 'tcf_cards';

    $card = $wpdb->get_row(
        $wpdb->prepare(
            "SELECT * FROM $table WHERE id = %d AND user_id = %d",
            $card_id,
            $user_id
        ),
        ARRAY_A
    );

    if (!$card) {
        wp_send_json_error('Carta no encontrada');
    }

    // Aplicar SM-2
    $updated = tcf_sm2($card, $quality);

    $wpdb->update(
        $table,
        [
            'ease' => $updated['ease'],
            'interval_days' => $updated['interval_days'],
            'repetitions' => $updated['repetitions'],
            'last_review' => $updated['last_review'],
            'next_review' => $updated['next_review']
        ],
        ['id' => $card_id]
    );

    // Obtener siguiente carta
    $next = $wpdb->get_row(
        $wpdb->prepare(
            "SELECT * FROM $table 
             WHERE user_id = %d 
             AND next_review <= CURDATE()
             ORDER BY next_review ASC
             LIMIT 1",
            $user_id
        ),
        ARRAY_A
    );

    wp_send_json_success([
        'next_card' => $next
    ]);
}
