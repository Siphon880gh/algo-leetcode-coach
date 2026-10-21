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
            'message' => "Read the problem statement above.\nCan you use max − min − 2k here?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: every element must move by exactly ±k', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. That formula is for Smallest Range I, where any amount up to k is allowed.\nStep back to when you reused it.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "After sorting, which elements go up?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The even indices', 'next' => 'wrong_b'],
                ['label' => 'A prefix: the smaller ones go up, the larger ones go down', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Raising a larger element while lowering a smaller one never helps.\nStep back to when you alternated.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "For split after i, the new maximum is?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'max(A[i] + k, A[−1] − k)', 'next' => 'success'],
                ['label' => 'A[−1] + k', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The last element goes down in this split.\nStep back to when you raised it.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). [1], k = 0 → 0. [0,10], k = 2 → 6. [1,3,6], k = 3 → 3.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
