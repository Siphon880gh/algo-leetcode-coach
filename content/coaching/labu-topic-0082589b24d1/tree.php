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
item (2,3), unlimited
W = 4

First forward update at c=2?',
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'dp[2] = 3', 'next' => 'mid'],
                ['label' => 'dp[2] = 6 already', 'next' => 'w1'],
            ],
        ],
        'w1' => [
            'message' => 'Wrong.

Only one copy fits in capacity 2. First write is 3.

Step back.',
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'mid' => [
            'message' => 'State:
dp[2] = 3
next c = 4

dp[4]?',
            'outcome' => 'continue',
            'choices' => [
                ['label' => '6 — reuse dp[2]+3', 'next' => 'ask'],
                ['label' => '3 — cannot reuse', 'next' => 'w2'],
            ],
        ],
        'w2' => [
            'message' => 'Wrong.

Forward intentionally reuses. 3+3=6.

Step back.',
            'outcome' => 'wrong',
            'rewind_to' => 'mid',
            'choices' => [],
        ],
        'ask' => [
            'message' => 'State:
same item, but 0-1 (once only)

Best on W=4?',
            'outcome' => 'continue',
            'choices' => [
                ['label' => '3 — only one copy allowed', 'next' => 'success'],
                ['label' => '6 — still two copies', 'next' => 'w3'],
            ],
        ],
        'w3' => [
            'message' => 'Wrong.

0-1 stops at one copy → 3.

Step back.',
            'outcome' => 'wrong',
            'rewind_to' => 'ask',
            'choices' => [],
        ],
        'success' => [
            'message' => 'Correct.

- Forward stacks copies → 6
- 0-1 would stay at 3

You finished this path.',
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
