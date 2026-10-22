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
            'message' => "Read the problem statement above.\nPositions?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Work with sorted segments', 'next' => 's2'],
                ['label' => 'Walk every bag', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Coordinates reach 10^9.\nStep back to when you walked every bag.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Windows?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Starting at each l only', 'next' => 'wrong_b'],
                ['label' => 'Starting at each l and ending at each r', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 1 → 9 instead of 10.\nStep back to when you used left ends only.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). Examples → 10, 6.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
