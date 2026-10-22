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
            'message' => "Read the problem statement above.\nFewer than k levels?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Return −1', 'next' => 's2'],
                ['label' => 'Return the smallest sum', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. The kth largest does not exist; Example 2 with k = 4 → 1 instead of −1.\nStep back to when you returned a sum.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Sort the level sums?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Increasing', 'next' => 'wrong_b'],
                ['label' => 'Decreasing', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. That gives the kth smallest; Example 1 → 10 instead of 13.\nStep back to when you sorted up.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n + L log L). Examples → 13, 3.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
