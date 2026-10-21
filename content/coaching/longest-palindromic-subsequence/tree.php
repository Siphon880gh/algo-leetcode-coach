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
                ['label' => 'Interval DP: f[i][j] for s[i..j]', 'next' => 's2'],
                ['label' => 'Expand around every center', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Expanding around centers finds contiguous palindromes (5). \"bbbab\" → 3 that way, but the answer is 4.\nStep back to when you used expand-around-center.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "s[i] == s[j].\nWhat is f[i][j]?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'f[i + 1][j − 1] + 1', 'next' => 'wrong_b'],
                ['label' => 'f[i + 1][j − 1] + 2', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Matching ends both belong to the palindrome; each adds 1, so it is + 2 on the inside.\nStep back to when you added 1.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Else f[i][j] = max(f[i + 1][j], f[i][j − 1]). f[i][i] = 1. O(n²). Also equals LCS(s, reversed s).\nLock it in?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'i from n − 1 down, j from i + 1 up. Not 5', 'next' => 'success'],
                ['label' => 'Loop i from 0 up', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. f[i][j] needs f[i + 1][…]. Filling i upward reads rows not yet computed.\nStep back to when you looped i from 0 up.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. End-matching interval DP, filled from the bottom. \"bbbab\" → 4.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
