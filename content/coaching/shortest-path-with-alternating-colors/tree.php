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
            'message' => "Read the problem statement above.\nVisited per node only?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: per (node, last color)', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Reaching a node by red does not cover reaching it by blue.\nStep back to when you tracked nodes only.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Start state?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Node 0 with red only', 'next' => 'wrong_b'],
                ['label' => 'Node 0 with both colors at distance 0', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The first edge can be either color.\nStep back to when you started with red only.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "From a state reached by red, follow?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Blue edges', 'next' => 'success'],
                ['label' => 'Red edges', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Colors must alternate.\nStep back to when you followed red.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n + edges). n = 3, red [[0,1],[1,2]], blue [] → [0,1,−1]. n = 3, red [[0,1]], blue [[2,1]] → [0,1,−1].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
