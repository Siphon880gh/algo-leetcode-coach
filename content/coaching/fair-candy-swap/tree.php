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
            'message' => "Read the problem statement above.\nTry every pair (x, y)?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: the totals fix y once x is chosen', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. That is O(n · m).\nStep back to when you tried every pair.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "What is the relationship between x and y?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'x − y = sumA − sumB', 'next' => 'wrong_b'],
                ['label' => 'x − y = (sumA − sumB) / 2', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Alice loses x and gains y, while Bob does the opposite, so the difference moves by 2(x − y).\nStep back to when you dropped the half.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "How do you find y fast?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Look up x − delta in a set of Bob\'s sizes', 'next' => 'success'],
                ['label' => 'Sort both and binary search every pair', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. A hash set gives O(1) lookups.\nStep back to when you searched pairs.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n + m). [1,1], [2,2] → [1,2]. [1,2], [2,3] → [1,2]. [2], [1,3] → [2,3].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
