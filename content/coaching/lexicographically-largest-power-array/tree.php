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
            'message' => "Read the problem statement above.\nExample 2, nums = [3, 1, 7]. Which number must go first?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '1, the smallest', 'next' => 'wrong_a'],
                ['label' => '7, the only one with bit 2', 'next' => 's2'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Starting with 1 makes power[12] = 0 and power[13] = 0, while starting with 7 gives 1 and 2.\nStep back to when you started with 1.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "nums = [2, 9, 1]\nSorted largest first: [9, 2, 1]\nIs that the best order?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No, keep 9 first, then put 1 before 2 for bit 0', 'next' => 'success'],
                ['label' => 'Yes, larger numbers first', 'next' => 'wrong_b'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. [9, 1, 2] keeps bit 0 for two numbers, so the last entry is 2 instead of 1.\nStep back to when you sorted by value.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Split blocks from bit 14 down to bit 0. O(15 · n). Examples end in 2, 1, 2 and 1, 2, 3.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
