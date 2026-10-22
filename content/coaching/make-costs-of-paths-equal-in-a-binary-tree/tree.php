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
            'message' => "Read the problem statement above.\nPass which sum up?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'max(l, r)', 'next' => 's2'],
                ['label' => 'min(l, r)', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. After the fix both children equal the larger one; Example 1 → 7 instead of 6.\nStep back to when you took the smaller.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Compare siblings by?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Their own costs only', 'next' => 'wrong_b'],
                ['label' => 'Their whole path sums below', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Deeper differences are lost; n = 7, cost = [1,1,1,5,1,1,1] → 4 instead of 8.\nStep back to when you compared raw costs.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 6, 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
