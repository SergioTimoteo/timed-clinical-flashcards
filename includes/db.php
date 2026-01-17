<?php
function tcf_create_tables() {
    global $wpdb;

    $table = $wpdb->prefix . 'tcf_cards';
    $charset = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE $table (
        id BIGINT AUTO_INCREMENT PRIMARY KEY,
        user_id BIGINT NOT NULL,
        front TEXT NOT NULL,
        back TEXT NOT NULL,
        ease FLOAT DEFAULT 2.5,
        interval_days INT DEFAULT 0,
        repetitions INT DEFAULT 0,
        next_review DATE,
        last_review DATE
    ) $charset;";

    require_once ABSPATH . 'wp-admin/includes/upgrade.php';
    dbDelta($sql);
}
