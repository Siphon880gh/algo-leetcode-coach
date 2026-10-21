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
            'message' => "Read the problem statement above.\nVisited key?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '(row, col, removals left)', 'next' => 's2'],
                ['label' => '(row, col)', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Arriving with more removals left is a better state.\nStep back to when you dropped k.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Search type?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'DFS', 'next' => 'wrong_b'],
                ['label' => 'BFS', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Unit steps need BFS for the shortest path.\nStep back to when you used DFS.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "k ≥ m + n − 2?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Return m + n − 2', 'next' => 'success'],
                ['label' => 'Run BFS anyway', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The straight Manhattan path is always possible.\nStep back to when you skipped the shortcut.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(m · n · k). First example, k = 1 → 6. Second → −1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
