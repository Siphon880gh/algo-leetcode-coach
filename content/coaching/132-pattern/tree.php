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
            'message' => "Read the problem statement above.\nWhat do you try first?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Scan right to left, keep a stack and two = best value for nums[k]', 'next' => 's2'],
                ['label' => 'Check every triple i < j < k', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Checking every triple is O(n³), and every pair with a scan is O(n²). n = 2e5 needs about linear time.\nStep back to when you checked all triples.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "two starts at −infinity. For each x from the right: if x < two, return true.\nThen, while stack top < x?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Pop and discard, then push x', 'next' => 'wrong_b'],
                ['label' => 'Pop into two; then push x', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. x is bigger than those values and sits to their left, so x is a valid nums[j] for each of them. They must become candidates for nums[k], not be discarded.\nStep back to when you dropped the popped values.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "The stack stays decreasing, and two only grows. Each value is pushed and popped once: O(n) time, O(n) space. Increasing Triplet (334) looks for low, mid, high instead.\nLock it in?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Right to left, pop into two, x < two means true. Not 334', 'next' => 'success'],
                ['label' => 'Look for three increasing values instead', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. That is the 123 shape, which is Increasing Triplet (334). 132 needs the last value between the first two.\nStep back to when you searched for an increasing triple.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Scan from the right; popped values set two; a value below two finishes the 132. [3,1,4,2] → true.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
