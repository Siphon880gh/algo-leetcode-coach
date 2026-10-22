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
            'message' => "Read the problem statement above.\nA number can join the window when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'It shares no bit with the window’s OR', 'next' => 's2'],
                ['label' => 'It shares no bit with its left neighbour', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Every pair must have AND 0, not just neighbours; Example 1 → 4 instead of 3, since 8 & 10 = 8.\nStep back to when you only checked the neighbour.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "On a clash?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Restart the window at the new number', 'next' => 'wrong_b'],
                ['label' => 'Drop numbers from the left', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. [1,2,1,4] → 2 instead of 3; dropping the first 1 keeps [2,1,4].\nStep back to when you restarted.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Drop how many?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'While the clash remains', 'next' => 'success'],
                ['label' => 'Exactly one', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The new number can clash with several; [1,4,5,2,4] → 3 instead of 2.\nStep back to when you dropped only one.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 3, 1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
