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
            'message' => "Read the problem statement above.\nSubsequence or substring?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Subsequence', 'next' => 's2'],
                ['label' => 'Substring', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Characters need not be contiguous.\nStep back to when you used substrings.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Not a palindrome?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Run a DP', 'next' => 'wrong_b'],
                ['label' => '2', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. All a's, then all b's, are each palindromes.\nStep back to when you ran a DP.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Test for a palindrome how?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Two pointers from both ends', 'next' => 'success'],
                ['label' => 'Sort and compare', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Sorting destroys the order you need to test.\nStep back to when you sorted.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). \"ababa\" → 1. \"abb\" → 2. \"baabb\" → 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
