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
            'message' => "Read the problem statement above.\nFor n > 1, the board ends with?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'n − 1 numbers: 2 … n', 'next' => 's2'],
                ['label' => 'n numbers: 1 … n', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Nothing leaves remainder 1 when divided by 1; Example 1 → 5 instead of 4.\nStep back to when you added 1.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "n = 1?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Use n − 1', 'next' => 'wrong_b'],
                ['label' => 'Answer 1', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. 1 is on the board from the start; n = 1 → 0 instead of 1.\nStep back to when you applied the formula.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(1). Examples → 4, 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
