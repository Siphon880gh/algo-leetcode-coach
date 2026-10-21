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
            'message' => "Problem: Problem: Given a binary tree with unique values and a value k, return the value of the leaf nearest (in edges) to the node with value k; paths may go up through parents. (Restated from memory; limits and examples may differ slightly.)\nSearch only the subtree below k?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: the nearest leaf may be through a parent', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. A leaf one step from k's parent can beat any leaf below k.\nStep back to when you only looked down.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "How do you move upward?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Restart from the root each time', 'next' => 'wrong_b'],
                ['label' => 'Record each node\'s parent in one DFS', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Parent links make the tree an undirected graph.\nStep back to when you restarted from the root.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Why BFS and not DFS?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'BFS visits nodes in order of distance, so the first leaf is closest', 'next' => 'success'],
                ['label' => 'DFS is just as good', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. DFS can find a far leaf first.\nStep back to when you chose DFS.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). [1,3,2], k = 1 → 2 (or 3). [1,2,3,4,null,null,null,5,null,6], k = 2 → 3.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
