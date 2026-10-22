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
            'message' => "Read the problem statement above.\nTry removing?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Each distinct value', 'next' => 's2'],
                ['label' => 'Only the smallest value', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 → 4 instead of 7.\nStep back to when you only removed the smallest.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "All values negative?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Use the zeroed tree', 'next' => 'wrong_b'],
                ['label' => 'Answer the maximum', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. [−3, −1, −2] → 0 instead of −1.\nStep back to when you used the tree.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). Examples → 7, 10.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
