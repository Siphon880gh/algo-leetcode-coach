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
            'message' => "Read the problem statement above.\nKey each row by?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Its tuple of values', 'next' => 's2'],
                ['label' => 'Its sum', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Different rows share sums; Example 1 → 3 instead of 1.\nStep back to when you keyed by sum.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "A column matches a row when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Same values in any order', 'next' => 'wrong_b'],
                ['label' => 'Same values in the same order', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 1 → 3 instead of 1.\nStep back to when you ignored order.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "A column matches two equal rows?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Count both pairs', 'next' => 'success'],
                ['label' => 'Count it once', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Pairs are (row, column); Example 2 → 2 instead of 3.\nStep back to when you counted once.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n²). Examples → 1, 3.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
