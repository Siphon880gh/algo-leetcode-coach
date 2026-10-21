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
            'message' => "Read the problem statement above.\nSimulate many random flights?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: there is an exact answer', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Simulation only approximates.\nStep back to when you simulated.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Which seats decide the outcome?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Every seat equally', 'next' => 'wrong_b'],
                ['label' => 'Seat 1 and seat n', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Taking any other seat just passes the choice on.\nStep back to when you counted all seats.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "n = 1?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '1.0', 'next' => 'success'],
                ['label' => '0.5', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The only passenger gets their seat.\nStep back to when you returned 0.5.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(1). n = 1 → 1.00000. n = 2 → 0.50000.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
