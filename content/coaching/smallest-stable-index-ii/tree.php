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
            'message' => "Read the problem statement above.\nMin over which part?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Suffix nums[i … n − 1]', 'next' => 's2'],
                ['label' => 'Prefix nums[0 … i]', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 → 0 instead of 3.\nStep back to when you took the prefix min.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Stable when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Score < k', 'next' => 'wrong_b'],
                ['label' => 'Score ≤ k', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 3 → −1 instead of 0.\nStep back to when you made the test strict.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 3, −1, 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
