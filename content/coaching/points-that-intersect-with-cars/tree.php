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
            'message' => "Read the problem statement above.\nOverlapping cars?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Merge them', 'next' => 's2'],
                ['label' => 'Add every length', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Shared points count twice; example 1 → 13 instead of 7.\nStep back to when you summed lengths.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Points in [s, e]?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'e − s', 'next' => 'wrong_b'],
                ['label' => 'e − s + 1', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Both ends are points; example 2 → 5 instead of 7.\nStep back to when you dropped the + 1.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). Examples → 7, 7.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
