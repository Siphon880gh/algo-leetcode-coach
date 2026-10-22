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
            'message' => "Problem: You are given an array nums and a list of queries. Once, before starting, you may replace nums with any of its subsequences. Then the queries are handled in order: if both the first and the last element of nums are smaller than the query, processing stops; otherwise you remove the first or the last element, one that is at least the query. Return the largest number of queries you can process. Limits are in the official statement. For instance, nums = [2, 3, 2] with queries [2, 2, 3] → 3, and nums = [3, 4, 3] with queries [4, 3, 2] → 2. (Restated from memory; limits and examples may differ slightly.)\nThe up-front subsequence?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Lets you skip any element at either end', 'next' => 's2'],
                ['label' => 'Can be ignored', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. nums = [2, 4, 1] with queries [3, 2, 3, 1, 4] → 0 instead of 2: keeping [2, 4] puts the 4 at an end for the first query, then the 2 serves the second.\nStep back to when you ignored it.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "State?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only elements taken from the left', 'next' => 'wrong_b'],
                ['label' => 'f[i][j]: elements taken from the left and from the right', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. nums = [1, 1, 2] with queries [2, 1] → 1 instead of 2.\nStep back to when you used one end only.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n²). The examples → 3, 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
