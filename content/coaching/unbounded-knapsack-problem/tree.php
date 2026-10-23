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
item (1,15), unlimited copies

After a forward scan of this item, dp[4]?',
            'outcome' => 'continue',
            'choices' => [
                ['label' => '60 — four stacked copies', 'next' => 'ask_dir'],
                ['label' => '15 — only one copy', 'next' => 'w_one'],
            ],
        ],
        'w_one' => [
            'message' => 'Wrong.

Forward updates let dp[1]=15 feed dp[2]=30 … dp[4]=60.

Step back.',
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'ask_dir' => [
            'message' => 'State:
unlimited copies
1D dp

Capacity loop?',
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Low → high (forward)', 'next' => 'ask_vs'],
                ['label' => 'High → low (backward)', 'next' => 'w_dir'],
            ],
        ],
        'w_dir' => [
            'message' => 'Wrong.

Backward is the 0-1 pattern. Forward stacks copies.

Step back.',
            'outcome' => 'wrong',
            'rewind_to' => 'ask_dir',
            'choices' => [],
        ],
        'ask_vs' => [
            'message' => 'State:
same items, but each at most once (0-1)
W = 4

Best then?',
            'outcome' => 'continue',
            'choices' => [
                ['label' => '35 — e.g. (1,15)+(3,20), not 60', 'next' => 'success'],
                ['label' => '60 — repeats still allowed', 'next' => 'w_01'],
            ],
        ],
        'w_01' => [
            'message' => 'Wrong.

0-1 forbids stacking the weight-1 item. Optimum drops to 35.

Step back.',
            'outcome' => 'wrong',
            'rewind_to' => 'ask_vs',
            'choices' => [],
        ],
        'success' => [
            'message' => 'Correct.

- Forward loop stacks copies → 60 here
- 0-1 would stop at 35

You finished this path.',
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
