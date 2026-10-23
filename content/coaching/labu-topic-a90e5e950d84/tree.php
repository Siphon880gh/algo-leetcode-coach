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
empty paper
goal = compute Fib f(5)

What do you write first?',
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'f(0)=0 and f(1)=1 — the bases', 'next' => 'after_base'],
                ['label' => 'A blank 3D array named dp', 'next' => 'w_arr'],
            ],
        ],
        'w_arr' => [
            'message' => 'Wrong.

Without a state sentence and bases, the array has no meaning. Start with f(0), f(1).

Step back.',
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'after_base' => [
            'message' => 'State:
f(0)=0
f(1)=1
next = f(2)

Value?',
            'outcome' => 'continue',
            'choices' => [
                ['label' => '1 — f(1)+f(0)', 'next' => 'ask_order'],
                ['label' => '2 — skip ahead to f(3)', 'next' => 'w_2'],
            ],
        ],
        'w_2' => [
            'message' => 'Wrong.

f(2)=1+0=1. Build in order; do not jump.

Step back.',
            'outcome' => 'wrong',
            'rewind_to' => 'after_base',
            'choices' => [],
        ],
        'ask_order' => [
            'message' => 'State:
transition needs f(i-1) and f(i-2)

Bottom-up order?',
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Increasing i: 2, then 3, then 4…', 'next' => 'success'],
                ['label' => 'Start at i=5 and go downward with empty lower cells', 'next' => 'w_ord'],
            ],
        ],
        'w_ord' => [
            'message' => 'Wrong.

Dependencies point at smaller i. Fill small → large.

Step back.',
            'outcome' => 'wrong',
            'rewind_to' => 'ask_order',
            'choices' => [],
        ],
        'success' => [
            'message' => 'Correct.

- State: f(i)
- Transition: sum of two previous
- Bases: 0 and 1
- Order: increasing i → f(5)=5

You finished this path.',
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
