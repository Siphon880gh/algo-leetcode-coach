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
            'message' => "Problem: You are given a weighted tree rooted at node 0, described by each node’s parent and the weight of the edge to that parent (the root has none). Choose a set of edges so that no two chosen edges share a node, maximising the total weight; choosing no edges gives 0, so negative edges are never needed. For instance, root 0 with children 1 (weight 5) and 2 (weight 10), and node 2 with children 3 (weight 6) and 4 (weight 4) → 11; a path whose edges weigh −3 and −2 → 0. (Restated from memory; limits and examples may differ slightly.)\nValues per node?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Best with the node free, and best overall', 'next' => 's2'],
                ['label' => 'Only the best overall', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. You cannot tell whether a child is still free; the first constructed tree → 16 instead of 11.\nStep back to when you kept one value.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Edges to children a node may use?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Every positive one', 'next' => 'wrong_b'],
                ['label' => 'At most one', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Root 0 with children of weight 5 and 10 → 15 instead of 10.\nStep back to when you used several child edges.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Best swap is negative?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Skip it and keep the node free', 'next' => 'success'],
                ['label' => 'Take it anyway', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The path with weights −3 and −2 → −3 instead of 0.\nStep back to when you forced a swap.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Constructed checks → 11, 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
