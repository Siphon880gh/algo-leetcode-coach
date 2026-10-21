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
            'message' => "Read the problem statement above.\nUnits?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Total minutes', 'next' => 's2'],
                ['label' => 'Hours and minutes separately', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. 01:50 → 02:05 is 15 minutes, but the minute part alone goes backwards.\nStep back to when you split hours and minutes.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Step order?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '1 first', 'next' => 'wrong_b'],
                ['label' => '60, 15, 5, 1', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Using 1s first wastes operations; Example 1 (125 minutes) would take 125.\nStep back to when you started with 1.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Which steps?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'All of 60, 15, 5 and 1', 'next' => 'success'],
                ['label' => 'Only 60, 15 and 1', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Example 1 → 7 instead of 3; the last 5 minutes need one 5-step.\nStep back to when you dropped 5.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(1). Examples → 3, 1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
