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
                ['label' => 'Keep a running prefix sum from the root and a hash map of prefix counts', 'next' => 's2'],
                ['label' => 'Run a separate path-sum DFS from every node', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Starting a full DFS from every node is O(n²) on a skewed tree, and 112 / 113 only allow root-to-leaf paths.\nStep back to when you restarted from every node.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "At a node, s = sum from the root to here. A path ending here sums to target when an ancestor prefix equals s − target.\nWhat do you do at each node?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'cnt[s] += 1 first, then ans += cnt[s − target], and never decrement', 'next' => 'wrong_b'],
                ['label' => 'ans += cnt[s − target]; cnt[s] += 1; recurse both children; cnt[s] −= 1', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Adding the current prefix before the lookup lets a path of length 0 match when target is 0, and forgetting to remove it leaks counts into sibling subtrees.\nStep back to when you ordered the map updates.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Seed cnt[0] = 1 so a path starting at the root counts. O(n) time, O(n) space. Subarray Sum Equals K (560) is the array version. Use 64-bit sums: values reach 1e9.\nLock it in?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Seed 0 → 1, look up, add, recurse, undo. Not 112 / 113', 'next' => 'success'],
                ['label' => 'Start with an empty map', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Without cnt[0] = 1, a path from the root itself (prefix equal to target) is never counted.\nStep back to when you started with an empty map.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Prefix sums on the root path, seed 0 → 1, look up s − target, undo on the way back. Example → 3.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
