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
            'message' => "Read the problem statement above.\nnums1 prefix of nums2 needs?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'i ≤ j − i and LCP(0, i) ≥ i', 'next' => 's2'],
                ['label' => 'LCP(0, i) ≥ i only', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. [1, 2, 1, 2, 1] → 3 instead of 2.\nStep back to when you dropped the length check.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Combine?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Add both', 'next' => 'wrong_b'],
                ['label' => 'OR', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. [1, 1, 1, 1] → 4 instead of 3.\nStep back to when you added.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n²). Examples → 2, 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
