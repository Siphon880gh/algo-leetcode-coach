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
            'message' => "Read the problem statement above.\nTry ±k choices for each element?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: only the extremes decide the score', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Every middle element can be moved inside the final range.\nStep back to when you tried choices.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Formula?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'max − min − 2k', 'next' => 'wrong_b'],
                ['label' => 'max(0, max − min − 2k)', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The gap cannot be negative.\nStep back to when you dropped the floor.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Can elements move by less than k?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Yes: any amount in [−k, k]', 'next' => 'success'],
                ['label' => 'No, exactly ±k', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. That is Smallest Range II; here any amount up to k is allowed.\nStep back to when you forced ±k.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). [1], k = 0 → 0. [0,10], k = 2 → 6. [1,3,6], k = 3 → 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
