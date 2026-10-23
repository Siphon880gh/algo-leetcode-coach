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
            'message' => "State:\nsum 1…n via sum(n)=n+sum(n-1)\n\nExtra space typical?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'O(n) stack frames', 'next' => 'mid'],
                ['label' => 'O(1) always identical to a loop', 'next' => 'w1'],
            ],
        ],
        'w1' => [
            'message' => "Wrong.\n\nNaive recursion depth is n.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'mid' => [
            'message' => "State:\nbinary tree algorithms\n\nNatural style?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Recursion on left/right', 'next' => 'final'],
                ['label' => 'Only nested for-loops over children counts', 'next' => 'w2'],
            ],
        ],
        'w2' => [
            'message' => "Wrong.\n\nTrees fit recursive structure.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'mid',
            'choices' => [],
        ],
        'final' => [
            'message' => "State:\nconvert tail recursion to a loop\n\nWhy?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Bound space / avoid stack overflow', 'next' => 'success'],
                ['label' => 'Make Big-O time smaller always', 'next' => 'w3'],
            ],
        ],
        'w3' => [
            'message' => "Wrong.\n\nTime class often unchanged; space/stack is the win.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'final',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct.\n\n- Loops reuse one frame\n- Recursion stacks depth\n\nYou finished this path.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
