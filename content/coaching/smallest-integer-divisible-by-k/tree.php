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
            'message' => "Read the problem statement above.\nBuild 1, 11, 111 as integers?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: keep only the remainder mod k', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The number can have up to k digits.\nStep back to when you built the integer.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "k = 10. Answer?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Keep looping', 'next' => 'wrong_b'],
                ['label' => '−1', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A number ending in 1 is never divisible by 2 or 5.\nStep back to when you kept looping.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "How many steps can you need at most?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'k', 'next' => 'success'],
                ['label' => 'Unbounded', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Only k remainders exist, so they repeat within k steps.\nStep back to when you looped forever.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(k). k = 1 → 1. k = 2 → −1. k = 3 → 3.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
