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
            'message' => "Read the problem statement above.\nCount operations by?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Simulating with a min-heap', 'next' => 's2'],
                ['label' => 'Half the count below k, rounded up', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 2 → 3 instead of 4.\nStep back to when you used a formula.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Type for 2x + y?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '32-bit', 'next' => 'wrong_b'],
                ['label' => '64-bit', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Two values near 10^9 give 2,999,999,997.\nStep back to when you used 32-bit.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). Examples → 2, 4.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
