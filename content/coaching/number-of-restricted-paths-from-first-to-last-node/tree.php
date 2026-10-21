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
            'message' => "Read the problem statement above.\nDijkstra source?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Node n', 'next' => 's2'],
                ['label' => 'Node 1', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The restriction uses distance to the last node.\nStep back to when you started at 1.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Why no cycles?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Cycles are possible', 'next' => 'wrong_b'],
                ['label' => 'Each step strictly lowers dist', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Strictly decreasing distances form a DAG.\nStep back to when you feared cycles.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "DP order?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Increasing dist from n', 'next' => 'success'],
                ['label' => 'Node label order', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. A node needs its smaller-distance neighbours done first.\nStep back to when you used labels.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(E log n). Examples → 3, 1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
