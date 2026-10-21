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
            'message' => "Read the problem statement above.\nScore of s_i?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'LCP of s and the suffix starting at n − i', 'next' => 's2'],
                ['label' => 'LCP of s and its prefix of length i', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Prepending builds suffixes, not prefixes; s_i is the last i characters.\nStep back to when you used prefixes.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Compute all LCPs?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Compare each suffix from scratch', 'next' => 'wrong_b'],
                ['label' => 'Z-function in O(n)', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. aaaa… of length 10^5 makes that about 5 · 10^9 comparisons.\nStep back to when you compared from scratch.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Z[0]?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'n: s_n is s itself', 'next' => 'success'],
                ['label' => '0', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Example 1 → 4 instead of 9.\nStep back to when you set Z[0] to 0.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 9, 14.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
