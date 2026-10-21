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
            'message' => "Read the problem statement above.\nBucket index of t?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '(t − start) / size', 'next' => 's2'],
                ['label' => 't / size', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Buckets are measured from the start time.\nStep back to when you used t / size.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Last partial chunk?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Dropped', 'next' => 'wrong_b'],
                ['label' => 'Gets its own bucket', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Every chunk up to end appears.\nStep back to when you dropped it.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Empty buckets?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Report 0', 'next' => 'success'],
                ['label' => 'Omit them', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Zeros must appear.\nStep back to when you omitted them.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Times 0, 60, 10: minute [0, 59] → [2], [0, 60] → [2,1]. After 120, hour [0, 210] → [4].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
