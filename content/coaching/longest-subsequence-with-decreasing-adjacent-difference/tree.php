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
            'message' => "Read the problem statement above.\nPick?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Any subsequence', 'next' => 's2'],
                ['label' => 'Contiguous subarrays', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 2 → 3 instead of 4.\nStep back to when you used subarrays.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Differences must?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Strictly decrease', 'next' => 'wrong_b'],
                ['label' => 'Never increase (equal is fine)', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 2 → 3 instead of 4.\nStep back to when you required strict.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n · V). Examples → 3, 4, 5.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
