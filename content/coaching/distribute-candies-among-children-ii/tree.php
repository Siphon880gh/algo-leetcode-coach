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
            'message' => "Read the problem statement above.\nn and limit reach 10^6. Approach?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'One loop, O(1) per value', 'next' => 's2'],
                ['label' => 'Two nested loops', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. That is about 10^12 steps.\nStep back to when you nested loops.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Empty range for b?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Use the formula as is', 'next' => 'wrong_b'],
                ['label' => 'Count 0', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The formula goes negative; n = 6, limit = 2 → 0 instead of 1.\nStep back to when you skipped the floor.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(min(n, limit)). Examples → 3, 10.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
