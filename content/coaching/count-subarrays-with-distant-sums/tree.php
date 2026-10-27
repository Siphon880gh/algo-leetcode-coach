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
            'message' => "Read the problem statement above.\nDistant means |sum − goal| ≥ k. What do you count directly?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Every subarray, one by one', 'next' => 'wrong_a'],
                ['label' => 'The close subarrays inside an open window, then subtract', 'next' => 's2'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. n = 10^5 has about 5 × 10^9 subarrays.\nStep back to when you enumerated them.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Example 1:\nsubarray [1, 2], sum 3\ngoal = 4, k = 1\nDistant?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Yes, |3 − 4| = 1 and 1 ≥ 1', 'next' => 'success'],
                ['label' => 'No, it needs a gap bigger than 1', 'next' => 'wrong_b'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A strict test gives 3 instead of 5.\nStep back to when you made it strict.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Prefix sums plus a Fenwick tree for the close window. O(n log n). Examples give 5, 2 and 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
