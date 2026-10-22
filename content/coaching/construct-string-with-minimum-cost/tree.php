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
            'message' => "Read the problem statement above.\nPick words how?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'DP over positions', 'next' => 's2'],
                ['label' => 'Longest match each time', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 → 11 instead of 7.\nStep back to when you took the longest.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Inner loop over?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Every word', 'next' => 'wrong_b'],
                ['label' => 'Distinct lengths (≤ 315)', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. That is up to 5 · 10^4 · 5 · 10^4 = 2.5 · 10^9 checks.\nStep back to when you looped every word.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n √L). Examples → 7, −1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
