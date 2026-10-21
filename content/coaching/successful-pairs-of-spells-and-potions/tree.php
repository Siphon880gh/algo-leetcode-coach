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
            'message' => "Read the problem statement above.\nSmallest useful potion for spell s?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '⌈success / s⌉', 'next' => 's2'],
                ['label' => '⌊success / s⌋', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Rounding down admits potions that fall short; Example 1 → [5,0,4] instead of [4,0,3].\nStep back to when you rounded down.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Before binary search?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Search them as given', 'next' => 'wrong_b'],
                ['label' => 'Sort the potions', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 2’s potions [8,5,8] are unsorted → [1,0,1] instead of [2,0,2].\nStep back to when you skipped sorting.",
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
            'message' => "You are wrong. success reaches 10^10, past 2^31.\nStep back to when you used 32-bit.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O((n + m) log m). Examples → [4,0,3], [2,0,2].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
