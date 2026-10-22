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
            'message' => "Problem: A rooted tree has a value on every node. Pick two subtrees that share no node, and score them by the XOR of their sums. Return the largest score, or 0 if no two such subtrees exist. For instance, a path 0 – 1 – 2 rooted at 0 → 0, since every pair of subtrees nests; a root with value 5 and two leaf children with values 2 and 3 → 1. (Restated from memory; limits and examples may differ slightly.)\nInsert a subtree sum when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'After its children are done', 'next' => 's2'],
                ['label' => 'As soon as you enter the node', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Ancestors then pair with their own descendants; a root of 5 with leaf children 2 and 3 → 9 instead of 1.\nStep back to when you inserted on entry.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Query the trie when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'On leaving it, after its children', 'next' => 'wrong_b'],
                ['label' => 'On entering the node, before its children', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. By then its own descendants are in the trie; the same tree → 9 instead of 1.\nStep back to when you queried on exit.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n · bits). Constructed checks → 0, 1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
