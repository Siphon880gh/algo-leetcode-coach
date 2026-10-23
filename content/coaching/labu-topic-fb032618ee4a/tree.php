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
houses = [2, 7, 9, 3, 1]
cannot rob neighbors
best so far empty

After house 0 (value 2), best[0]?',
            'outcome' => 'continue',
            'choices' => [
                ['label' => '2', 'next' => 'after0'],
                ['label' => '0 — leave it', 'next' => 'w0'],
            ],
        ],
        'w0' => [
            'message' => 'Wrong.

Robbing the only house so far is allowed → 2.

Step back.',
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'after0' => [
            'message' => 'State:
best[0]=2
house 1 value 7

best[1]?',
            'outcome' => 'continue',
            'choices' => [
                ['label' => '7 — take 7 (better than 2)', 'next' => 'ask_final'],
                ['label' => '9 — take both 2 and 7', 'next' => 'w_adj'],
            ],
        ],
        'w_adj' => [
            'message' => 'Wrong.

Neighbors forbidden. max(skip=2, take=7)=7.

Step back.',
            'outcome' => 'wrong',
            'rewind_to' => 'after0',
            'choices' => [],
        ],
        'ask_final' => [
            'message' => 'State:
continuing take/skip to the end
final best?

',
            'outcome' => 'continue',
            'choices' => [
                ['label' => '12 — houses 2+9+1', 'next' => 'ask_pat'],
                ['label' => '22 — sum of all houses', 'next' => 'w_all'],
            ],
        ],
        'w_all' => [
            'message' => 'Wrong.

Adjacent ban blocks summing everything. 2+9+1=12.

Step back.',
            'outcome' => 'wrong',
            'rewind_to' => 'ask_final',
            'choices' => [],
        ],
        'ask_pat' => [
            'message' => 'State:
you can say “best using houses 0…i”

Which pattern family?',
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Linear 1D take/skip — not knapsack', 'next' => 'success'],
                ['label' => 'Complete knapsack capacity loop', 'next' => 'w_pat'],
            ],
        ],
        'w_pat' => [
            'message' => 'Wrong.

No bag capacity here. Index-along-a-line → linear DP.

Step back.',
            'outcome' => 'wrong',
            'rewind_to' => 'ask_pat',
            'choices' => [],
        ],
        'success' => [
            'message' => 'Correct.

- Build the tiny example first
- Name the state
- Then pick linear take/skip

You finished this path.',
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
