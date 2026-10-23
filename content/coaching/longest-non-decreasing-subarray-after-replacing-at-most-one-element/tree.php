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
            'message' => "Read the problem statement above.\nJoin L[i − 1] and R[i + 1] through i?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Yes, when nums[i − 1] ≤ nums[i + 1]', 'next' => 's2'],
                ['label' => 'No, only extend one run', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Constructed check (run in code): [1, 5, 2, 3] → 3 instead of 4.\nStep back to when you skipped joins.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Join condition?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Always join', 'next' => 'wrong_b'],
                ['label' => 'nums[i − 1] ≤ nums[i + 1]', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 1 → 5 instead of 4.\nStep back to when you joined without checking.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 4, 5.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
