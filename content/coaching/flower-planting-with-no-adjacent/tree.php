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
            'message' => "Read the problem statement above.\nNeed backtracking?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: degree ≤ 3 means a free type always exists', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Three neighbours block at most three of four types.\nStep back to when you backtracked.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "How do you store paths?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only x → y', 'next' => 'wrong_b'],
                ['label' => 'Both directions in an adjacency list', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Paths are bidirectional.\nStep back to when you stored one direction.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Garden g. Which types are blocked?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Those of its already planted neighbours', 'next' => 'success'],
                ['label' => 'Those of garden g − 1', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Only connected gardens matter.\nStep back to when you checked g − 1.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n + paths). n = 3, [[1,2],[2,3],[3,1]] → [1,2,3]. n = 4, [[1,2],[3,4]] → [1,2,1,2]. n = 4, all six pairs → [1,2,3,4].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
