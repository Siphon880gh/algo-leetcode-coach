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
            'message' => "Read the problem statement above.\nCost of remainder 2?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '1 (add one)', 'next' => 's2'],
                ['label' => '2 (subtract two)', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 → 4 instead of 3.\nStep back to when you charged 2.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Count which values?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'x mod 3 = 1', 'next' => 'wrong_b'],
                ['label' => 'x mod 3 ≠ 0', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 1 → 2 instead of 3.\nStep back to when you counted only remainder 1.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 3, 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
