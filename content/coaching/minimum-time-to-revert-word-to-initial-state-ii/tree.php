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
            'message' => "Read the problem statement above.\nCompare each suffix directly?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No, Z-function', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. At k = 1 that is about 10^12 steps for n = 10^6.\nStep back to when you compared directly.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Condition at t?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'z[t·k] ≥ k', 'next' => 'wrong_b'],
                ['label' => 'z[t·k] ≥ n − t·k', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The whole suffix must match; example 1 → 3 instead of 2.\nStep back to when you used k.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 2, 1, 4.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
