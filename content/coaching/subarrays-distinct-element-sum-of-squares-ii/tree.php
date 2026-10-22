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
            'message' => "Read the problem statement above.\nn reaches 10^5. Approach?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Sweep r with a lazy segment tree', 'next' => 's2'],
                ['label' => 'Every subarray as in part I', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. That is about 5 · 10^9 subarrays.\nStep back to when you enumerated.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Growth of the sum of squares at r?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'r − p', 'next' => 'wrong_b'],
                ['label' => '2·S + (r − p)', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. (c + 1)² − c² = 2c + 1, not 1; example 1 → 9 instead of 15.\nStep back to when you added r − p.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). Examples → 15, 3.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
