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
            'message' => "State:\na='ab', b='a', delete-only\n\nDistance?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '1', 'next' => 'mid'],
                ['label' => '0', 'next' => 'w1'],
            ],
        ],
        'w1' => [
            'message' => "Wrong.\n\nOne delete turns ab into a.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'mid' => [
            'message' => "State:\nchars a[i-1]==b[j-1]\n\nTypical move?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Take diagonal dp[i-1][j-1]', 'next' => 'final'],
                ['label' => 'Always pay a delete', 'next' => 'w2'],
            ],
        ],
        'w2' => [
            'message' => "Wrong.\n\nMatches ride the diagonal free.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'mid',
            'choices' => [],
        ],
        'final' => [
            'message' => "State:\nnext skill after delete-only\n\n?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Add insert/replace for full edit distance', 'next' => 'success'],
                ['label' => 'Switch to sorting', 'next' => 'w3'],
            ],
        ],
        'w3' => [
            'message' => "Wrong.\n\nLevenshtein adds the other ops.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'final',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct.\n\n- Prefix tables first\n- Grow into full edit distance\n\nYou finished this path.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
