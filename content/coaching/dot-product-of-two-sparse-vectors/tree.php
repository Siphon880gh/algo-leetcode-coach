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
            'message' => "Problem: Design a sparse vector class from an integer array that supports a dot product with another sparse vector. For instance, [1,0,0,2,3] · [0,3,0,4,0] = 8. (Restated from memory; limits and examples may differ slightly.)\nStore the dense array?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: non-zeros only', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Most entries are zero.\nStep back to when you stored everything.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Indices differ?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Advance both', 'next' => 'wrong_b'],
                ['label' => 'Advance the smaller index', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. You would skip possible matches.\nStep back to when you advanced both.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "One vector much sparser?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Binary search its indices in the other', 'next' => 'success'],
                ['label' => 'Always merge linearly', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. k log m beats k + m when k ≪ m.\nStep back to when you merged.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(k1 + k2). Example → 8.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
