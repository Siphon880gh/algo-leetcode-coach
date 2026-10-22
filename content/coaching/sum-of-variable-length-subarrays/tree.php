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
            'message' => "Read the problem statement above.\nStart?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'max(0, i − nums[i])', 'next' => 's2'],
                ['label' => 'max(0, i − nums[i] + 1)', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 → 8 instead of 11.\nStep back to when you added 1.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "End?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Stop before i (P[i])', 'next' => 'wrong_b'],
                ['label' => 'Include i (P[i + 1])', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 1 → 5 instead of 11.\nStep back to when you excluded i.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 11, 13.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
