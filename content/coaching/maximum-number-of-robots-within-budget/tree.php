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
            'message' => "Read the problem statement above.\nRunning-cost term?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'k · sum(runningCosts)', 'next' => 's2'],
                ['label' => 'sum(runningCosts)', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 → 5 instead of 3.\nStep back to when you dropped the k.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Window maximum after the left end moves?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Keep one running maximum', 'next' => 'wrong_b'],
                ['label' => 'Read it from a decreasing deque', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A removed robot’s charge stays; chargeTimes = [18,9], runningCosts = [1,1], budget = 10 → 0 instead of 1.\nStep back to when you kept a running maximum.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Integer width?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '64-bit', 'next' => 'success'],
                ['label' => '32-bit', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Costs reach about 2.5 · 10^14 and budget 10^15.\nStep back to when you used 32-bit.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 3, 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
