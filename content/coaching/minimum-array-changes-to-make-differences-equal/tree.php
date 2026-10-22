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
            'message' => "Read the problem statement above.\nPair cost when X ≠ its gap?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '1 if X ≤ max(hi, k − lo), else 2', 'next' => 's2'],
                ['label' => 'Always 1', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. [0, 1, 0, 2, 1, 2], k = 2 → 1 instead of 2.\nStep back to when you charged 1.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Try every X how?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Recount all pairs per X', 'next' => 'wrong_b'],
                ['label' => 'Difference array', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. That is 5 · 10^4 pairs × 10^5 values = 5 · 10^9.\nStep back to when you recounted.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n + k). Examples → 2, 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
