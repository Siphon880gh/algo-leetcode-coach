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
            'message' => "Read the problem statement above.\nWhich distance?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '|r − rCenter| + |c − cCenter|', 'next' => 's2'],
                ['label' => 'Euclidean distance', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The problem uses Manhattan distance.\nStep back to when you used Euclidean.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "How many buckets?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'rows · cols', 'next' => 'wrong_b'],
                ['label' => 'rows + cols − 1', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Distances only reach rows + cols − 2.\nStep back to when you made one per cell.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Two cells share a distance. Order?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Any order is accepted', 'next' => 'success'],
                ['label' => 'Sort them by row', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Ties can come in any order.\nStep back to when you sorted ties.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(R · C). rows = 1, cols = 2, center (0,0) → [[0,0],[0,1]]. rows = 2, cols = 2, center (0,1) → [[0,1],[0,0],[1,1],[1,0]].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
