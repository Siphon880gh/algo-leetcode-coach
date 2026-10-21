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
            'message' => "Read the problem statement above.\nCompare each element with?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The minimum before it', 'next' => 's2'],
                ['label' => 'The minimum of the whole array', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The smaller value must come first; [5,6,1] → 1, but the global minimum 1 is last.\nStep back to when you used the global minimum.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Equal values?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Difference 0 counts', 'next' => 'wrong_b'],
                ['label' => 'Not a valid pair', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. nums[i] < nums[j] is strict; [9,9] → −1.\nStep back to when you allowed 0.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "No valid pair?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Return −1', 'next' => 'success'],
                ['label' => 'Return 0', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Example 2 → −1.\nStep back to when you returned 0.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 4, −1, 9.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
