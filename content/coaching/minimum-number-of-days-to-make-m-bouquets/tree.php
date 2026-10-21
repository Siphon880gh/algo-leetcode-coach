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
            'message' => "Read the problem statement above.\nCheck counts?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Adjacent runs of length k', 'next' => 's2'],
                ['label' => 'Total bloomed / k', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Bouquets need adjacent flowers.\nStep back to when you ignored adjacency.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Impossible early?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Search anyway', 'next' => 'wrong_b'],
                ['label' => 'm · k > n → −1', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Not enough flowers exist.\nStep back to when you searched.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Overflow?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '64-bit m · k', 'next' => 'success'],
                ['label' => '32-bit', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. m can be up to 10^6 and k up to 10^5.\nStep back to when you used 32 bits.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log max). [1,10,3,10,2], 3, 1 → 3; k = 2 → −1. [7,7,7,7,12,7,7], 2, 3 → 12.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
