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
            'message' => "Read the problem statement above.\nEnumerate subsets of crimes?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: knapsack DP over members and profit', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Up to 100 crimes give 2¹⁰⁰ subsets.\nStep back to when you enumerated.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Profit goes above minProfit. Store it how?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Track the exact total', 'next' => 'wrong_b'],
                ['label' => 'Cap it at minProfit', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Every profit ≥ minProfit qualifies the same way, and exact totals blow up the table.\nStep back to when you tracked exact profit.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Loop the member count in which direction?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Downward, so each crime is counted once', 'next' => 'success'],
                ['label' => 'Upward', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Going up reuses the same crime, like an unbounded knapsack.\nStep back to when you looped upward.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(len · n · minProfit). n = 5, minProfit = 3, group = [2,2], profit = [2,3] → 2. n = 10, minProfit = 5, group = [2,3,5], profit = [6,7,8] → 7.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
