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
            'message' => "Read the problem statement above.\nLargest value ≤ q?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'a[upper_bound(q) − 1]', 'next' => 's2'],
                ['label' => 'a[lower_bound(q) − 1]', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. When q is in the tree that skips it; Example 1, query 2 → 1 instead of 2.\nStep back to when you used lower_bound.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "In-order traversal with?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Plain recursion', 'next' => 'wrong_b'],
                ['label' => 'An explicit stack', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A path-shaped tree is 10^5 deep, past Python’s default recursion limit and risky for the call stack elsewhere.\nStep back to when you recursed.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O((n + q) log n). Examples → [[2,2],[4,6],[15,−1]], [[−1,4]].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
