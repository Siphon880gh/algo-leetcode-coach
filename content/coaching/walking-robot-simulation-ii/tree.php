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
            'message' => "Read the problem statement above.\nMove num cells how?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Index into the precomputed border with mod', 'next' => 's2'],
                ['label' => 'Walk one cell at a time', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. num can be 10^5 per call, and there are up to 10^4 calls.\nStep back to when you walked cell by cell.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Border length?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '2(w + h)', 'next' => 'wrong_b'],
                ['label' => '2(w + h) − 4', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. That counts the four corners twice.\nStep back to when you used 2(w + h).",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Direction at (0, 0)?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'East before any move, South after moving', 'next' => 'success'],
                ['label' => 'Always East', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. After a full lap the robot arrives at (0, 0) moving South.\nStep back to when you fixed East.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(w + h) setup, O(1) per call. Example 1 → [4,0], East, [1,2], West.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
