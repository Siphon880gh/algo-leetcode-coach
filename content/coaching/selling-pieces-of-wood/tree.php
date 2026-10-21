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
            'message' => "Read the problem statement above.\ndp[h][w] starts at?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Its own price, or 0', 'next' => 's2'],
                ['label' => 'Only the best cut', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Nothing is ever sold; Example 1 → 0 instead of 19.\nStep back to when you dropped the price.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Cuts to try?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only the middle cut', 'next' => 'wrong_b'],
                ['label' => 'Every position along both sides', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 1 → 17 instead of 19.\nStep back to when you tried only the middle.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Rotate a piece to match a price?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: h × w and w × h differ', 'next' => 'success'],
                ['label' => 'Yes, use the w × h price too', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Example 1 → 23 instead of 19.\nStep back to when you rotated pieces.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(m · n · (m + n)). Examples → 19, 32.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
