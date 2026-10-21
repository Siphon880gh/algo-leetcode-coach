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
            'message' => "Read the problem statement above.\nHow big is the state space?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '6! = 720 boards, so BFS is fine', 'next' => 's2'],
                ['label' => 'Too large; use A* only', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. 720 states is tiny.\nStep back to when you ruled out BFS.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Index 2 and index 3 in the string. Neighbors?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Yes: they are adjacent in the string', 'next' => 'wrong_b'],
                ['label' => 'No: they are at the end of row 0 and the start of row 1', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Grid adjacency differs from string adjacency; use a neighbor table.\nStep back to when you used index ± 1.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "The queue empties without the goal. Return?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '-1: half the boards cannot reach it', 'next' => 'success'],
                ['label' => '0', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Unreachable boards have no solution.\nStep back to when you returned 0.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. BFS over at most 720 states. [[1,2,3],[4,0,5]] → 1. [[1,2,3],[5,4,0]] → -1. [[4,1,2],[5,0,3]] → 5.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
