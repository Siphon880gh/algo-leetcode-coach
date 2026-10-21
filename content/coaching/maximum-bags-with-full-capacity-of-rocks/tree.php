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
            'message' => "Read the problem statement above.\nFill order?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Smallest gap first', 'next' => 's2'],
                ['label' => 'Input order', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. capacity [5,1,1], rocks [0,0,0], 2 extra → 0 instead of 2.\nStep back to when you kept the input order.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Bags already full?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Count only bags you fill', 'next' => 'wrong_b'],
                ['label' => 'Count them', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 1 → 2 instead of 3.\nStep back to when you skipped full bags.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Sort key?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'capacity − rocks', 'next' => 'success'],
                ['label' => 'capacity', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. capacity [3,10], rocks [0,10], 0 extra → 0 instead of 1.\nStep back to when you sorted by capacity.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). Examples → 3, 3.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
