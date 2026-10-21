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
            'message' => "Read the problem statement above.\nWhat marks the right end of the window?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The last index whose value is smaller than the max to its left', 'next' => 's2'],
                ['label' => 'The last index of a descent, nums[i] > nums[i + 1]', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. In [1,3,2,0] the descents cover 3, 2, 0, but 1 must move as well, so the whole array is the window.\nStep back to when you used descents.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "And the left end?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The first index of any descent', 'next' => 'wrong_b'],
                ['label' => 'Scanning right to left, the last index whose value is larger than the min to its right', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. In [2,3,1] the first descent is at index 1, but 2 must move too, so the window starts at 0.\nStep back to when you used the first descent.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "The array is already sorted. What do you return?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '0', 'next' => 'success'],
                ['label' => '−1', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The answer is a length, and a sorted array needs a window of length 0.\nStep back to when you returned −1.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Running max from the left, running min from the right: O(n) time, O(1) space. [2,6,4,8,10,9,15] → 5.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
