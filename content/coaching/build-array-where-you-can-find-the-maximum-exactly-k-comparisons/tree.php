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
            'message' => "Read the problem statement above.\nValue ≤ current max?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'mx choices, cost unchanged', 'next' => 's2'],
                ['label' => 'Cost + 1', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Only a strictly greater value raises the cost.\nStep back to when you added 1.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "k = 0?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Answer 1', 'next' => 'wrong_b'],
                ['label' => 'Answer 0 (n ≥ 1)', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The first element always costs 1.\nStep back to when you returned 1.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Speed-up?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Prefix sums over mx', 'next' => 'success'],
                ['label' => 'Brute force all arrays', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. m^n arrays is far too many.\nStep back to when you enumerated.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n · m · k) with prefix sums. (2,3,1) → 6. (5,2,3) → 0. (9,1,1) → 1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
