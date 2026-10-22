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
            'message' => "Read the problem statement above.\nSort by?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 't_i · d_j < t_j · d_i', 'next' => 's2'],
                ['label' => 'Damage only', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Power 1, damage [2, 1], health [3, 1] → 10 instead of 9.\nStep back to when you sorted by damage.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "t_i is?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '⌊health / power⌋', 'next' => 'wrong_b'],
                ['label' => '⌈health / power⌉', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 1 → 28 instead of 39.\nStep back to when you rounded down.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). Examples → 39, 20, 320.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
