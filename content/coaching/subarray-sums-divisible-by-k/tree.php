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
            'message' => "Read the problem statement above.\nWhen is sum(i..j) divisible by k?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'When the prefix sums before i and at j have the same remainder', 'next' => 's2'],
                ['label' => 'When both prefix sums are divisible by k', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Only their difference needs to be divisible.\nStep back to when you required both.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "The prefix sum is negative. Its remainder?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Use it as returned', 'next' => 'wrong_b'],
                ['label' => 'Normalize into 0 … k − 1', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. In many languages −1 % 5 is −1, which must match 4.\nStep back to when you kept the negative.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Initial count?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'count[0] = 1', 'next' => 'success'],
                ['label' => 'All zeros', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Subarrays starting at index 0 need the empty prefix.\nStep back to when you started at zero.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). [4,5,0,−2,−3,1], k = 5 → 7. [5], k = 9 → 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
