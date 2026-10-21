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
                ['label' => 'Postorder: a node\'s sum = val + left sum + right sum', 'next' => 's2'],
                ['label' => 'For each node, run a new traversal to sum its subtree', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Recomputing each subtree from scratch is O(n²) on a skewed tree.\nStep back to when you summed each subtree separately.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "dfs returns the sum.\nWhat else does it do?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Count sums only at leaves', 'next' => 'wrong_b'],
                ['label' => 'cnt[s] += 1 for every node, then return s', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Only leaves would be counted; every subtree needs its sum counted.\nStep back to when you counted only at leaves.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "After the pass, mx = max count; return every s with cnt[s] == mx. O(n).\nLock it in?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Postorder sums, counter, return all ties', 'next' => 'success'],
                ['label' => 'Return just one sum with the max count', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. In [5,2,−3], all three sums tie with count 1. One sum is not enough.\nStep back to when you returned one sum.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Postorder sums, a counter, and every tie. [5,2,−3] → [2,−3,4].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
