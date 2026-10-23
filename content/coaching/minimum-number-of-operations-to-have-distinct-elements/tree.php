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
            'message' => "Read the problem statement above.\nScan from?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The right, stopping at the first repeat', 'next' => 's2'],
                ['label' => 'The left, stopping at the first repeat', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Constructed check (run in code): nums = [1, 2, 1, 3, 4, 5, 3] → 1 instead of 2.\nStep back to when you scanned left.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Operations for index i?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '⌊(i + 1) / 3⌋', 'next' => 'wrong_b'],
                ['label' => '⌈(i + 1) / 3⌉', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 1 → 0 instead of 1.\nStep back to when you rounded down.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 1, 1, 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
