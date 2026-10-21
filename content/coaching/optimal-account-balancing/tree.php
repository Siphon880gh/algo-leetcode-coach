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
            'message' => "Problem: 1 to 8 transactions [from, to, amount], person IDs below 12. Return the fewest transactions that settle all debts. [[0,1,10],[2,0,5]] → 2. [[0,1,10],[1,0,1],[1,2,5],[2,0,5]] → 1. (Restated from memory; limits and examples may differ slightly.)\nWhat do you try first?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Compute each net balance; drop people at zero', 'next' => 's2'],
                ['label' => 'Simplify the original transactions one by one', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Replaying the original transfers keeps steps that cancel out. Only the net amount each person owes or is owed matters.\nStep back to when you worked with the raw transfers.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "m people with nonzero balances. A group whose balances sum to zero can settle by itself.\nHow many transfers does such a group need?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'k for k people', 'next' => 'wrong_b'],
                ['label' => 'k − 1 for k people', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Each transfer can zero out one person, and the last person zeroes automatically. So k people need k − 1, not k.\nStep back to when you counted k.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Answer = m − (max number of disjoint zero-sum groups). Bitmask DP over subsets with submask splits is O(3^m). Backtracking that settles the first nonzero balance against each opposite-sign one also works.\nLock it in?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Net balances, maximize zero-sum groups, answer m − groups', 'next' => 'success'],
                ['label' => 'Greedily match the largest debtor with the largest creditor', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Largest debtor pays largest creditor is a heuristic, not optimal. It can split a group that could have closed in fewer moves.\nStep back to when you used the greedy match.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Net balances, drop zeros, and count zero-sum groups: answer is m − groups. [[0,1,10],[2,0,5]] → 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
