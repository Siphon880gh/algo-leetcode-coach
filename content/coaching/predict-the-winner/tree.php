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
                ['label' => 'Interval DP on the current player\'s best lead', 'next' => 's2'],
                ['label' => 'Always take the larger end', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Taking the bigger end is not optimal. [1,5,233,7]: greedy takes 7, then player 2 takes 233.\nStep back to when you played greedily.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "f[i][j] = the most the mover can lead by on nums[i..j].\nTaking nums[i] gives what lead?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'nums[i] + f[i + 1][j]', 'next' => 'wrong_b'],
                ['label' => 'nums[i] − f[i + 1][j]', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. After you take nums[i], the opponent moves on nums[i + 1..j] and leads by f[i + 1][j]. Their lead counts against you.\nStep back to when you added the opponent's lead.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "f[i][j] = max(nums[i] − f[i + 1][j], nums[j] − f[i][j − 1]), f[i][i] = nums[i], filled by length. O(n²). Stone Game (877) is a special case where player 1 always wins.\nLock it in?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Lead DP, win if f[0][n − 1] >= 0. Not greedy', 'next' => 'success'],
                ['label' => 'Win only if f[0][n − 1] > 0', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Ties count as a win for player 1, so a lead of exactly 0 is true.\nStep back to when you required a positive lead.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Track the mover's lead, subtract the opponent's best, and accept a tie. [1,5,233,7] → true.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
