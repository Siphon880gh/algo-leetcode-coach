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
            'message' => "Read the problem statement above.\nWalk until?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'You reach −1 or a node already visited', 'next' => 's2'],
                ['label' => 'You reach −1', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Cycles never end; edges = [1,0] loops forever.\nStep back to when you only stopped at −1.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Minimise what?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'd1 + d2', 'next' => 'wrong_b'],
                ['label' => 'max(d1, d2)', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. edges = [2,2,3,1,0], node1 = 3, node2 = 4 → 3 instead of 2.\nStep back to when you used the sum.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Ties?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The smallest index', 'next' => 'success'],
                ['label' => 'The first node met along node1’s walk', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. edges = [1,0], node1 = 1, node2 = 0 → 1 instead of 0.\nStep back to when you used walk order.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 2, 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
