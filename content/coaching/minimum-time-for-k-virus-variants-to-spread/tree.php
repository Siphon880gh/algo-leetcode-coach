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
            'message' => "Problem: Each of several virus variants starts at its own grid point on day 0 and spreads one step up, down, left or right per day. Return the minimum number of days until some grid point contains at least k distinct variants. For instance, points [[1,1],[6,1]] with k = 2 → 3; [[3,3],[1,2],[9,2]] with k = 2 → 2; and the same points with k = 3 → 4. (Restated from memory; limits and examples may differ slightly.)\nDays for a variant to reach (x, y)?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Manhattan distance', 'next' => 's2'],
                ['label' => 'Chebyshev distance', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Spread is four-directional.\nStep back to when you allowed diagonals.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Cell needs k variants: its day?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Largest distance', 'next' => 'wrong_b'],
                ['label' => 'k-th smallest distance', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Only k variants are needed, not all.\nStep back to when you took the max.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Cells outside the bounding box?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Never better; skip them', 'next' => 'success'],
                ['label' => 'Must be checked', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Clamping inward never increases a distance.\nStep back to when you widened the search.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Constructed check → 3, 2, 4.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
