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
            'message' => "Read the problem statement above.\nTry every set of columns?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: group rows by pattern', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. That is 2^n subsets.\nStep back to when you tried subsets.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Rows [0,1,0] and [1,0,1]. Same group?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No', 'next' => 'wrong_b'],
                ['label' => 'Yes: they are complements', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The same flips make one all 0 and the other all 1.\nStep back to when you separated them.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "How do you make one key for both?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'XOR each value with the row\'s first value', 'next' => 'success'],
                ['label' => 'Sort the row', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Sorting loses the column positions.\nStep back to when you sorted.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(m · n). [[0,1],[1,1]] → 1. [[0,1],[1,0]] → 2. [[0,0,0],[0,0,1],[1,1,0]] → 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
