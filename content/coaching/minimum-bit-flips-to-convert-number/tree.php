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
            'message' => "Read the problem statement above.\nWhich bits differ?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'start XOR goal', 'next' => 's2'],
                ['label' => 'start AND goal', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. AND marks bits set in both; Example 1 → 1 instead of 3.\nStep back to when you used AND.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Numbers of different lengths?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only the bits of the shorter number', 'next' => 'wrong_b'],
                ['label' => 'Compare all bits, leading zeros too', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 2 (3 → 4) → 2 instead of 3.\nStep back to when you cut to the shorter length.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "After XOR, count?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The set bits', 'next' => 'success'],
                ['label' => 'The zero bits', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Zero bits are the ones that already match; Example 1 → 1 instead of 3.\nStep back to when you counted zeros.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(1). Examples → 3, 3.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
