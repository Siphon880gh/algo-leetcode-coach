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
            'message' => "Read the problem statement above.\nCheck each of the O(n²) substrings separately?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: expand outward from each center', 'next' => 's2'],
                ['label' => 'Yes, testing each one in O(n)', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. That is O(n³); expanding reuses the inner check.\nStep back to when you tested each substring.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "How many centers are there?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'n: only the characters', 'next' => 'wrong_b'],
                ['label' => '2n − 1: every character and every gap between two', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Even-length palindromes like aa are centered between two letters.\nStep back to when you used characters only.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "What do you count?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Every successful expansion step, so equal substrings at different positions count', 'next' => 'success'],
                ['label' => 'Only distinct palindromes', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. \"aaa\" has 6 palindromic substrings, counted by position.\nStep back to when you deduplicated.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Expand around 2n − 1 centers: O(n²) time, O(1) space. \"abc\" → 3. \"aaa\" → 6.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
