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
            'message' => "Read the problem statement above.\nThe digit 0?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Never allowed', 'next' => 's2'],
                ['label' => 'May appear once', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. 0 would have to appear 0 times; 1022 is not balanced.\nStep back to when you allowed a 0.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Which candidates?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only numbers with as many digits as n', 'next' => 'wrong_b'],
                ['label' => 'Everything above n, any length', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. n = 1 → 22 has more digits.\nStep back to when you fixed the length.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Where to start?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'At n + 1', 'next' => 'success'],
                ['label' => 'At n', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The answer must be strictly greater; n = 22 → 122.\nStep back to when you started at n.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Examples → 22, 1333, 3133.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
