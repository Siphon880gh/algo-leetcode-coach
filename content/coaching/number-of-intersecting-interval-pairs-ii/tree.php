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
            'message' => "Read the problem statement above.\nDo [1, 2] and [2, 3] intersect?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Yes, they share the point 2', 'next' => 's2'],
                ['label' => 'No, they only touch', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Closed intervals that share an endpoint intersect. Treating touching as disjoint gives 0 instead of 2 for Example 1.\nStep back to when you split touching intervals.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "n = 10^5. What type holds the pair count?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'A 32-bit int', 'next' => 'wrong_b'],
                ['label' => 'A 64-bit integer', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. n(n − 1) / 2 is about 5 × 10^9, which overflows 32 bits.\nStep back to when you picked a 32-bit int.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. All pairs minus the sorted sweep, in 64 bits. O(n log n). Examples give 2, 3 and 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
