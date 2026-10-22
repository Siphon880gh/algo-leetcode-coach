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
            'message' => "Problem: Given a target string, a list of words and a cost for each word, build the target by appending words, paying each word’s cost every time it is used. Return the minimum total cost, or −1 if the target cannot be built. This version has smaller limits than 3213; they are in the official statement. (Restated from memory; limits and examples may differ slightly.)\nPick words how?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'DP over positions', 'next' => 's2'],
                ['label' => 'Longest match each time', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. In the guide’s first check → 11 instead of 7.\nStep back to when you took the longest.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Initial dp?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'All 0', 'next' => 'wrong_b'],
                ['label' => 'dp[0] = 0, the rest ∞', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Every position looks free: aaaa with z, zz, zzz → 0 instead of −1.\nStep back to when you set all to 0.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n · total word length). The guide’s checks → 7, −1, 4.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
