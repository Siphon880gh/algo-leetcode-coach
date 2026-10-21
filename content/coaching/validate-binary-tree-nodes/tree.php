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
            'message' => "Read the problem statement above.\nRoot?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The only node with no parent', 'next' => 's2'],
                ['label' => 'Node 0', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The root can be any node.\nStep back to when you assumed node 0.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "After the in-degree checks?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Return true', 'next' => 'wrong_b'],
                ['label' => 'Check reachability', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A separate cycle can pass the in-degree checks.\nStep back to when you returned early.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Two roots?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'False', 'next' => 'success'],
                ['label' => 'Pick one', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. A forest is not one tree.\nStep back to when you picked one.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). First example → true. Node with two parents → false. Cycle 0 ↔ 1 → false.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
