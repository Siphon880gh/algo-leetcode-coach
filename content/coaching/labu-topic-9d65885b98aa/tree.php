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
item (weight=2, value=3)
W = 4
rule = each item at most once

Best value?',
            'outcome' => 'continue',
            'choices' => [
                ['label' => '3 — one copy; leftover 2 unused', 'next' => 'ask_unb'],
                ['label' => '6 — two copies anyway', 'next' => 'w_01'],
            ],
        ],
        'w_01' => [
            'message' => 'Wrong.

0-1 forbids a second copy. Best is 3.

Step back.',
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'ask_unb' => [
            'message' => 'State:
same item (2,3), W=4
rule = unlimited copies

Best value?',
            'outcome' => 'continue',
            'choices' => [
                ['label' => '6 — two copies', 'next' => 'ask_loop'],
                ['label' => '3 — still one copy', 'next' => 'w_unb'],
            ],
        ],
        'w_unb' => [
            'message' => 'Wrong.

Unlimited means 2+2 weights fit → value 6.

Step back.',
            'outcome' => 'wrong',
            'rewind_to' => 'ask_unb',
            'choices' => [],
        ],
        'ask_loop' => [
            'message' => 'State:
1D dp array
unlimited copies of this item

Capacity loop direction?',
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Forward (low → high) so copies stack', 'next' => 'success'],
                ['label' => 'Backward (high → low) like 0-1', 'next' => 'w_loop'],
            ],
        ],
        'w_loop' => [
            'message' => 'Wrong.

Backward blocks reuse. Forward lets dp[2]=3 feed dp[4]=6.

Step back.',
            'outcome' => 'wrong',
            'rewind_to' => 'ask_loop',
            'choices' => [],
        ],
        'success' => [
            'message' => 'Correct.

- Copy rule first: once / unlimited / ≤k
- Loop direction encodes reuse
- Same item, three different answers

You finished this path.',
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
