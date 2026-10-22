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
            'message' => "Read the problem statement above.\nProcess the limits in?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Ascending order', 'next' => 's2'],
                ['label' => 'The given order', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Big limits early overcount; [4, 1, 1, 4] → 4 instead of 3.\nStep back to when you skipped sorting.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Add a group when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The current limit ≥ k + 1', 'next' => 'wrong_b'],
                ['label' => 'The running total ≥ (k + 1)(k + 2) / 2', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Spare uses carry over; [2, 2, 2] → 2 instead of 3.\nStep back to when you checked one limit.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n), with a 64-bit total. Examples → 3, 2, 1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
