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
            'message' => "Read the problem statement above.\nGroup targets by?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'nums[i] mod space', 'next' => 's2'],
                ['label' => 'nums[i] itself', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. One seed hits a whole remainder class; nums = [2,4,6,1,1], space = 2 → 1 instead of 2.\nStep back to when you grouped by value.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Among equally large groups, return?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The smallest value of the group with the smallest remainder', 'next' => 'wrong_b'],
                ['label' => 'The smallest value in any of them', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. nums = [5,3], space = 4 → 5 instead of 3.\nStep back to when you compared remainders.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 1, 1, 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
