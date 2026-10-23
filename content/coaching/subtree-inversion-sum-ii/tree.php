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
            'message' => "Problem: You get a tree rooted at node 0 as an edge list, node values nums (some may be negative) and an integer k. Inverting a node multiplies every value in its subtree by −1. Choose any set of nodes to invert, as long as every two chosen nodes are at least k edges apart. Return the largest possible sum of all values. Limits are in the official statement. (Restated from memory; limits and examples may differ slightly.)\nTwo inversions over a node?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'They cancel', 'next' => 's2'],
                ['label' => 'Still negative', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Constructed check (made-up values, run in code): edges [[0, 1], [0, 2], [1, 3]], nums = [−8, −8, 2, 2], k = 2 → 12 instead of 16.\nStep back to when you ignored cancelling.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Which pairs need distance ≥ k?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only ancestor and descendant', 'next' => 'wrong_b'],
                ['label' => 'Every pair of inversions', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong under the restated rule. Constructed check: edges [[0, 1], [0, 2], [0, 3]], nums = [5, −7, −1, −7], k = 4 → 20 instead of 10.\nStep back to when you skipped sibling pairs.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n · k²). Constructed checks → 14, 15.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
