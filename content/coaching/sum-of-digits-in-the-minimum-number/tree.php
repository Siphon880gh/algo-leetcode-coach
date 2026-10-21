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
            'message' => "Problem: Given nums (values 1 to 100), let s be the digit sum of its minimum element. Return 0 if s is odd, otherwise 1. [34,23,1,24,75,33,54,8] → 0. [99,77,33,66,55] → 1. (Restated from memory; limits and examples may differ slightly.)\nWhose digits do you add?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only the minimum\'s', 'next' => 's2'],
                ['label' => 'Every element\'s', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The rule uses the minimum alone.\nStep back to when you summed all elements.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Digit sum is 1. Output?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '1', 'next' => 'wrong_b'],
                ['label' => '0', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Odd sums give 0.\nStep back to when you returned 1.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Minimum is 33. Output?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '1', 'next' => 'success'],
                ['label' => '0', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. 3 + 3 = 6 is even, which gives 1.\nStep back to when you returned 0.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). [34,23,1,24,75,33,54,8] → 0. [99,77,33,66,55] → 1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
