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
            'message' => "Problem: Problem: Given strings s1 and s2, return the shortest substring of s1 that contains s2 as a subsequence (letters in order, gaps allowed), choosing the leftmost on ties, or \"\" if none exists. (Restated from memory; limits and examples may differ slightly.)\nUse the problem-76 window with letter counts?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: order matters here, so counts are not enough', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Counts ignore order; \"ba\" does not contain \"ab\" as a subsequence.\nStep back to when you counted letters.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "The forward scan completes s2 at index end. Is that window tight?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Yes', 'next' => 'wrong_b'],
                ['label' => 'Not yet: scan backward from end to find the latest start', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The forward scan may have matched s2[0] too early.\nStep back to when you accepted the forward window.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "After recording a window, where do you restart?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'At start + 1', 'next' => 'success'],
                ['label' => 'At end + 1', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. A shorter window may start inside the one just found.\nStep back to when you jumped past end.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(|s1| · |s2|) time, O(1) space. s1 = \"abcdebdde\", s2 = \"bde\" → \"bcde\".\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
