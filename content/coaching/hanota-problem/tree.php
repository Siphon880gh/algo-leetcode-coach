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
n = 2
A = [large, small]
B = []
C = []
goal = both on C

First legal move?',
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Small A→B', 'next' => 'after1'],
                ['label' => 'Large A→C first', 'next' => 'w_large'],
            ],
        ],
        'w_large' => [
            'message' => 'Wrong.

Small still sits on large. Move the small aside first.

Step back.',
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'after1' => [
            'message' => 'State:
A = [large]
B = [small]
C = []

Next?',
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Large A→C, then small B→C', 'next' => 'ask_n3'],
                ['label' => 'Small B→C now (large still on A)', 'next' => 'w_order'],
            ],
        ],
        'w_order' => [
            'message' => 'Wrong.

That puts small on C alone, then large has nowhere legal. Move large to C while small waits on B.

Step back.',
            'outcome' => 'wrong',
            'rewind_to' => 'after1',
            'choices' => [],
        ],
        'ask_n3' => [
            'message' => 'State:
n=2 took 3 moves
same pattern for n=3

Total moves?',
            'outcome' => 'continue',
            'choices' => [
                ['label' => '7 = 2³−1', 'next' => 'success'],
                ['label' => '3 — one move per disk', 'next' => 'w_count'],
            ],
        ],
        'w_count' => [
            'message' => 'Wrong.

Move 2-tower aside (3) + largest (1) + 2-tower on top (3) = 7.

Step back.',
            'outcome' => 'wrong',
            'rewind_to' => 'ask_n3',
            'choices' => [],
        ],
        'success' => [
            'message' => 'Correct.

- n=2: small aside, large, small on top
- n=3: same idea → 7 moves

You finished this path.',
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
