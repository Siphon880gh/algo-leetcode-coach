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
            'message' => "Problem: Given the root of a binary tree and two node values p and q (both present), return the number of edges on the path between those two nodes. For instance, in the tree [3,5,1,6,2,0,8,null,null,7,4], p = 5 and q = 0 are 3 apart, p = 7 and q = 4 are 2 apart, and a node is 0 from itself. (Restated from memory; limits and examples may differ slightly.)\nDistance formula?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'depth(p) + depth(q) − 2 · depth(LCA)', 'next' => 's2'],
                ['label' => 'depth(p) + depth(q)', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The path never climbs above the LCA.\nStep back to when you added the root depths.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "p equals q?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Search for a second copy', 'next' => 'wrong_b'],
                ['label' => 'Return 0 at once', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Values are unique, so it is the same node.\nStep back to when you searched again.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Single pass possible?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Yes: return the distance up from found nodes', 'next' => 'success'],
                ['label' => 'No, three traversals are needed', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. One DFS can carry distances back up.\nStep back to when you insisted on three passes.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n), O(h). Constructed check → 3, 2, 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
