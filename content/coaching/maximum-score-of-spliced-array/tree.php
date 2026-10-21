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
            'message' => "Read the problem statement above.\nWhat can be swapped?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'One contiguous range', 'next' => 's2'],
                ['label' => 'Every position where the other value is larger', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Only one subarray swaps; Example 2 → 240 instead of 220.\nStep back to when you picked positions freely.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Pick the range how?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Swap the whole arrays', 'next' => 'wrong_b'],
                ['label' => 'Kadane on the differences, floored at 0', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. That just trades the sums; Example 1 → 180 instead of 210.\nStep back to when you swapped everything.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Which array to grow?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Try both and take the larger', 'next' => 'success'],
                ['label' => 'Only nums1', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. nums1 = [1,9,2], nums2 = [9,4,7] → 20 instead of 25.\nStep back to when you only grew nums1.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 210, 220, 31.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
