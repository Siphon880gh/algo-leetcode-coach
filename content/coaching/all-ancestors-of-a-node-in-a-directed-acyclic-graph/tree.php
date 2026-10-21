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
            'message' => "Read the problem statement above.\nAncestors of v?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Every node with a path to v', 'next' => 's2'],
                ['label' => 'Only direct parents', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 node 6 has ancestors [0,1,2,3,4], not just 3 and 4.\nStep back to when you took parents only.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Visited set?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'One shared across all sources', 'next' => 'wrong_b'],
                ['label' => 'A fresh one per source', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Later sources could not pass nodes an earlier source already reached.\nStep back to when you shared the set.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Order of each list?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Sources 0 … n − 1 in order give sorted lists', 'next' => 'success'],
                ['label' => 'Append in DFS order from each node upward', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Ancestors found upward come in path order, not ascending order.\nStep back to when you collected upward without sorting.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n · (n + E)). Example 1 matches.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
