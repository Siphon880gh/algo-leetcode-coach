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
            'message' => "Read the problem statement above.\nBefore choosing nums[i], check?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Both nums[i] − k and nums[i] + k', 'next' => 's2'],
                ['label' => 'Only nums[i] − k', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Without sorting, a larger value may already be chosen; nums = [4,2], k = 2 → 3 instead of 2.\nStep back to when you checked one side.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Final answer?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Count', 'next' => 'wrong_b'],
                ['label' => 'Count − 1', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The empty subset is not allowed; Example 1 → 5 instead of 4.\nStep back to when you kept it.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(2^n). Examples → 4, 1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
