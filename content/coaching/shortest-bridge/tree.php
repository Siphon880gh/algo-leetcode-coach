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
            'message' => "Read the problem statement above.\nBFS from one cell of the first island?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: from all its cells at once', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The bridge may start at another cell of that island.\nStep back to when you started from one cell.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "How do you find the first island?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Take the first row', 'next' => 'wrong_b'],
                ['label' => 'DFS from any land cell, marking it', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The island can be anywhere.\nStep back to when you assumed its location.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "What does the BFS level mean when you reach the other island?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The number of water cells to flip', 'next' => 'success'],
                ['label' => 'The number of land cells', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Each level crosses one more water cell.\nStep back to when you counted land.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n²). [[0,1],[1,0]] → 1. [[0,1,0],[0,0,0],[0,0,1]] → 2. [[1,1,1,1,1],[1,0,0,0,1],[1,0,1,0,1],[1,0,0,0,1],[1,1,1,1,1]] → 1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
