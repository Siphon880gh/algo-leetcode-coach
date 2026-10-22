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
            'message' => "Read the problem statement above.\nRun of m, length L ≥ 2?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '⌊m / (L + 1)⌋ flips', 'next' => 's2'],
                ['label' => '⌊m / L⌋ flips', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. 00000, numOps = 1 → 3 instead of 2.\nStep back to when you divided by L.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Find L?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Try each L', 'next' => 'wrong_b'],
                ['label' => 'Binary search (flips never grow as L grows)', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. With n up to 10^5 that is about 10^10 steps.\nStep back to when you tried each L.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). Examples → 2, 1, 1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
