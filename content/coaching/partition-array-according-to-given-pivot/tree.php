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
            'message' => "Read the problem statement above.\nHow to partition?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Three stable passes into a new array', 'next' => 's2'],
                ['label' => 'In-place three-way swapping', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Swapping moves elements past each other and breaks their relative order.\nStep back to when you swapped in place.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Pivot copies?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Left where they were', 'next' => 'wrong_b'],
                ['label' => 'All together between the two sides', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 1 needs both 10s right after 3, between the smaller and larger values.\nStep back to when you kept them in place.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Order of the greater side?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Original order', 'next' => 'success'],
                ['label' => 'Sorted', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Example 2 → [-3,2,4,3]; sorting would put 3 before 4.\nStep back to when you sorted.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → [9,5,3,10,10,12,14], [-3,2,4,3].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
