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
            'message' => "Read the problem statement above.\nWhat does each BFS level count?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Buses taken', 'next' => 's2'],
                ['label' => 'Stops passed', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Riding many stops on one bus still costs one.\nStep back to when you counted stops.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "How do you find the routes reachable from a route?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Compare it with every other route', 'next' => 'wrong_b'],
                ['label' => 'Through each of its stops, via a stop → routes map', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The map avoids testing every pair of routes.\nStep back to when you compared all routes.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "source == target. Answer?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '0', 'next' => 'success'],
                ['label' => '1', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. You are already there without a bus.\nStep back to when you returned 1.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(Σ route lengths). [[1,2,7],[3,6,7]], source 1, target 6 → 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
