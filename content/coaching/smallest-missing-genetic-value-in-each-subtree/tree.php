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
            'message' => "Read the problem statement above.\nA subtree without value 1?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Its answer is 1', 'next' => 's2'],
                ['label' => 'Search it like any other', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. If 1 is absent, 1 is the smallest missing value; no search needed.\nStep back to when you searched it.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Which nodes need real work?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Every node', 'next' => 'wrong_b'],
                ['label' => 'The node holding 1 and its ancestors', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Only subtrees containing 1 can miss something larger, and those are exactly that path.\nStep back to when you processed every node.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Moving up to the parent, which nodes do you add?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only nodes not added before', 'next' => 'success'],
                ['label' => 'The parent\'s whole subtree again', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. On a chain of 10^5 nodes that is O(n²); each node needs adding once.\nStep back to when you re-added subtrees.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n + V). Examples → [5,1,1,1], [7,1,1,4,2,1], [1,1,1,1,1,1,1].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
