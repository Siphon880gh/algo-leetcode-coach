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
            'message' => "Read the problem statement above.\ncost[i][j] recurrence?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'cost[i + 1][j − 1] + (s[i] ≠ s[j])', 'next' => 's2'],
                ['label' => 'Count all mismatched letters', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Only mirror pairs matter.\nStep back to when you counted letters.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Base f(i, 1)?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '0', 'next' => 'wrong_b'],
                ['label' => 'cost[i][n − 1]', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The last piece is the whole rest.\nStep back to when you returned 0.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "End j of the first piece?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Up to n − k', 'next' => 'success'],
                ['label' => 'Up to n − 1', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Leave one character for each remaining piece.\nStep back to when you went to n − 1.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n² · k). \"abc\", 2 → 1. \"aabbc\", 3 → 0. \"leetcode\", 8 → 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
