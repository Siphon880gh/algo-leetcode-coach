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
            'message' => "Read the problem statement above.\nValue 4 (or 9, 25, …)?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Skip it', 'next' => 's2'],
                ['label' => 'Use its prime mask', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Any subset containing it is not square-free; Example 1 → 11 instead of 3.\nStep back to when you kept 4.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Copies of 1?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Treat 1 like any other value', 'next' => 'wrong_b'],
                ['label' => 'dp[0] = 2^(count of 1s)', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Several 1s may be taken together; nums = [1,1] → 2 instead of 3.\nStep back to when you took one 1 at a time.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(30 · 2^10 + n). Examples → 3, 1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
