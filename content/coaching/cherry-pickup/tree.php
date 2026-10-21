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
            'message' => "Read the problem statement above.\nTake the best path down, then the best path back?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: the first path can spoil the second; optimize both together', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Greedy round trips can miss cherries that a joint plan collects.\nStep back to when you went greedy.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "What is the DP state?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '(r1, c1, r2, c2) with no link between them', 'next' => 'wrong_b'],
                ['label' => '(t, r1, r2): steps taken and both rows; columns follow from t − r', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. That works but wastes a dimension; equal step counts tie the columns to the rows.\nStep back to when you used four free coordinates.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Both walkers stand on the same cell. Gain?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Its cherries once', 'next' => 'success'],
                ['label' => 'Twice', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. A cherry can only be picked once.\nStep back to when you counted it twice.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n³) DP. [[0,1,-1],[1,0,-1],[1,1,1]] → 5. [[1,1,-1],[1,-1,1],[-1,1,1]] → 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
