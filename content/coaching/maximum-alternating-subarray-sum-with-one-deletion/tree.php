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
            'message' => "Read the problem statement above.\nFor a subarray ending at i, what decides the sign of nums[i]?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Its position inside the subarray', 'next' => 's2'],
                ['label' => 'Its index i in nums', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. The subarray is re-indexed from 0. In Example 3, [7] alone scores 7 even though 7 sits at index 1.\nStep back to when you used the index in nums.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Example 2, [10, −5, −100]. Without deleting the best is 95. With one deletion?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Deleting never helps a subarray', 'next' => 'wrong_b'],
                ['label' => 'Delete −5 and take [10, −100] for 110', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Deleting −5 lets −100 take a minus sign next to 10. Skipping deletion gives 95 instead of 110.\nStep back to when you ruled it out.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Four states with a skip-one move. O(n). Examples give 11, 110 and 7.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
