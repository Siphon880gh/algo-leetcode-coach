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
            'message' => "Read the problem statement above.\nFormula?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'm(m + 1)/2', 'next' => 's2'],
                ['label' => 'm(m − 1)/2', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. A single c counts: example 2 → 3 instead of 6.\nStep back to when you dropped the singles.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Type?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '32-bit', 'next' => 'wrong_b'],
                ['label' => '64-bit', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. m = 10^5 gives 5,000,050,000, above 2^31.\nStep back to when you used 32-bit.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 6, 6.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
