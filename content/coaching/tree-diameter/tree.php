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
            'message' => "Problem: Given the edges of an undirected tree, return the number of edges on its longest path. For instance, [[0,1],[0,2]] gives 2 and [[0,1],[1,2],[2,3],[1,4],[4,5]] gives 4. (Restated from memory; limits and examples may differ slightly.)\nBFS from every node?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: two passes', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. That is O(n²).\nStep back to when you ran n searches.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Why does the second pass start at u?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'u is the root', 'next' => 'wrong_b'],
                ['label' => 'u is an end of some longest path', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The tree has no special root; u is chosen as farthest.\nStep back to when you called it the root.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Count edges or nodes?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Edges', 'next' => 'success'],
                ['label' => 'Nodes', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The answer is the number of edges.\nStep back to when you counted nodes.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). [[0,1],[0,2]] → 2. [[0,1],[1,2],[2,3],[1,4],[4,5]] → 4.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
