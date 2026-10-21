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
            'message' => "Read the problem statement above.\nWhy can a sliding window work here?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'All values are positive, so the product only grows as the window grows', 'next' => 's2'],
                ['label' => 'Products are always small', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Positivity is what makes shrinking from the left safe.\nStep back to when you relied on small products.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "The window is valid at right. How many new subarrays?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '1', 'next' => 'wrong_b'],
                ['label' => 'right − left + 1, one per start in the window', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Every subarray ending at right and starting in [left, right] has a smaller product.\nStep back to when you counted 1.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "k ≤ 1. Then?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Return 0 immediately', 'next' => 'success'],
                ['label' => 'Run the window as usual', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. No product of positive integers is below 1, and the shrinking loop would run past right.\nStep back to when you skipped the guard.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n) time, O(1) space. [10,5,2,6], k = 100 → 8. [1,2,3], k = 0 → 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
