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
            'message' => "Read the problem statement above.\nEdge weight?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '|x1 − x2| + |y1 − y2|', 'next' => 's2'],
                ['label' => 'Euclidean distance', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The statement uses Manhattan distance.\nStep back to when you used sqrt.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Kruskal or array Prim?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Kruskal over all edges', 'next' => 'wrong_b'],
                ['label' => 'Array Prim: O(n²)', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Sorting ~n²/2 edges is O(n² log n); array Prim avoids it.\nStep back to when you sorted edges.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "After adding a point?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Relax dist for all unvisited points', 'next' => 'success'],
                ['label' => 'Stop', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The tree grew, so distances may shrink.\nStep back to when you stopped.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n²). Example 1 → 20. Example 2 → 18.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
