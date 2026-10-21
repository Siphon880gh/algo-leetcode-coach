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
            'message' => "Read the problem statement above.\nEnumerate all substring pairs?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: extend from each start pair', 'next' => 's2'],
                ['label' => 'Yes, compare each pair', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. That adds another factor of n.\nStep back to when you compared pairs.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "When to count?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only at the end', 'next' => 'wrong_b'],
                ['label' => 'Each step where mismatches = 1', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Every valid length is its own pair.\nStep back to when you counted once.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Mismatches reach 2?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Stop this walk', 'next' => 'success'],
                ['label' => 'Keep going', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Longer extensions keep ≥ 2 mismatches.\nStep back to when you continued.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(|s| · |t| · min). Examples → 6, 3.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
