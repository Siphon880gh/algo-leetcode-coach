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
            'message' => "Read the problem statement above.\nBounds for the ranges where i is picked?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Left ≥ score, right > score', 'next' => 's2'],
                ['label' => 'The same test on both sides', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Ties go to the smaller index; [10, 7, 24, 1, 29, 27] with k = 5 → 13079232 instead of 19096587.\nStep back to when you used one test.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Spend k on?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Indices from left to right', 'next' => 'wrong_b'],
                ['label' => 'The largest values first', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Small values waste operations; example 1 → 64 instead of 81.\nStep back to when you went by index.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). Examples → 81, 4788.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
