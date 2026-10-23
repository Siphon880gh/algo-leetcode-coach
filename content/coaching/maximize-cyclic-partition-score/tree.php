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
            'message' => "Read the problem statement above.\nCyclic or linear?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Cyclic: try both rotations around the maximum', 'next' => 's2'],
                ['label' => 'Treat it as linear', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 → 2 instead of 3.\nStep back to when you ignored the wrap.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Which rotations?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only maximum first', 'next' => 'wrong_b'],
                ['label' => 'Maximum first and maximum last', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Constructed check (run in code): [2, 3, 6, 6, 4, 4], k = 2 → 4 instead of 7.\nStep back to when you tried one rotation.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n · k). Examples → 3, 2, 3.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
