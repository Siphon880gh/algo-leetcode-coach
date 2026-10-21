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
                ['label' => 'Knapsack: each string costs (zeros, ones) and is worth 1', 'next' => 's2'],
                ['label' => 'Take strings shortest first while the budgets allow', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Length does not tell you which budget a string spends. A short string of ones can use up all of n and block several strings that each needed just one 1.\nStep back to when you picked greedily.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "f[j][k] = most strings within j zeros and k ones. For a string with a zeros and b ones:\nwhich order do the loops run?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'j from a up to m, k from b up to n', 'next' => 'wrong_b'],
                ['label' => 'j from m down to a, k from n down to b: f[j][k] = max(f[j][k], f[j − a][k − b] + 1)', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Walking upward reads values this same string already updated, so it can be taken twice.\nStep back to when you walked the budgets upward.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Answer f[m][n]. O(s × m × n) time, O(m × n) space. Partition Equal Subset Sum (416) is the one-budget version.\nLock it in?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Two budgets, both walked down, answer f[m][n]', 'next' => 'success'],
                ['label' => 'Merge into one budget of m + n characters', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Two budgets are independent constraints. Adding them into one total lets a subset with too many ones pass.\nStep back to when you merged the budgets.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Two-budget 0-1 knapsack with both loops walking down. Example → 4.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
