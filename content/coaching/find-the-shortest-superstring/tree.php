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
            'message' => "Read the problem statement above.\nMerge the pair with the largest overlap repeatedly?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: greedy can miss the best order', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Greedy merging is not guaranteed optimal.\nStep back to when you went greedy.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "What is the DP state?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The current superstring', 'next' => 'wrong_b'],
                ['label' => '(set of used words, last word)', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Only the last word matters for the next overlap.\nStep back to when you stored strings.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Minimizing length is the same as?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Maximizing the total overlap of consecutive words', 'next' => 'success'],
                ['label' => 'Minimizing the number of words', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. All words are used; only overlaps shrink the result.\nStep back to when you counted words.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n² · 2ⁿ). [\"alex\",\"loves\",\"leetcode\"] → \"alexlovesleetcode\" (any shortest answer is accepted). [\"catg\",\"ctaagt\",\"gcta\",\"ttca\",\"atgcatc\"] → \"gctaagttcatgcatc\".\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
