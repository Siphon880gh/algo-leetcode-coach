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
            'message' => "Read the problem statement above.\nTie order on equal x?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'y descending', 'next' => 's2'],
                ['label' => 'y ascending', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. [[1, 1], [1, 2], [2, 3]], k = 2 → 3 instead of 2.\nStep back to when you sorted y ascending.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Left side keeps?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'x ≤ x_k and y ≤ y_k', 'next' => 'wrong_b'],
                ['label' => 'x < x_k and y < y_k', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. [[2, 1], [2, 4], [3, 5]], k = 1 → 3 instead of 2.\nStep back to when you allowed equality.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). Examples → 3, 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
