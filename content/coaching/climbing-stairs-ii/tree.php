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
            'message' => "Read the problem statement above.\nJump lengths?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '1, 2 or 3', 'next' => 's2'],
                ['label' => '1 or 2', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 3 → 16 instead of 12.\nStep back to when you dropped jumps of 3.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Cost of a jump from i to j?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'costs[j] only', 'next' => 'wrong_b'],
                ['label' => 'costs[j] + (j − i)²', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 3 → 3 instead of 12.\nStep back to when you dropped the square.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 13, 11, 12.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
