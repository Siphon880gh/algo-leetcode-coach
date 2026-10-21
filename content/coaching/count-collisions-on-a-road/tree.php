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
            'message' => "Read the problem statement above.\nLeading Ls and trailing Rs?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'They escape: drop them', 'next' => 's2'],
                ['label' => 'Count every moving car', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 2 (LLRR) → 4 instead of 0.\nStep back to when you counted escaping cars.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Stationary S cars?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Count them as 1 each', 'next' => 'wrong_b'],
                ['label' => 'Add nothing themselves', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 1 → 6 instead of 5.\nStep back to when you counted S.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "An R meeting an L?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Adds 2: both cars stop', 'next' => 'success'],
                ['label' => 'Adds 1', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. RL → 2, as the statement counts 2 for opposite cars.\nStep back to when you counted 1.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 5, 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
