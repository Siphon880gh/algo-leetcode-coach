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
            'message' => "Read the problem statement above.\nBounds?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Check 0 ≤ i, j < n', 'next' => 's2'],
                ['label' => 'Rely on indexing', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Python wraps −1: adjacentSum(1) → 13 instead of 6.\nStep back to when you skipped the check.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "diagonalSum adds?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'All eight neighbours', 'next' => 'wrong_b'],
                ['label' => 'The four diagonal cells', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. diagonalSum(4) → 32 instead of 16.\nStep back to when you took all eight.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(1) per call. Examples → [null, 6, 16, 16, 4], [null, 23, 45].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
