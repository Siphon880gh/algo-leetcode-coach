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
            'message' => "Read the problem statement above.\nProcess orders one unit at a time?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No, batches by amount', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Amounts reach 10^9.\nStep back to when you looped per order.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Buy matches which sell?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The most expensive', 'next' => 'wrong_b'],
                ['label' => 'The cheapest, if ≤ buy price', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The statement takes the smallest sell price.\nStep back to when you took the largest.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "When to apply mod?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only on the final sum', 'next' => 'success'],
                ['label' => 'On every amount update', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Comparisons need true amounts.\nStep back to when you reduced early.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). Examples → 6, 999999984.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
