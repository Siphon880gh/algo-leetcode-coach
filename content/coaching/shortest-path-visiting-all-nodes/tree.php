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
            'message' => "Read the problem statement above.\nUse a visited set over nodes?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: the state is (node, visited mask)', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The best path often passes through a node twice.\nStep back to when you marked nodes.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Start the BFS from where?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Node 0', 'next' => 'wrong_b'],
                ['label' => 'Every node at once, each at distance 0', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The path may start at any node.\nStep back to when you fixed node 0.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "When do you stop?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'When you pop a state whose mask has every bit set', 'next' => 'success'],
                ['label' => 'When the queue is empty', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. BFS reaches the full mask first at the shortest distance.\nStep back to when you drained the queue.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(2ⁿ · n²). [[1,2,3],[0],[0],[0]] → 4. [[1],[0,2,4],[1,3,4],[2],[1,2]] → 4.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
