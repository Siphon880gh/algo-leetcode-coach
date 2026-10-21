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
            'message' => "Read the problem statement above.\nSimulate with a heap?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: orders reach 10^9', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. One pop per ball is far too slow.\nStep back to when you used a heap per ball.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Revenue above T for count x?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'x · (x − T)', 'next' => 'wrong_b'],
                ['label' => '(x + T + 1)(x − T) / 2', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Prices drop by one per ball.\nStep back to when you used a flat price.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Leftover orders?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Each sells at price T', 'next' => 'success'],
                ['label' => 'Ignore them', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Exactly orders balls must be sold.\nStep back to when you ignored them.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log max). [2,5], 4 → 14. [3,5], 6 → 19.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
