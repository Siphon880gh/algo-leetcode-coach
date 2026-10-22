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
            'message' => "Problem: An array is consecutive if every step is +1, or every step is −1; a single element counts. Return the sum of the element sums of all consecutive subsequences (order kept, elements not necessarily adjacent), modulo the value the statement gives. Limits are in the official statement. (Restated from memory; limits and examples may differ slightly.)\nSingletons?",
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
            'message' => "Extend from?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The previous index only', 'next' => 'wrong_b'],
                ['label' => 'Totals stored by value x − 1 / x + 1', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. That counts subarrays: [1, 3, 2] → 11 instead of 14 (it misses [1, 2]).\nStep back to when you used the previous index.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). The guide’s checks → 20, 18, 30.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
