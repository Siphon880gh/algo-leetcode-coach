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
            'message' => "Read the problem statement above.\nFewer jobs than days?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Return −1', 'next' => 's2'],
                ['label' => 'Return 0', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Each day needs at least one job.\nStep back to when you returned 0.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "A day's cost?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The sum', 'next' => 'wrong_b'],
                ['label' => 'The maximum difficulty that day', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A day costs its hardest job.\nStep back to when you summed.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Range for j?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'i to n − k', 'next' => 'success'],
                ['label' => 'i to n − 1', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Leave a job for each remaining day.\nStep back to when you went to n − 1.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n² · d). [6,5,4,3,2,1], 2 → 7. [9,9,9], 4 → −1. [1,1,1], 3 → 3.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
