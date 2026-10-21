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
            'message' => "Problem: Count the non-empty contiguous subarrays of nums whose leftmost element is not larger than any other element in the subarray. [1,4,2,5,3] → 11. [3,2,1] → 3. [2,2,2] → 6. (Restated from memory; limits and examples may differ slightly.)\nHow far can a valid subarray starting at i extend?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Up to the first later element smaller than nums[i]', 'next' => 's2'],
                ['label' => 'To the end of the array', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. A smaller element breaks the rule.\nStep back to when you went to the end.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "An equal value comes next. Does it stop the run?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Yes', 'next' => 'wrong_b'],
                ['label' => 'No', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Not larger includes equal.\nStep back to when you stopped on equal.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "No smaller element to the right. Count for i?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'n − i', 'next' => 'success'],
                ['label' => '0', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Every subarray from i to the end is valid.\nStep back to when you counted 0.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). [1,4,2,5,3] → 11. [3,2,1] → 3. [2,2,2] → 6.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
