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
            'message' => "Read the problem statement above.\nAfter all the deletions, what is left?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'A common subsequence of both words', 'next' => 's2'],
                ['label' => 'A common substring', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The kept letters do not need to be adjacent; deleting from the middle is allowed.\nStep back to when you used substrings.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "How do you turn the LCS into an answer?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'max(m, n) − LCS', 'next' => 'wrong_b'],
                ['label' => 'm + n − 2 · LCS', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Both words lose letters: \"sea\" and \"eat\" need 2 deletions, not 1.\nStep back to when you used one word.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "LCS DP on a mismatch at word1[i − 1], word2[j − 1]?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'max(f[i − 1][j], f[i][j − 1])', 'next' => 'success'],
                ['label' => 'f[i − 1][j − 1]', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Skipping both letters can miss a match that uses one of them.\nStep back to when you skipped both.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. LCS DP, then m + n − 2 · LCS: O(m · n) time, O(n) space with a rolling row. \"sea\", \"eat\" → 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
