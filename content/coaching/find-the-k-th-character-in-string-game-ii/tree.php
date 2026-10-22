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
            'message' => "Read the problem statement above.\nBit i pairs with?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'operations[i]', 'next' => 's2'],
                ['label' => 'operations[last − i]', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. k = 2, operations [1, 0] → a instead of b.\nStep back to when you reversed the operations.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Wrap?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No wrap', 'next' => 'wrong_b'],
                ['label' => 'mod 26', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. 30 type-1 operations, k = 2^26 → { instead of a.\nStep back to when you skipped mod 26.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(log k). Examples → a, b.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
