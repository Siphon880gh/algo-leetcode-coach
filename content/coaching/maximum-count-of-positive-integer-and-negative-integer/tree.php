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
            'message' => "Read the problem statement above.\nNumber of negatives?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'lower_bound(nums, 0)', 'next' => 's2'],
                ['label' => 'upper_bound(nums, 0)', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. That also counts the zeros; Example 2 → 5 instead of 3.\nStep back to when you used upper_bound.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Number of positives?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'n − lower_bound(nums, 0)', 'next' => 'wrong_b'],
                ['label' => 'n − upper_bound(nums, 0)', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. That also counts the zeros; Example 2 → 4 instead of 3.\nStep back to when you used lower_bound.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(log n). Examples → 3, 3, 4.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
