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
            'message' => "Problem: Problem: A binary tree of depth at most 4 is given as a list of three-digit integers: the hundreds digit is the depth (1–4), the tens digit is the position within that level (1–8, as in a full binary tree), and the units digit is the node's value. Return the sum of all root-to-leaf path sums. (Restated from memory; limits and examples may differ slightly.)\nBuild pointer nodes first?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: a map keyed by the first two digits is enough', 'next' => 's2'],
                ['label' => 'Yes, building a full tree', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. That works but is extra code; the key d·10 + p locates any node.\nStep back to when you built nodes.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Children of (d, p)?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '(d + 1, p) and (d + 1, p + 1)', 'next' => 'wrong_b'],
                ['label' => '(d + 1, 2p − 1) and (d + 1, 2p)', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Positions double each level, as in heap indexing.\nStep back to when you used p and p + 1.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "When do you add to the answer?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'At a leaf: neither child key exists, add the running sum', 'next' => 'success'],
                ['label' => 'At every node', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Only complete root-to-leaf paths count.\nStep back to when you added at every node.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. DFS on the map: O(n). [113,215,221] → 12. [113,221] → 4.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
