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
            'message' => "Problem: You are given intervals and an integer k. Add exactly one interval of length at most k so the number of connected groups (maximal sets that cover a range with no gaps) is as small as possible, and return that number. Limits are in the official statement. (Restated from memory; limits and examples may differ slightly.)\nNew interval should?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Reach every group it can', 'next' => 's2'],
                ['label' => 'Close just one gap', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. The guide’s second check → 2 instead of 1.\nStep back to when you closed one gap.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Reachable groups start?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Below end_i + k', 'next' => 'wrong_b'],
                ['label' => 'At most end_i + k', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Touching counts as connected: [[1, 1], [3, 3]], k = 2 → 2 instead of 1.\nStep back to when you used strict <.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). The guide’s checks → 2, 1, 3.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
