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
items:
  (1,15), (3,20), (4,30)
each at most once
bag starts empty

Best value?',
            'outcome' => 'continue',
            'choices' => [
                ['label' => '35 — take (1,15) and (3,20)', 'next' => 'ask_loop'],
                ['label' => '30 — only the weight-4 item', 'next' => 'w_30'],
            ],
        ],
        'w_30' => [
            'message' => 'Wrong.

15+20=35 beats 30. Two lighter items fit together.

Step back.',
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'ask_loop' => [
            'message' => 'State:
1D dp, processing one item
need “at most once”

Capacity loop?',
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'High → low (backward)', 'next' => 'ask_fwd'],
                ['label' => 'Low → high (forward)', 'next' => 'w_fwd'],
            ],
        ],
        'w_fwd' => [
            'message' => 'Wrong.

Forward would let this item reuse itself — that is unbounded.

Step back.',
            'outcome' => 'wrong',
            'rewind_to' => 'ask_loop',
            'choices' => [],
        ],
        'ask_fwd' => [
            'message' => 'State:
if you wrongly scanned forward on (1,15) with W=4

What fake value could dp[4] become?',
            'outcome' => 'continue',
            'choices' => [
                ['label' => '60 — four copies of the weight-1 item', 'next' => 'success'],
                ['label' => '15 — forward cannot change anything', 'next' => 'w_fake'],
            ],
        ],
        'w_fake' => [
            'message' => 'Wrong.

Forward stacks: 15,30,45,60. That is why 0-1 must go backward.

Step back.',
            'outcome' => 'wrong',
            'rewind_to' => 'ask_fwd',
            'choices' => [],
        ],
        'success' => [
            'message' => 'Correct.

- Best pack 35 with two items
- Backward loop enforces once
- Forward would fake 60

You finished this path.',
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
