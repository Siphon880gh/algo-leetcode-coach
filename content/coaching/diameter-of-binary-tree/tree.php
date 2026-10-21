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
                ['label' => 'Check the bend at every node', 'next' => 's2'],
                ['label' => 'Height of the left subtree + height of the right at the root only', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The longest path may stay inside one subtree and never touch the root.\nStep back to when you only measured through the root.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "dfs returns height.\nWhat do you update?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'ans = max(ans, l + r + 1)', 'next' => 'wrong_b'],
                ['label' => 'ans = max(ans, l + r) with height(null) = 0', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Counting nodes gives 2 for [1,2]; the answer counts edges.\nStep back to when you added 1.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Return 1 + max(l, r). One pass, O(n).\nLock it in?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'One DFS: return height, update l + r', 'next' => 'success'],
                ['label' => 'Compute height from scratch at each node', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Calling height separately for each node is O(n²) on a chain.\nStep back to when you called height per node.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Heights in one pass, best l + r anywhere. → 3.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
