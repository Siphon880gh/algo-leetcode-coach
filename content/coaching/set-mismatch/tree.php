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
            'message' => "Read the problem statement above.\nCan you assume the array is sorted?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: use sums or counts, which ignore order', 'next' => 's2'],
                ['label' => 'Yes: compare nums[i] with i + 1', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. In [3,2,2] the values are out of order.\nStep back to when you assumed sorted input.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "How do you get the duplicate?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'n(n + 1) / 2 − sum(nums)', 'next' => 'wrong_b'],
                ['label' => 'sum(nums) − sum(set(nums))', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. That equals missing − duplicate, a difference, not either value.\nStep back to when you used the full sum alone.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "How do you get the missing value?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'n(n + 1) / 2 − sum(set(nums))', 'next' => 'success'],
                ['label' => 'The first index i where nums[i] != i + 1', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The array is not sorted, so positions say nothing.\nStep back to when you used positions.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Sums of the list and of the set: O(n) time. [1,2,2,4] → [2,3]. Sign marking gets O(1) space.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
