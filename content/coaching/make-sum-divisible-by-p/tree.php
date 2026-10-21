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
            'message' => "Read the problem statement above.\nneed = 0?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Return 0', 'next' => 's2'],
                ['label' => 'Search anyway', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Nothing needs removing.\nStep back to when you searched.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Map stores?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'First index', 'next' => 'wrong_b'],
                ['label' => 'Last index of each prefix remainder', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The latest index gives the shortest subarray.\nStep back to when you kept the first.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Best is n?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Return −1', 'next' => 'success'],
                ['label' => 'Return n', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Removing the whole array is not allowed.\nStep back to when you returned n.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). [3,1,4,2], 6 → 1. [6,3,5,2], 9 → 2. [1,2,3], 3 → 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
