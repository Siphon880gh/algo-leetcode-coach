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
            'message' => "Read the problem statement above.\nWhich number to halve?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The current largest', 'next' => 's2'],
                ['label' => 'The current smallest', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Halving 1 again and again removes less than 1 in total, so Example 1 never reaches 16.5.\nStep back to when you picked the smallest.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "After halving 19?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Never use it again', 'next' => 'wrong_b'],
                ['label' => 'Put 9.5 back into the max-heap', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 1 → 4 instead of 3 when each number is halved at most once.\nStep back to when you dropped the half.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Stop when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'cut ≥ half the original sum', 'next' => 'success'],
                ['label' => 'cut > half', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. [2] → 1, since halving 2 removes exactly 1.\nStep back to when you required strictly more.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). Examples → 3, 3.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
