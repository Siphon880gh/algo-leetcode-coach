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
            'message' => "State:\nstairs: f(i) = f(i - 1) + f(i - 2)\n\nWhat is the first step of the playbook?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Write the recursive definition and check it', 'next' => 'mid'],
                ['label' => 'Compress to two variables right away', 'next' => 'w1'],
            ],
        ],
        'w1' => [
            'message' => "Wrong.\n\nThe definition comes first. Compression comes last.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'mid' => [
            'message' => "State:\nthe top-down recursion with memoization works\n\nWhat usually comes next?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'A bottom-up table filled in dependency order', 'next' => 'final'],
                ['label' => 'Throw away the recurrence and guess some loops', 'next' => 'w2'],
            ],
        ],
        'w2' => [
            'message' => "Wrong.\n\nTranslate the same recurrence into a table.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'mid',
            'choices' => [],
        ],
        'final' => [
            'message' => "State:\ndp[i] only needs dp[i - 1] and dp[i - 2]\n\nCan you compress it?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Yes, to two variables', 'next' => 'success'],
                ['label' => 'No, it can never be compressed', 'next' => 'w3'],
            ],
        ],
        'w3' => [
            'message' => "Wrong.\n\nWhen each step only needs a couple of earlier values, you can keep just those.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'final',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct.\n\n- Go from plain recursion, to memoization, to a table, to a compressed loop.\n- Keep the same transition the whole way.\n\nYou finished this path.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
