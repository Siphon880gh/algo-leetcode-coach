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
            'message' => "Read the problem statement above.\nWhich repeat to delete?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Try every j and keep the best', 'next' => 's2'],
                ['label' => 'The shortest one', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. bbaabbaa → 2 that way instead of 3.\nStep back to when you took the shortest repeat.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "dp[i] with no repeat available?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '0', 'next' => 'wrong_b'],
                ['label' => '1, deleting the whole suffix', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Deleting the rest still counts; Example 3 → 4 instead of 5.\nStep back to when you used 0.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Check s[i … i + j) = s[i + j … i + 2j) how?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'lcp[i][i + j] ≥ j', 'next' => 'success'],
                ['label' => 'Compare the two substrings directly', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. That is about 2.7 · 10^9 character comparisons for n = 4000.\nStep back to when you compared substrings.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n²). Examples → 2, 4, 5.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
