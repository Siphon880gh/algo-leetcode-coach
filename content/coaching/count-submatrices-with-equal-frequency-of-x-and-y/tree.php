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
            'message' => "Read the problem statement above.\nWhich submatrices?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Those containing (0, 0)', 'next' => 's2'],
                ['label' => 'Every submatrix', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Only those containing grid[0][0] count: [[Y, X, Y]] → 2 instead of 1.\nStep back to when you took every submatrix.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "At least one X?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Skip it', 'next' => 'wrong_b'],
                ['label' => 'Require it', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 3 → 4 instead of 0.\nStep back to when you skipped it.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(m n). Examples → 3, 0, 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
