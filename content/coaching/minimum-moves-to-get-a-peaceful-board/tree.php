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
            'message' => "Problem: n rooks stand on an n × n board. In one move you shift one rook to an adjacent cell. Return the fewest moves so that every row and every column holds exactly one rook. Limits are in the official statement. (Restated from memory; limits and examples may differ slightly.)\nMoves?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Σ |sorted row − i| + Σ |sorted column − i|', 'next' => 's2'],
                ['label' => 'Count duplicate rows and columns', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. In the guide’s first check → 2 instead of 3.\nStep back to when you counted duplicates.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Sort how?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Rooks by (row, column), one order for both', 'next' => 'wrong_b'],
                ['label' => 'Rows and columns separately', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Rooks at (0, 1) and (1, 0) → 2 instead of 0.\nStep back to when you used one order.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). The guide’s checks → 3, 6.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
