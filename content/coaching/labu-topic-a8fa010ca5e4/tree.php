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
nums = [1, 2]
path = []
goal = all subsets

First action on element 1?',
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Take 1 → path=[1], then recurse for 2', 'next' => 'after_take'],
                ['label' => 'Emit [1,2] immediately with no recursion', 'next' => 'w_jump'],
            ],
        ],
        'w_jump' => [
            'message' => 'Wrong.

One decision at a time. After taking 1, recurse to decide about 2.

Step back.',
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'after_take' => [
            'message' => 'State:
finished exploring under take-1
path is still [1]
before trying skip-1

What?',
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Undo — pop 1 so path=[] again', 'next' => 'ask_feat'],
                ['label' => 'Leave [1] — sibling branch can ignore it', 'next' => 'w_leave'],
            ],
        ],
        'w_leave' => [
            'message' => 'Wrong.

Leftover 1 pollutes the skip-1 branch. Restore first.

Step back.',
            'outcome' => 'wrong',
            'rewind_to' => 'after_take',
            'choices' => [],
        ],
        'ask_feat' => [
            'message' => 'State:
you used recursion + pop

Is backtracking a separate language feature?',
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No — it is recursion that restores state', 'next' => 'success'],
                ['label' => 'Yes — you need a special keyword', 'next' => 'w_kw'],
            ],
        ],
        'w_kw' => [
            'message' => 'Wrong.

No keyword required. Choose → explore → undo is the whole idea.

Step back.',
            'outcome' => 'wrong',
            'rewind_to' => 'ask_feat',
            'choices' => [],
        ],
        'success' => [
            'message' => 'Correct.

- path=[] → take → undo → skip
- Ordinary recursion
- Undo is the “backtrack”

You finished this path.',
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
