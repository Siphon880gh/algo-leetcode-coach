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
            'message' => "State:\nempty paper\ngoal: compute the Fibonacci number f(5)\n\nWhat do you write first?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The base cases, f(0) = 0 and f(1) = 1', 'next' => 'after_base'],
                ['label' => 'A blank 3D array named dp', 'next' => 'w_arr'],
            ],
        ],
        'w_arr' => [
            'message' => "Wrong.\n\nWithout a state sentence and base cases, the array means nothing. Start with f(0) and f(1).\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'after_base' => [
            'message' => "State:\nf(0) = 0\nf(1) = 1\nnext: f(2)\n\nWhat is its value?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '1, from f(1) + f(0)', 'next' => 'ask_order'],
                ['label' => '2, skipping ahead to f(3)', 'next' => 'w_2'],
            ],
        ],
        'w_2' => [
            'message' => "Wrong.\n\nf(2) = 1 + 0 = 1. Build in order and do not jump ahead.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'after_base',
            'choices' => [],
        ],
        'ask_order' => [
            'message' => "State:\nthe transition needs f(i - 1) and f(i - 2)\n\nWhat order do you fill in, bottom-up?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Increasing i: 2, then 3, then 4, and so on', 'next' => 'success'],
                ['label' => 'Start at i = 5 and go down, while the lower cells are still empty', 'next' => 'w_ord'],
            ],
        ],
        'w_ord' => [
            'message' => "Wrong.\n\nEach value depends on smaller i, so fill from small to large.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'ask_order',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct.\n\n- State: f(i).\n- Transition: the sum of the two previous values.\n- Base cases: 0 and 1.\n- Order: increasing i, which gives f(5) = 5.\n\nYou finished this path.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
