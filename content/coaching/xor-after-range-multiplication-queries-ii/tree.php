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
            'message' => "Read the problem statement above.\nCancel the factor at?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The first index past r in the progression', 'next' => 's2'],
                ['label' => 'r + 1', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Ten 1s, query [0, 4, 2, 3] → 333333339 instead of 2.\nStep back to when you used r + 1.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Sweep with?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'mul[i] ·= mul[i − 1]', 'next' => 'wrong_b'],
                ['label' => 'mul[i] ·= mul[i − k]', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Ten 1s, query [0, 4, 2, 3] → 0 instead of 2.\nStep back to when you swept with stride 1.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O((n + q) · √n + q log p). Examples → 4, 31.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
