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
            'message' => "Problem: You are given a string of even length n. A string is an anti-palindrome when s[i] ≠ s[n − 1 − i] for every i. Rearrange s into the lexicographically smallest anti-palindrome, or return the not-found value the statement gives. Limits are in the official statement. For instance, abca → aabc, and cccd has no anti-palindrome. (Restated from memory; limits and examples may differ slightly.)\nStart from?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Sorted s', 'next' => 's2'],
                ['label' => 'The original order', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. abca puts a opposite a, and sorting gives the smallest start.\nStep back to when you kept the order.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "After sorting?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Done', 'next' => 'wrong_b'],
                ['label' => 'Fix clashes from the middle', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. abbbcc sorted puts b opposite b.\nStep back to when you stopped after sorting.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). abca → aabc; cccd → not found.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
