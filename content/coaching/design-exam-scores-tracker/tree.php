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
            'message' => "Read the problem statement above.\nLeft end of a query?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'First time ≥ startTime', 'next' => 's2'],
                ['label' => 'First time > startTime', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. totalScore(1, 1) → 0 instead of 98.\nStep back to when you skipped time 1.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Right end of a query?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'First time ≥ endTime', 'next' => 'wrong_b'],
                ['label' => 'First time > endTime', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. totalScore(1, 5) → 98 instead of 197.\nStep back to when you cut off time 5.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(log n) per query. Example → [null, null, 98, null, 98, 197, 0, 99].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
