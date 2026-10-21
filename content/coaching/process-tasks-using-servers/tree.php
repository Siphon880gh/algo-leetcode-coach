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
            'message' => "Read the problem statement above.\nFree-server key?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '(weight, index)', 'next' => 's2'],
                ['label' => 'Index only', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The lightest server goes first.\nStep back to when you keyed by index.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "No free server?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Advance time by 1', 'next' => 'wrong_b'],
                ['label' => 'Jump time to the earliest busy finish', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Stepping one second at a time can be very slow.\nStep back to when you ticked by 1.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Task start time when waiting?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The jumped time, not j', 'next' => 'success'],
                ['label' => 'Always j', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. A waiting task starts when a server frees up.\nStep back to when you used j.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O((n + m) log n). Examples → [2,2,0,2,1,2], [1,4,1,4,1,3,2].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
