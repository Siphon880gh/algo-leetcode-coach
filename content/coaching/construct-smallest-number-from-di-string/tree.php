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
            'message' => "Read the problem statement above.\nApproach?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Write 1 … n + 1 and reverse every D run, with a stack', 'next' => 's2'],
                ['label' => 'Start at 1 and take the smallest unused digit that fits each letter', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. A D after 1 has nowhere to go; Example 2 is stuck at once.\nStep back to when you started at 1 without looking ahead.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Flush the stack when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'At each D, and at the end', 'next' => 'wrong_b'],
                ['label' => 'At each I, and at the end', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 1 → 432165789 instead of 123549876.\nStep back to when you flushed at D.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Push what at position i?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'i + 1', 'next' => 'success'],
                ['label' => 'i', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Digits start at 1; Example 2 → 3210 instead of 4321.\nStep back to when you pushed i.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 123549876, 4321.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
