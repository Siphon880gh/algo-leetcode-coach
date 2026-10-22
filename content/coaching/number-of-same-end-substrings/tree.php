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
            'message' => "Problem: Given a string and a list of queries, each a range [l, r], count the substrings of s[l..r] whose first and last characters are the same. Indexing and limits are in the official statement. For instance, s = abcaab: the whole string → 10, and the range [1, 3] (bca) → 3. (Restated from memory; limits and examples may differ slightly.)\nLetter seen c times gives?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'c(c + 1) / 2', 'next' => 's2'],
                ['label' => 'c(c − 1) / 2', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Single characters count; the whole abcaab → 4 instead of 10.\nStep back to when you dropped them.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Count in [l, r]?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'pre[r] − pre[l]', 'next' => 'wrong_b'],
                ['label' => 'pre[r + 1] − pre[l]', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. That drops s[r]; the examples → 8 and 2 instead of 10 and 3.\nStep back to when you used pre[r].",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(26 (n + q)). The examples → 10, 3.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
