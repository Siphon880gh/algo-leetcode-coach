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
            'message' => "State:\nan empty row for Fibonacci values\nf(0) and f(1) are known\n\nWhat do you write first?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'f(0) = 0 and f(1) = 1', 'next' => 'mid'],
                ['label' => 'Nothing yet, because the recursion will invent the base cases', 'next' => 'w1'],
            ],
        ],
        'w1' => [
            'message' => "Wrong.\n\nThe base cases stop the recurrence. Write 0 and 1 first.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'mid' => [
            'message' => "State:\nthe row so far: 0, 1, ?, ?, ?, ?\nfill in f(2) to f(5)\n\nWhat is f(5)?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '5', 'next' => 'ask'],
                ['label' => '8', 'next' => 'w2'],
            ],
        ],
        'w2' => [
            'message' => "Wrong.\n\nThe row is 0, 1, 1, 2, 3, 5, so f(5) = 5. The value 8 is f(6).\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'mid',
            'choices' => [],
        ],
        'ask' => [
            'message' => "State:\nplain recursion for F(5) computes F(3) more than once\n\nWhy is filling the row faster?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Each f(i) is computed once and then reused', 'next' => 'success'],
                ['label' => 'It secretly still recomputes everything', 'next' => 'w3'],
            ],
        ],
        'w3' => [
            'message' => "Wrong.\n\nFilling from the bottom up visits each index once. That is the whole saving.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'ask',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct.\n\n- Write the base cases first.\n- Fill the row from left to right.\n- Cache work that would otherwise repeat.\n\nYou finished this path.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
