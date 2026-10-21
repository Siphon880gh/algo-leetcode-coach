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
            'message' => "Read the problem statement above.\nWhich earlier values pair with x?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'x − k and x + k', 'next' => 's2'],
                ['label' => 'Only x + k', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. An earlier smaller partner is missed; [1,2,2,1], k = 1 → 4, not 2.\nStep back to when you checked one side.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Order of a pair?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Both orders', 'next' => 'wrong_b'],
                ['label' => 'i < j, each pair once', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 1 would give 8 instead of 4.\nStep back to when you counted both orders.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "n ≤ 200. Would the double loop time out?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No, 2 · 10^4 checks are fine', 'next' => 'success'],
                ['label' => 'Yes', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. O(n²) is tiny at n = 200; the counter is just neater.\nStep back to when you ruled it out.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 4, 0, 3.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
