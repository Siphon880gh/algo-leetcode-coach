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
            'message' => "Read the problem statement above.\nAND condition?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Run LIS on numbers sharing bit b, for each b', 'next' => 's2'],
                ['label' => 'Ignore it and run one LIS', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 3 → 2 instead of 1.\nStep back to when you dropped the AND.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Tails search?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'bisect_right', 'next' => 'wrong_b'],
                ['label' => 'bisect_left (strict)', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Constructed check (run in code): [3, 3, 3] → 3 instead of 1.\nStep back to when you let equal values extend.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(31 · n log n). Examples → 2, 3, 1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
