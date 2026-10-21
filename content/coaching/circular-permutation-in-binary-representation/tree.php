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
            'message' => "Read the problem statement above.\nBacktrack over orders?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: use the Gray code', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. 2¹⁶ terms make search slow.\nStep back to when you backtracked.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Gray code term i?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'i ^ (i << 1)', 'next' => 'wrong_b'],
                ['label' => 'i ^ (i >> 1)', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. That does not change one bit at a time.\nStep back to when you shifted left.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Start at start how?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'XOR every term with start', 'next' => 'success'],
                ['label' => 'Rotate the list to start', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Rotation needs a search; XOR keeps one-bit steps and starts at start.\nStep back to when you rotated.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(2ⁿ). n = 2, start = 3 → [3,2,0,1].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
