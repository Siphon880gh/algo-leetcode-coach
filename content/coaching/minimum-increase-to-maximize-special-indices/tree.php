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
            'message' => "Read the problem statement above.\nCost to make i special?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'max(neighbors) + 1 − nums[i]', 'next' => 's2'],
                ['label' => 'max(neighbors) − nums[i]', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 → 0 instead of 1.\nStep back to when you dropped the + 1.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Even n: which sets?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'All odd or all even only', 'next' => 'wrong_b'],
                ['label' => 'Odd indices, then even, one shift', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Constructed check (run in code): [5, 7, 5, 4, 5, 4, 6, 8] → 5 instead of 3.\nStep back to when you forbade the shift.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 1, 2, 4.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
