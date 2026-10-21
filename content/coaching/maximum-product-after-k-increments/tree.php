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
            'message' => "Read the problem statement above.\nWhich number to raise?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The smallest', 'next' => 's2'],
                ['label' => 'The largest', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 [0,4] → 0 instead of 20; the 0 must grow.\nStep back to when you raised the largest.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Final product?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Multiply in 64-bit, then mod', 'next' => 'wrong_b'],
                ['label' => 'Multiply mod 10^9 + 7', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. 10^5 values near 10^6 overflow long before the end.\nStep back to when you skipped the modulus.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "All increments on one number?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: always re-pick the smallest', 'next' => 'success'],
                ['label' => 'Yes, on the first smallest', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. [1,1] with k = 2 → 3 instead of 4.\nStep back to when you kept one target.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O((n + k) log n). Examples → 20, 216.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
