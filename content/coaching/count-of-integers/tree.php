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
            'message' => "Read the problem statement above.\nCount how?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Digit DP over (position, digit sum, tight)', 'next' => 's2'],
                ['label' => 'Check every number in the range', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. The bounds have up to 22 digits, far too many numbers to visit.\nStep back to when you iterated.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Combine the counts?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'count(num2) − count(num1)', 'next' => 'wrong_b'],
                ['label' => 'count(num2) − count(num1) + good(num1)', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Subtracting count(num1) removes num1 too; example 1 → 10 instead of 11.\nStep back to when you dropped num1.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(L · max_sum · 10). Examples → 11, 5.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
