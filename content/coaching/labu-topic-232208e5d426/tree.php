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
W = 4
item A (1,15) may be taken many times
row starts [0,0,0,0,0]
fill left→right

After A, what is capacity 4?',
            'outcome' => 'continue',
            'choices' => [
                ['label' => '60 — four copies of A', 'next' => 'ask_take'],
                ['label' => '15 — only one copy', 'next' => 'w_one'],
            ],
        ],
        'w_one' => [
            'message' => 'Wrong.

Complete knapsack allows repeats. 1+1+1+1 weights fit → 60.

Step back.',
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'ask_take' => [
            'message' => 'State:
filling cell (i=A, c=4)
take needs a value that may already include earlier A\'s

Which read?',
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'dp[i][c-1] + 15 — same row', 'next' => 'ask_skip'],
                ['label' => 'dp[i-1][c-1] + 15 — previous row only', 'next' => 'w_prev'],
            ],
        ],
        'w_prev' => [
            'message' => 'Wrong.

Previous-row-only is 0-1. Same-row lets copy #2 see copy #1.

Step back.',
            'outcome' => 'wrong',
            'rewind_to' => 'ask_take',
            'choices' => [],
        ],
        'ask_skip' => [
            'message' => 'State:
skip means “do not use item A at all”

Skip reads?',
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'dp[i-1][c] — previous item row', 'next' => 'success'],
                ['label' => 'dp[i][c] — already includes A', 'next' => 'w_skip'],
            ],
        ],
        'w_skip' => [
            'message' => 'Wrong.

Skip must come from the row that never saw this item.

Step back.',
            'outcome' => 'wrong',
            'rewind_to' => 'ask_skip',
            'choices' => [],
        ],
        'success' => [
            'message' => 'Correct.

- Unlimited copies → take reads same row
- Four A\'s fill capacity 4 → 60

You finished this path.',
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
