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
            'message' => "Read the problem statement above.\nEnds inclusive?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Yes, both', 'next' => 's2'],
                ['label' => 'Exclusive end', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. [4]–[4] at 4 counts.\nStep back to when you excluded the end.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Sorting needed?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Sort by start', 'next' => 'wrong_b'],
                ['label' => 'No: one pass', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A single query needs no ordering.\nStep back to when you sorted.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Start after the query time?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Not counted', 'next' => 'success'],
                ['label' => 'Counted', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. That student has not started yet.\nStep back to when you counted them.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). [1,2,3], [3,2,7], 4 → 1. [4], [4], 4 → 1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
