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
            'message' => "State:\nadd up 1 to n using sum(n) = n + sum(n - 1)\n\nHow much extra space does this usually take?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'O(n), one stack frame per call', 'next' => 'mid'],
                ['label' => 'O(1), exactly the same as a loop', 'next' => 'w1'],
            ],
        ],
        'w1' => [
            'message' => "Wrong.\n\nPlain recursion goes n calls deep before returning.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'mid' => [
            'message' => "State:\nyou are writing a binary tree algorithm\n\nWhich style fits naturally?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Recursion on the left and right children', 'next' => 'final'],
                ['label' => 'Only nested for loops over the children', 'next' => 'w2'],
            ],
        ],
        'w2' => [
            'message' => "Wrong.\n\nTrees have a recursive shape, so recursion fits them well.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'mid',
            'choices' => [],
        ],
        'final' => [
            'message' => "State:\nyou turn a tail-recursive function into a loop\n\nWhy do that?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'To bound the space and avoid a stack overflow', 'next' => 'success'],
                ['label' => 'To always make the Big-O time smaller', 'next' => 'w3'],
            ],
        ],
        'w3' => [
            'message' => "Wrong.\n\nThe time class usually stays the same. The saving is stack space.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'final',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct.\n\n- A loop reuses one frame.\n- Recursion stacks up one frame per level of depth.\n\nYou finished this path.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
