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
            'message' => "Problem: Given the root of a binary tree and a node u in it, return the node immediately to the right of u on the same level, or null if u is the rightmost node on its level. For instance, in [1,2,3,null,4,5,6] the node to the right of 4 is 5. (Restated from memory; limits and examples may differ slightly.)\nTraversal?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'BFS level by level', 'next' => 's2'],
                ['label' => 'Inorder DFS', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Inorder mixes levels.\nStep back to when you used inorder.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "u is last in its level?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Return the first node of the next level', 'next' => 'wrong_b'],
                ['label' => 'Return null', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The next level is not the same level.\nStep back to when you crossed levels.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Compare by?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Node identity', 'next' => 'success'],
                ['label' => 'Value only', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Values may repeat in general.\nStep back to when you compared values.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Constructed check: u = 4 → 5; u = 3 → null.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
