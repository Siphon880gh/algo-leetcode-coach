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
            'message' => "Problem: Nodes labelled 1 … n form a rooted tree with the shape the statement describes. Every node starts with value 0. Each query names a node and flips the value of every node in its subtree. Return how many nodes hold 1 after all queries. For instance, querying the same node twice leaves every value at 0, so the answer is 0, and querying the root once turns all n nodes to 1, so the answer is n. (Restated from memory; limits and examples may differ slightly.)\nA node’s final value?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Its own query parity XOR its parent’s final value', 'next' => 's2'],
                ['label' => 'Its own query parity only', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. A query flips the whole subtree; querying the root once → 1 instead of n.\nStep back to when you ignored the ancestors.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Visit order?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Children before parents', 'next' => 'wrong_b'],
                ['label' => 'Parents before children', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A child then reads its parent’s value before it is set; querying the root once → 1 instead of n.\nStep back to when you started from the leaves.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n + q). Constructed checks → 0, n, n − 1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
