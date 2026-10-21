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
            'message' => "Problem: Given daily calories, a window length k, and bounds lower and upper, score every run of k consecutive days: −1 if the total is below lower, +1 if above upper, otherwise 0. Return the final score. For instance, [1,2,3,4,5] with k = 1 and lower = upper = 3 scores 0. (Restated from memory; limits and examples may differ slightly.)\nRecompute each window's sum?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: slide it', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. That is O(n · k).\nStep back to when you recomputed.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Total equals lower. Score?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '−1', 'next' => 'wrong_b'],
                ['label' => '0', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Only strictly below lower loses a point.\nStep back to when you subtracted.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "How many windows?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'n − k + 1', 'next' => 'success'],
                ['label' => 'n − k', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The last window ends at day n − 1.\nStep back to when you missed one.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). [1,2,3,4,5], k = 1, lower = upper = 3 → 0. [3,2], k = 2, lower = 0, upper = 1 → 1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
