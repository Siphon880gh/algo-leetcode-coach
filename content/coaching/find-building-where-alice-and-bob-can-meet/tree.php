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
            'message' => "Read the problem statement above.\nWith a < b and h[a] < h[b]?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Answer b', 'next' => 's2'],
                ['label' => 'Search right of b', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Alice can move to b; example 2 → [−1, 6, −1, 4, 7] instead of [7, 6, −1, 4, 6].\nStep back to when you searched.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Height test?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Greater or equal', 'next' => 'wrong_b'],
                ['label' => 'Strictly greater', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. heights [3, 3, 5] with query [0, 1] → 1 instead of 2.\nStep back to when you allowed equal heights.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O((n + q) log n). Examples → [2, 5, −1, 5, 2], [7, 6, −1, 4, 6].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
