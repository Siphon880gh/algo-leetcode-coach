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
            'message' => "Read the problem statement above.\nChoosing a value removes?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Every copy', 'next' => 's2'],
                ['label' => 'One copy', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. A value goes with all its occurrences.\nStep back to when you removed one.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Order of removal?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Smallest value first', 'next' => 'wrong_b'],
                ['label' => 'Most frequent first', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Large counts reach half sooner.\nStep back to when you sorted by value.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Stop when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Removed ≥ n / 2', 'next' => 'success'],
                ['label' => 'Removed > n / 2', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. At least half is enough.\nStep back to when you required more.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). [3,3,3,3,5,5,5,2,2,7] → 2. [7,7,7,7,7,7] → 1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
