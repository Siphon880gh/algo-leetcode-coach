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
            'message' => "Read the problem statement above.\nx ≥ 2y and x is odd?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Dead end', 'next' => 's2'],
                ['label' => 'Round x / 2 down', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Start (0, 0), target (0, 1) → 1 instead of −1.\nStep back to when you rounded.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "x = y?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Try only (0, y)', 'next' => 'wrong_b'],
                ['label' => 'Try (0, y) and (x, 0)', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Start (1, 0), target (1, 1) → −1 instead of 1.\nStep back to when you tried one branch.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(log max). Examples → 2, 3, −1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
