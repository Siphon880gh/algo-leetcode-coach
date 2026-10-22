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
            'message' => "Read the problem statement above.\nBefore taking gaps?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Sort the array', 'next' => 's2'],
                ['label' => 'Use the given order', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Neighbours in the input need not be close in value; [1, 10, 2] → 8 instead of 1.\nStep back to when you skipped sorting.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Which gap?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The gap at the middle', 'next' => 'wrong_b'],
                ['label' => 'The smallest adjacent gap', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Any split point is allowed; example 2 → 90 instead of 9.\nStep back to when you split in the middle.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). Examples → 1, 9.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
