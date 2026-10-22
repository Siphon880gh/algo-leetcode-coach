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
            'message' => "Read the problem statement above.\nBefore counting?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Sort', 'next' => 's2'],
                ['label' => 'Keep input order', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. [1, 4, 2] with k = 3 has power 1, but its input-order gaps give 2.\nStep back to when you skipped sorting.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Add per threshold d_t?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'd_t · cnt(≥ d_t)', 'next' => 'wrong_b'],
                ['label' => '(d_t − d_{t−1}) · cnt(≥ d_t)', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. That counts each power many times: example 3 → 16 instead of 10.\nStep back to when you used d_t.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n³ k). Examples → 4, 0, 10.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
