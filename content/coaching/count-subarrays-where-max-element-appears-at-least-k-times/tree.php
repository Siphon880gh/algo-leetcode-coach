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
            'message' => "Read the problem statement above.\nWhich subarrays count?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'At least k copies of the max', 'next' => 's2'],
                ['label' => 'Exactly k copies of the max', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. The task says at least; example 1 → 4 instead of 6.\nStep back to when you required exactly k.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Add for a right end r?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'pos[−k]', 'next' => 'wrong_b'],
                ['label' => 'pos[−k] + 1', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Starts 0 … pos[−k] are pos[−k] + 1 choices; example 1 → 4 instead of 6.\nStep back to when you dropped the + 1.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 6, 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
