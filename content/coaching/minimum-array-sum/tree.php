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
            'message' => "Read the problem statement above.\nAssign operations?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'DP over (halvings, subtractions) used', 'next' => 's2'],
                ['label' => 'Halve the largest, then subtract from the largest', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. [9, 9], k = 8, op1 = 1, op2 = 2 → 6 instead of 2.\nStep back to when you went greedy.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Both on one element?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Always halve first', 'next' => 'wrong_b'],
                ['label' => 'Try both orders', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. [6], k = 4, op1 = op2 = 1 → 2 instead of 1.\nStep back to when you fixed the order.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n · op1 · op2). Examples → 23, 3.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
