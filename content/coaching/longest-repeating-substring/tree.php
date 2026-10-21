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
            'message' => "Problem: Return the length of the longest substring of s that occurs at least twice (occurrences may overlap), or 0 if there is none; s has at most 2000 lowercase letters. \"abcd\" → 0. \"abbaba\" → 2. \"aabcaabdaab\" → 3. (Restated from memory; limits and examples may differ slightly.)\nState for the DP?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Two end positions i < j', 'next' => 's2'],
                ['label' => 'One end position', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. You need two occurrences.\nStep back to when you used one position.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "s[i − 1] == s[j − 1]. dp[i][j]?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'max(dp[i − 1][j], dp[i][j − 1])', 'next' => 'wrong_b'],
                ['label' => 'dp[i − 1][j − 1] + 1', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. That is subsequence DP; substrings must be contiguous.\nStep back to when you took a max.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Letters differ. dp[i][j]?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '0', 'next' => 'success'],
                ['label' => 'dp[i − 1][j − 1]', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. A mismatch breaks the substring.\nStep back to when you carried it over.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n²). \"abcd\" → 0. \"abbaba\" → 2. \"aabcaabdaab\" → 3.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
