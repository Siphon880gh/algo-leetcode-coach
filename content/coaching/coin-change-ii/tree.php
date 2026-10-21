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
                ['label' => 'Counting DP: f[j] = ways to make j', 'next' => 's2'],
                ['label' => 'Coin Change: f[j] = min coins', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Fewest coins (322) is a min, not a count. Here every combination counts.\nStep back to when you took a min.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Loop order?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Amount outside, coins inside', 'next' => 'wrong_b'],
                ['label' => 'Coins outside, amount inside', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Amount outside counts 1+2 and 2+1 separately: that is 377.\nStep back to when you put amount outside.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "f[0] = 1. For coin c: j from c to amount ascending, f[j] += f[j − c]. Ascending j allows reuse. O(coins × amount).\nLock it in?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Coins outer, j ascending, f[0] = 1', 'next' => 'success'],
                ['label' => 'Loop j from amount down to c', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Going down limits each coin to one use (0-1 knapsack). 5, [1,2,5] would give 1.\nStep back to when you looped j down.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Unbounded counting knapsack with coins outside. 5, [1,2,5] → 4.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
