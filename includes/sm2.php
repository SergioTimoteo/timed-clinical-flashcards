<?php
function tcf_sm2($card, $quality) {
    if ($quality < 3) {
        $card['repetitions'] = 0;
        $card['interval_days'] = 1;
    } else {
        if ($card['repetitions'] == 0) {
            $card['interval_days'] = 1;
        } elseif ($card['repetitions'] == 1) {
            $card['interval_days'] = 6;
        } else {
            $card['interval_days'] = round($card['interval_days'] * $card['ease']);
        }
        $card['repetitions']++;
    }

    $card['ease'] = max(
        1.3,
        $card['ease'] + (0.1 - (5 - $quality) * (0.08 + (5 - $quality) * 0.02))
    );

    $card['last_review'] = date('Y-m-d');
    $card['next_review'] = date('Y-m-d', strtotime("+{$card['interval_days']} days"));

    return $card;
}
