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
            'message' => "State:\njump game [2,3,1,1,4]\n\nTrack?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Farthest reachable index', 'next' => 'mid'],
                ['label' => 'Earliest interval end', 'next' => 'w1'],
            ],
        ],
        'w1' => [
            'message' => "Wrong.\n\nJump game tracks farthest.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'mid' => [
            'message' => "State:\ni > farthest mid scan\n\n?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Cannot reach the end', 'next' => 'final'],
                ['label' => 'Always still possible', 'next' => 'w2'],
            ],
        ],
        'w2' => [
            'message' => "Wrong.\n\nYou already cannot stand on i.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'mid',
            'choices' => [],
        ],
        'final' => [
            'message' => "State:\ninterval scheduling key?\n\n",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Earliest finishing time', 'next' => 'success'],
                ['label' => 'Farthest jump', 'next' => 'w3'],
            ],
        ],
        'w3' => [
            'message' => "Wrong.\n\nScheduling uses end times.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'final',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct.\n\n- Cue → greedy key\n- Jump uses farthest\n\nYou finished this path.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
