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
            'message' => "Read the problem statement above.\nPerfect when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Both children perfect with the same size', 'next' => 's2'],
                ['label' => 'Every node has 0 or 2 children', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1, k = 1 → 11 instead of 3.\nStep back to when you counted full subtrees.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Rank which list?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Distinct sizes', 'next' => 'wrong_b'],
                ['label' => 'All sizes, repeats kept', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 1 → 1 instead of 3.\nStep back to when you dropped repeats.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). Examples → 3, 7, −1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
