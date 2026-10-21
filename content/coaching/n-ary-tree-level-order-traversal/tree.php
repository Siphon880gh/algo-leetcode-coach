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
            'message' => "Read the problem statement above.\nWhat do you try first?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'BFS with a queue, one level per outer loop', 'next' => 's2'],
                ['label' => 'Preorder DFS and append values as you visit', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Preorder DFS visits 1, 3, 5, 6, 2, 4 and loses the level grouping unless you also pass depth.\nStep back to when you chose plain preorder.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Queue holds [1]. The outer loop handles one level.\nHow do you stop the level at the right place?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Pop until the queue is empty, appending children as you go', 'next' => 'wrong_b'],
                ['label' => 'Freeze k = queue length, pop exactly k nodes, enqueue all their children', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Looping until the queue is empty mixes this level with the children you just added.\nStep back to when you chose the loop bound.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Every node is enqueued once: O(n) time, O(n) space. Binary Tree Level Order Traversal (102) only has left and right; N-ary Tree Preorder (589) is DFS.\nLock it in?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Freeze the level size, record values, extend with all children. Not 102 / 589', 'next' => 'success'],
                ['label' => 'Skip nodes whose children list is empty', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. A node with no children still has a value on its level. Skipping it drops values like 5 and 6.\nStep back to when you skipped childless nodes.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Freeze the level size, record each value, enqueue every child. [1,null,3,2,4,null,5,6] → [[1],[3,2,4],[5,6]].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
