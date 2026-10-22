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
            'message' => "Read the problem statement above.\nWhat do the operations preserve?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'How many numbers have each bit', 'next' => 's2'],
                ['label' => 'Nothing useful: take the k largest as they are', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Moving bits together pays; example 1 → 100 instead of 261.\nStep back to when you skipped the operations.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "When to reduce mod 10^9 + 7?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only at the end', 'next' => 'wrong_b'],
                ['label' => 'After each square', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. k · (2^30)² exceeds 2^63; 64-bit overflows.\nStep back to when you waited.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(31(n + k)). Examples → 261, 90.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
