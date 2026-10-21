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
            'message' => "Read the problem statement above.\nWhat do you try first?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Iterate, keeping only the last two values', 'next' => 's2'],
                ['label' => 'Recurse: return F(n − 1) + F(n − 2)', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Plain recursion recomputes the same values about φ^n times.\nStep back to when you recursed without memo.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "a, b = 0, 1.\nWhat is one step?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'a = b; then b = a + b', 'next' => 'wrong_b'],
                ['label' => 'a, b = b, a + b at the same time', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. a = b, then b = a + b uses the new a, so b doubles instead.\nStep back to when you updated one at a time.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "After n steps, a = F(n). O(n) time, O(1) space.\nLock it in?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Simultaneous update n times, return a', 'next' => 'success'],
                ['label' => 'Return b at the end', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. After n steps, b is F(n + 1). n = 0 would give 1.\nStep back to when you returned b.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Two rolling values, simultaneous update, return a. n = 4 → 3.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
