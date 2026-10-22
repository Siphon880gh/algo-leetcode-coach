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
            'message' => "Read the problem statement above.\nAn odd number of negatives?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Drop the one closest to zero', 'next' => 's2'],
                ['label' => 'Drop the most negative', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. That throws away the biggest factor; example 1 → 150 instead of 1350.\nStep back to when you dropped the most negative.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Nothing left to multiply, as in [0, −5]?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Return the empty product 1', 'next' => 'wrong_b'],
                ['label' => 'Return the largest element', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The group must be non-empty; [0, −5] → 1 instead of 0.\nStep back to when you returned 1.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). Examples → 1350, 20.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
