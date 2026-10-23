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
            'message' => "Read the problem statement above.\nAllowed first indices for last j?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Up to j − m + 1', 'next' => 's2'],
                ['label' => 'Up to j − m', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 → 27 instead of 81.\nStep back to when you shifted by one.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Track which extremes?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only the max', 'next' => 'wrong_b'],
                ['label' => 'Both max and min', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 1 → 9 instead of 81.\nStep back to when you dropped the min.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 81, 20, 35.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
