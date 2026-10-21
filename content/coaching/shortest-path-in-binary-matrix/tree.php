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
            'message' => "Read the problem statement above.\nDFS or BFS?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'BFS', 'next' => 's2'],
                ['label' => 'DFS', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. DFS finds a path, not the shortest one.\nStep back to when you chose DFS.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Which moves?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Four directions', 'next' => 'wrong_b'],
                ['label' => 'All eight directions', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Diagonal moves are allowed.\nStep back to when you used four.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Start cell is 1. Answer?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '−1', 'next' => 'success'],
                ['label' => 'Search anyway', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The path must start on a clear cell.\nStep back to when you searched anyway.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n²). [[0,1],[1,0]] → 2. [[0,0,0],[1,1,0],[1,1,0]] → 4. [[1,0,0],[1,1,0],[1,1,0]] → −1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
