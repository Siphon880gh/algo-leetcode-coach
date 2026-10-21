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
                ['label' => 'Sort and greedily drop each value into the lighter bucket', 'next' => 'wrong_greedy'],
                ['label' => 'Odd total → false. Else ask: does some subset sum to total / 2?', 'next' => 'reduce'],
            ],
        ],
        'wrong_greedy' => [
            'message' => "You are wrong here. Greedy bucket filling has no guarantee: [3,3,2,2,2] sums to 12, but largest-first gives 3+2+2 = 7 vs 3+2 = 5 even though [3,3] and [2,2,2] both make 6. Trying all 2^n subsets is too slow for n = 200.\nStep back to when you chose a greedy split.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'reduce' => [
            'message' => "Let m = total / 2. If one subset hits m, the rest is also m. f[j] = can some chosen values sum to j. f[0] = true. For each x: f[j] = f[j] or f[j − x].\nWhich direction does j walk in the 1D table?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Forward, j from x up to m', 'next' => 'wrong_dir'],
                ['label' => 'Backward, j from m down to x, so each x is used once', 'next' => 'kind'],
            ],
        ],
        'wrong_dir' => [
            'message' => "You are wrong. Walking j forward reads f[j − x] that this same x already set, so x gets reused. That is unbounded knapsack (Coin Change 322 style). nums = [1,3], m = 2: forward makes f[2] true via 1 + 1, yet no subset of [1,3] sums to 2.\nStep back to when you picked the loop direction.",
            'outcome' => 'wrong',
            'rewind_to' => 'reduce',
            'choices' => [],
        ],
        'kind' => [
            'message' => "Answer is f[m]. Time O(n × m), space O(m). m is at most 200 × 100 / 2 = 10000. Partition to K Equal Sum Subsets (698) wants k buckets. Target Sum (494) assigns + or −.\nLock it in?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Odd → false. 0-1 subset sum to total / 2, j walks down. Not 698 / 494', 'next' => 'success'],
                ['label' => 'The two subsets must be contiguous halves of the array', 'next' => 'wrong_kind'],
            ],
        ],
        'wrong_kind' => [
            'message' => "You are wrong. Subsets can pick any positions. [1,5,11,5] works as [1,5,5] and [11] even though the 5s are not adjacent.\nStep back to when you required contiguous halves.",
            'outcome' => 'wrong',
            'rewind_to' => 'kind',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Odd total is false. Otherwise 0-1 subset sum to m = total / 2 with f[0] = true and j walking down. [1,5,11,5] → true. [1,2,3,5] → false.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
