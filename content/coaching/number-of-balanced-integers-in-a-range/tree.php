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
            'message' => "Read the problem statement above.\nBalanced means?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Odd-position sum = even-position sum', 'next' => 's2'],
                ['label' => 'The digit sum is even', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 → 45 instead of 9.\nStep back to when you used the digit sum.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Range count?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'count(high) − count(low)', 'next' => 'wrong_b'],
                ['label' => 'count(high) − count(low − 1)', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Constructed check (run in code): low = high = 121 → 0 instead of 1.\nStep back to when you dropped low.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(D · 9D · 10). Examples → 9, 1, 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
