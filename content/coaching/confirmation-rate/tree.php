<?php
declare(strict_types=1);

/**
 * Step-by-step tree contract:
 * - start: node id
 * - nodes[id]: message, outcome (continue|wrong|success), choices[{label, next}], optional rewind_to on wrong
 */
return [
    'start' => 'start',
    'nodes' => [
        'start' => [
            'message' => "Read the problem statement above.\nBase table?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Signups', 'next' => 's2'],
                ['label' => 'Confirmations', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Users with no requests would disappear.\nStep back to when you started from Confirmations.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "No requests?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Leave NULL', 'next' => 'wrong_b'],
                ['label' => 'Rate 0 via IFNULL', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The statement defines it as 0.\nStep back to when you left NULL.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Rounding?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'ROUND(…, 2)', 'next' => 'success'],
                ['label' => 'TRUNCATE(…, 2)', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The statement asks for rounding.\nStep back to when you truncated.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Example → 0.00, 0.00, 1.00, 0.50.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
