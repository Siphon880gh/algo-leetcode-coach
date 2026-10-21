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
            'message' => "Read the problem statement above.\nDo you need to enumerate parenthesizations?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: combining any two numbers into one covers them all', 'next' => 's2'],
                ['label' => 'Yes: build every expression tree', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Pairwise merging already reaches every tree shape.\nStep back to when you built expression trees.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "How do you divide?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Integer division', 'next' => 'wrong_b'],
                ['label' => 'Real division, skipping divisors near 0', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. [1,5,5,5] needs 5 · (5 − 1/5).\nStep back to when you used integer division.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "One number is left. How do you test it?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '|x − 24| < 1e-6', 'next' => 'success'],
                ['label' => 'x == 24', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Floating-point results like 23.999999 must count.\nStep back to when you compared exactly.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Backtracking over pairs and operators: O(1) for 4 cards. [4,1,8,7] → true. [1,2,1,2] → false.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
