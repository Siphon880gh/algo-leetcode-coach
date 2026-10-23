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
            'message' => 'State:
dp = [0, 0, 0, 0, 0]
W = 4
next item A (1,15)
0-1 rule: each item once

Which way do you scan c?',
            'outcome' => 'continue',
            'choices' => [
                ['label' => '4 → 1 (high to low)', 'next' => 'after_dir'],
                ['label' => '1 → 4 (low to high)', 'next' => 'w_dir'],
            ],
        ],
        'w_dir' => [
            'message' => 'Wrong.

Low→high lets an updated small c feed a larger c in the same pass — A would look reusable.

Step back.',
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'after_dir' => [
            'message' => 'State:
after A, dp = [0, 15, 15, 15, 15]
now B (3,20), still scanning high→low
update c=4: max(15, dp[1]+20)

New dp[4]?',
            'outcome' => 'continue',
            'choices' => [
                ['label' => '35', 'next' => 'ask_final'],
                ['label' => '20', 'next' => 'w_35'],
            ],
        ],
        'w_35' => [
            'message' => 'Wrong.

dp[1] is still 15 (A only). 15+20=35.

Step back.',
            'outcome' => 'wrong',
            'rewind_to' => 'after_dir',
            'choices' => [],
        ],
        'ask_final' => [
            'message' => 'State:
dp[4] = 35 after A and B
add C (4,30): max(35, dp[0]+30)=max(35,30)

Final answer?',
            'outcome' => 'continue',
            'choices' => [
                ['label' => '35 — same optimum as the 2D table', 'next' => 'success'],
                ['label' => '30 — C replaces everything', 'next' => 'w_c'],
            ],
        ],
        'w_c' => [
            'message' => 'Wrong.

max keeps 35. Rolling 1D must match the 2D answer.

Step back.',
            'outcome' => 'wrong',
            'rewind_to' => 'ask_final',
            'choices' => [],
        ],
        'success' => [
            'message' => 'Correct.

- One array, scan capacity backward
- Each item stays once
- Same 35 as the full table

You finished this path.',
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
