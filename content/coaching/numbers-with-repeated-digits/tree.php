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
            'message' => "Read the problem statement above.\nCount repeated-digit numbers directly?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: count the distinct-digit ones and subtract', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Repeats are hard to count without double counting.\nStep back to when you counted repeats.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Distinct-digit numbers with L digits, L shorter than n?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'P(10, L)', 'next' => 'wrong_b'],
                ['label' => '9 · P(9, L − 1)', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. That allows a leading zero.\nStep back to when you used P(10, L).",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Walking n's digits, the current digit is already used. Then?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Stop; nothing longer on this prefix is distinct', 'next' => 'success'],
                ['label' => 'Skip it and continue', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Every number with this prefix repeats a digit.\nStep back to when you continued.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(digits · 10). n = 20 → 1. n = 100 → 10. n = 1000 → 262.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
