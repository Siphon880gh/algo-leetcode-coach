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
            'message' => "Read the problem statement above.\nSearch permutations for exactly k distinct gaps?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: build one directly', 'next' => 's2'],
                ['label' => 'Yes, with backtracking', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. n goes up to 10⁴; a direct construction exists.\nStep back to when you searched.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "How do you get gaps k, k − 1, …, 1?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Alternate from both ends of 1 … n', 'next' => 'wrong_b'],
                ['label' => 'Alternate from both ends of 1 … k + 1: 1, k + 1, 2, k, …', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Zigzagging over all n numbers gives n − 1 distinct gaps.\nStep back to when you zigzagged over n.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "What about k + 2 … n?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Append them in increasing order; every new gap is already in the set', 'next' => 'success'],
                ['label' => 'Zigzag them as well', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. That would add new gap sizes beyond k.\nStep back to when you kept zigzagging.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Two pointers, then a tail: O(n). n = 3, k = 1 → [1,2,3]. n = 3, k = 2 → [1,3,2].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
