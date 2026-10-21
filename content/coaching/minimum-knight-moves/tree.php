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
            'message' => "Problem: On an infinite chessboard, a knight starts at (0, 0). Return the minimum number of moves to reach (x, y). For instance, (2, 1) takes 1, (1, 1) takes 2, and (5, 5) takes 4. (Restated from memory; limits and examples may differ slightly.)\nSearch all four quadrants?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: use |x|, |y| by symmetry', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The search would be four times larger.\nStep back to when you kept all quadrants.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Allow negative coordinates?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: stay at 0 or above', 'next' => 'wrong_b'],
                ['label' => 'Yes, down to −2', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Reaching (1, 1) needs a step through a negative coordinate.\nStep back to when you blocked negatives.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "DFS or BFS?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'BFS', 'next' => 'success'],
                ['label' => 'DFS', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. DFS does not find shortest paths.\nStep back to when you chose DFS.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(|x| · |y|). (2, 1) → 1. (1, 1) → 2. (5, 5) → 4.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
