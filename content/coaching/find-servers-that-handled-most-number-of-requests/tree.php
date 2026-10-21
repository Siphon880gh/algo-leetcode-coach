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
            'message' => "Read the problem statement above.\nFind the next free server?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Sorted set lower bound with wrap', 'next' => 's2'],
                ['label' => 'Scan k servers', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. That is O(n · k).\nStep back to when you scanned.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Server ending exactly at arrival?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Still busy', 'next' => 'wrong_b'],
                ['label' => 'Free for it', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. end ≤ arrival means it is available.\nStep back to when you kept it busy.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "No free server?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Drop the request', 'next' => 'success'],
                ['label' => 'Queue it', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Requests are dropped, not queued.\nStep back to when you queued.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log k). Examples → [1], [0], [0,1,2].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
