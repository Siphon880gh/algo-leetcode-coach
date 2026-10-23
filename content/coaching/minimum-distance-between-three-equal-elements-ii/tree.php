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
            'message' => "Read the problem statement above.\nWhich triples per value?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Every window of three consecutive positions', 'next' => 's2'],
                ['label' => 'Only the first three positions', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Constructed check (run in code): [1, 2, 3, 1, 4, 5, 1, 1, 2, 6, 2] → 12 instead of 8.\nStep back to when you took the first three.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Distance?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'pos[t + 2] − pos[t]', 'next' => 'wrong_b'],
                ['label' => '2 · (pos[t + 2] − pos[t])', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 1 → 3 instead of 6.\nStep back to when you dropped the 2.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 6, 8, −1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
