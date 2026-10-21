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
            'message' => "Read the problem statement above.\nLeft child of (row, col)?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '(row + 1, col − 1)', 'next' => 's2'],
                ['label' => '(row + 1, col)', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Left children move one column to the left.\nStep back to when you kept the column.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Two nodes share a row and column. Order?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'By visit order', 'next' => 'wrong_b'],
                ['label' => 'By value', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The problem sorts ties by value.\nStep back to when you used visit order.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "How do you handle negative columns?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Use a map, or sort the triples and group', 'next' => 'success'],
                ['label' => 'Ignore them', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Left subtrees produce negative columns.\nStep back to when you ignored them.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). [3,9,20,null,null,15,7] → [[9],[3,15],[20],[7]]. [1,2,3,4,5,6,7] → [[4],[2],[1,5,6],[3],[7]].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
