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
            'message' => "Read the problem statement above.\nWhom should the smallest piles go to?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Bob', 'next' => 's2'],
                ['label' => 'You', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. You want the larger leftovers.\nStep back to when you took the small ones.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Your piles?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The top third', 'next' => 'wrong_b'],
                ['label' => 'Indices n/3, n/3 + 2, …', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Alice always takes the largest.\nStep back to when you took the top third.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "How many rounds?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'n / 3', 'next' => 'success'],
                ['label' => 'n / 2', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Each round uses three piles.\nStep back to when you used n / 2.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). [2,4,1,2,7,8] → 9. [9,8,7,6,5,1,2,3,4] → 18.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
