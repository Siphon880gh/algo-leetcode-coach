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
            'message' => "Read the problem statement above.\nCut when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The subtree sum is divisible by k', 'next' => 's2'],
                ['label' => 'The node’s own value is divisible by k', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Whole subtrees matter; example 1 → 0 instead of 2.\nStep back to when you checked single values.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "n reaches 3 · 10^4. Traverse with?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Plain recursion', 'next' => 'wrong_b'],
                ['label' => 'BFS order, processed in reverse', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A path of 3 · 10^4 nodes hit a RecursionError in Python.\nStep back to when you recursed.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 2, 3.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
