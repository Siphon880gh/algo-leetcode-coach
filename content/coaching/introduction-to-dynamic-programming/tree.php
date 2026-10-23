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
empty line for Fib
f(0) and f(1) known

Write?',
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'f(0)=0, f(1)=1', 'next' => 'mid'],
                ['label' => 'Leave blanks — recursion will invent bases', 'next' => 'w1'],
            ],
        ],
        'w1' => [
            'message' => 'Wrong.

Bases stop the recurrence. Write 0 and 1 first.

Step back.',
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'mid' => [
            'message' => 'State:
0, 1, ?, ?, ?, ?
fill f(2)…f(5)

f(5)?',
            'outcome' => 'continue',
            'choices' => [
                ['label' => '5', 'next' => 'ask'],
                ['label' => '8', 'next' => 'w2'],
            ],
        ],
        'w2' => [
            'message' => 'Wrong.

0,1,1,2,3,5 — f(5)=5. (8 is f(6).)

Step back.',
            'outcome' => 'wrong',
            'rewind_to' => 'mid',
            'choices' => [],
        ],
        'ask' => [
            'message' => 'State:
naive recursion for F(5) recomputes F(3)

Why is the line faster?',
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Each f(i) computed once and reused', 'next' => 'success'],
                ['label' => 'It secretly still recomputes everything', 'next' => 'w3'],
            ],
        ],
        'w3' => [
            'message' => 'Wrong.

Bottom-up visits each index once — that is the win.

Step back.',
            'outcome' => 'wrong',
            'rewind_to' => 'ask',
            'choices' => [],
        ],
        'success' => [
            'message' => 'Correct.

- Bases on the board
- Fill left→right
- Cache overlapping work

You finished this path.',
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
