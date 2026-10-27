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
            'message' => "State:\nthe call tree of naive fib(n)\n\nWhat is its time cost?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Exponential', 'next' => 'mid'],
                ['label' => 'O(n)', 'next' => 'w1'],
            ],
        ],
        'w1' => [
            'message' => "Wrong.\n\nThe calls overlap and multiply, so the tree has exponentially many nodes.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'mid' => [
            'message' => "State:\na single chain of recursive calls, n deep\n\nWhat is its space cost?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'O(n)', 'next' => 'final'],
                ['label' => 'O(1)', 'next' => 'w2'],
            ],
        ],
        'w2' => [
            'message' => "Wrong.\n\nThere are n stack frames alive at the deepest point.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'mid',
            'choices' => [],
        ],
        'final' => [
            'message' => "State:\nnaive Fibonacci blows up\n\nWhat fixes it?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'A memo, or bottom-up DP', 'next' => 'success'],
                ['label' => 'Longer variable names', 'next' => 'w3'],
            ],
        ],
        'w3' => [
            'message' => "Wrong.\n\nCache the overlapping states so each one is computed once.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'final',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct.\n\n- Time counts the calls that do work.\n- Space is roughly the maximum depth.\n- Add a memo when states overlap.\n\nYou finished this path.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
