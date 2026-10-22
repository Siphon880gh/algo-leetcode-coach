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
            'message' => "Problem: An array is consecutive if every step is +1, or every step is −1; a single element counts. Return the sum of the element sums of all consecutive subarrays, modulo the value the statement gives. Limits are in the official statement. (Restated from memory; limits and examples may differ slightly.)\nSingletons?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Subtract once', 'next' => 's2'],
                ['label' => 'Count in both directions', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. [1, 2, 3] → 26 instead of 20.\nStep back to when you counted them twice.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Extending by x adds?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'x once', 'next' => 'wrong_b'],
                ['label' => 'cnt · x to the sum', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Every subarray ending here gains x: [1, 2, 3] → 10 instead of 20.\nStep back to when you added x once.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). The guide’s checks → 20, 16, 32.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
