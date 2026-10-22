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
            'message' => "Read the problem statement above.\nAllow a change?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Yes, once', 'next' => 's2'],
                ['label' => 'No, exact match only', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 → [] instead of [0, 1, 2].\nStep back to when you required exact matches.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Spend it when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'At the first mismatch', 'next' => 'wrong_b'],
                ['label' => 'First index where suf[i + 1] ≥ m − j − 1', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 2 → [] instead of [1, 2, 4].\nStep back to when you changed at the first mismatch.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → [0, 1, 2], [1, 2, 4], [], [0, 1].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
