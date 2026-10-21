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
            'message' => "Read the problem statement above.\nBFS from every node?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: in-degree decides', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. That is O(n · E).\nStep back to when you searched.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Why exactly the sources?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Sources have most edges', 'next' => 'wrong_b'],
                ['label' => 'A source is reachable only from itself', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Out-degree is irrelevant.\nStep back to when you counted out-edges.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Cycles?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'None: the graph is a DAG', 'next' => 'success'],
                ['label' => 'Must handle them', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The statement guarantees acyclic.\nStep back to when you handled cycles.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n + E). Example 1 → [0,3]. Example 2 → [0,2,3].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
