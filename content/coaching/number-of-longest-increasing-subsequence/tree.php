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
            'message' => "Read the problem statement above.\nWhat do you store per index?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'len[i] and cnt[i] for subsequences ending at i', 'next' => 's2'],
                ['label' => 'Only len[i]', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Lengths alone cannot count how many subsequences reach them.\nStep back to when you dropped cnt.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "nums[j] < nums[i] and len[j] + 1 > len[i]. Then?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'cnt[i] += cnt[j]', 'next' => 'wrong_b'],
                ['label' => 'len[i] = len[j] + 1 and cnt[i] = cnt[j]', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A longer length makes the old count obsolete; replace it.\nStep back to when you added.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "How do you get the answer?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Sum cnt[i] over every i with len[i] equal to the maximum', 'next' => 'success'],
                ['label' => 'cnt at the last index', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Longest subsequences can end at many indexes.\nStep back to when you used one index.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n²) DP with counts. [1,3,5,4,7] → 2. [2,2,2,2,2] → 5.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
