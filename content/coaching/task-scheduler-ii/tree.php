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
            'message' => "Read the problem statement above.\nBreaks?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Jump straight to the earliest allowed day', 'next' => 's2'],
                ['label' => 'Advance one break day at a time', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Days reach 10^10, far too many steps.\nStep back to when you advanced day by day.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Earliest day for a repeated type?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'max(day + 1, last + space)', 'next' => 'wrong_b'],
                ['label' => 'max(day + 1, last + space + 1)', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. space full days must pass in between; Example 1 → 7 instead of 9.\nStep back to when you dropped the + 1.",
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
            'message' => "You are wrong. 10^5 tasks of one type with space = 10^5 take 10^10 days.\nStep back to when you used 32-bit.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 9, 6.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
