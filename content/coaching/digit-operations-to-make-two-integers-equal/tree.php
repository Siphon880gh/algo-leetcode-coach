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
            'message' => "Read the problem statement above.\nSearch?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Dijkstra with cost = value entered', 'next' => 's2'],
                ['label' => 'BFS for fewest operations', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. n = 10, m = 45 → 261 instead of 252.\nStep back to when you minimized steps.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Start value?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Left out', 'next' => 'wrong_b'],
                ['label' => 'Counted in the cost', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 1 → 75 instead of 85.\nStep back to when you left n out.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(V log V). Examples → 85, −1, −1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
