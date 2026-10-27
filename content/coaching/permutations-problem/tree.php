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
            'message' => "State:\nnums = [1, 2, 3]\npath = [1, 2]\nunused: 3\n\nWhich complete permutation does this branch produce next?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '[1, 2, 3]', 'next' => 'count'],
                ['label' => '[1, 2], which is already complete at length 2', 'next' => 'w_short'],
            ],
        ],
        'w_short' => [
            'message' => "Wrong.\n\nA permutation of 3 elements has length 3.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'count' => [
            'message' => "State:\nn = 3, all orderings\n\nHow many permutations are there?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '6, which is 3!', 'next' => 'copy'],
                ['label' => '3, one for each starting element', 'next' => 'w_3'],
            ],
        ],
        'w_3' => [
            'message' => "Wrong.\n\nEvery ordering counts: 3 × 2 × 1 = 6.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'count',
            'choices' => [],
        ],
        'copy' => [
            'message' => "State:\nat a leaf, you run answers.append(path) without copying\nthen you pop while backtracking\n\nWhat happens?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The saved entries change or empty out, so append a copy, path[:]', 'next' => 'success'],
                ['label' => 'Nothing, because append freezes the list', 'next' => 'w_ref'],
            ],
        ],
        'w_ref' => [
            'message' => "Wrong.\n\nYou stored a reference to the same list. Every undo changes every saved entry.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'copy',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct.\n\n- Build permutations with a used[] array or with swaps.\n- There are n! leaves, and you copy the path at each one.\n\nYou finished this path.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
