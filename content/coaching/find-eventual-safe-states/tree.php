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
            'message' => "Read the problem statement above.\nWhat makes a node safe?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Every path from it ends at a terminal node', 'next' => 's2'],
                ['label' => 'Some path from it ends at a terminal node', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. A single path into a cycle makes it unsafe.\nStep back to when you accepted some path.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Which nodes start the queue?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Node 0', 'next' => 'wrong_b'],
                ['label' => 'Terminal nodes, with out-degree 0', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Safety spreads backward from the terminals.\nStep back to when you started at node 0.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "When does node u become safe?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'When its remaining out-degree reaches 0', 'next' => 'success'],
                ['label' => 'When one of its successors becomes safe', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. All of its outgoing edges must lead to safe nodes.\nStep back to when one was enough.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(V + E). [[1,2],[2,3],[5],[0],[5],[],[]] → [2,4,5,6].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
