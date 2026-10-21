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
            'message' => "Read the problem statement above.\nWhich digits make a number invalid?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '3, 4, and 7', 'next' => 's2'],
                ['label' => '2 and 5', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. 2 and 5 rotate into each other.\nStep back to when you rejected 2 and 5.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "A number uses only 0, 1, and 8. Good?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Yes', 'next' => 'wrong_b'],
                ['label' => 'No: it rotates to itself', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A good number must become a different number.\nStep back to when you accepted it.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "How do you scale beyond brute force?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'DP on x // 10 with states invalid, same, changed', 'next' => 'success'],
                ['label' => 'Not possible', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The state of x follows from x // 10 and its last digit.\nStep back to when you gave up.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). n = 10 → 4. n = 1 → 0. n = 2 → 1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
