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
            'message' => "Read the problem statement above.\nk > len(s)?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'False', 'next' => 's2'],
                ['label' => 'True', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Each palindrome needs a character.\nStep back to when you returned true.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Odd-count letters limit?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'At most 1', 'next' => 'wrong_b'],
                ['label' => 'At most k', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Each of the k palindromes can hold one odd centre.\nStep back to when you allowed only one.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Build the palindromes?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: counts decide', 'next' => 'success'],
                ['label' => 'Yes', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Construction is unnecessary.\nStep back to when you built them.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). \"annabelle\", 2 → true. \"leetcode\", 3 → false. \"true\", 4 → true.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
