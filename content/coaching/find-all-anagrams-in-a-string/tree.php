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
                ['label' => 'Slide a window of exactly |p| letters with 26 counts', 'next' => 's2'],
                ['label' => 'Sort every substring of length |p| and compare with sorted p', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Sorting each window costs |p| log |p| per start, about 3e4 × 3e4 × 15 in the worst case.\nStep back to when you sorted every window.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "need = counts of p. have = counts of the current window.\nHow big is the window?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Grow until it covers p, then shrink while it still covers', 'next' => 'wrong_b'],
                ['label' => 'Always exactly |p|: add s[i], compare, then drop s[i − |p| + 1]', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. An anagram has exactly |p| letters. A variable window lets extra letters in, which is the Minimum Window Substring (76) rule, not this one.\nStep back to when you let the window grow and shrink.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Comparing two arrays of 26 is constant work, so the scan is O(|s| + |p|) time and O(1) space. Permutation in String (567) asks only whether one such window exists.\nLock it in?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Fixed |p| window, 26 counts, return [] when |s| < |p|. Not 76', 'next' => 'success'],
                ['label' => 'Skip the length check; the loop handles it', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. If s is shorter than p, no window fits. Starting the loop anyway reads past the end or reports a bogus index.\nStep back to when you skipped the length check.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Fixed window of |p| letters, 26 counts in and out, record matching starts. \"cbaebabacd\", \"abc\" → [0,6].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
