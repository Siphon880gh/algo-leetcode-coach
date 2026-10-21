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
            'message' => "Read the problem statement above.\nIterate a full grid?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: only existing cells', 'next' => 's2'],
                ['label' => 'Yes, pad to max width', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Padding can be huge for jagged rows.\nStep back to when you padded.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Order within a diagonal?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Smaller row first', 'next' => 'wrong_b'],
                ['label' => 'Larger row first', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The traversal goes up-right.\nStep back to when you went down.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Alternative?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'BFS from (0,0): down, then right', 'next' => 'success'],
                ['label' => 'Sort all cells by value', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Values are not positions.\nStep back to when you sorted values.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(N). [[1,2,3],[4,5,6],[7,8,9]] → [1,4,2,7,5,3,8,6,9].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
