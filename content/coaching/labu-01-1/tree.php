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
bag capacity W = 4
items:
  A (1,15), B (3,20), C (4,30)
each at most once
dp starts as all zeros (no items)

After considering only A, what is dp[1][4]?',
            'outcome' => 'continue',
            'choices' => [
                ['label' => '15 — take A once into the bag', 'next' => 'after_a'],
                ['label' => '60 — four copies of A', 'next' => 'w_copies'],
            ],
        ],
        'w_copies' => [
            'message' => 'Wrong.

0-1 means A is available once. Capacity 4 still only holds one A → 15.

Step back.',
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'after_a' => [
            'message' => 'State:
row A filled
now add B (3,20)
cell capacity 4: skip=15, take=dp[1][1]+20=15+20

Best for dp[2][4]?',
            'outcome' => 'continue',
            'choices' => [
                ['label' => '35 — take A and B', 'next' => 'ask_c'],
                ['label' => '20 — take B alone', 'next' => 'w_b'],
            ],
        ],
        'w_b' => [
            'message' => 'Wrong.

max(skip 15, take 35) = 35. A still fits beside B.

Step back.',
            'outcome' => 'wrong',
            'rewind_to' => 'after_a',
            'choices' => [],
        ],
        'ask_c' => [
            'message' => 'State:
dp[2][4] = 35
now item C (4,30)
take would be dp[2][0]+30 = 30

Final dp[3][4]?',
            'outcome' => 'continue',
            'choices' => [
                ['label' => '35 — keep A+B; C is worse', 'next' => 'success'],
                ['label' => '30 — must take the heaviest item', 'next' => 'w_c'],
            ],
        ],
        'w_c' => [
            'message' => 'Wrong.

Skip keeps 35; take C alone is 30. Keep the better skip.

Step back.',
            'outcome' => 'wrong',
            'rewind_to' => 'ask_c',
            'choices' => [],
        ],
        'success' => [
            'message' => 'Correct.

- Empty row → zeros
- Take reads previous row only (0-1)
- Best pack here is 35

You finished this path.',
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
