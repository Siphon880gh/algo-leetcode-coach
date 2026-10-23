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
            'message' => "State:\nnums = [1, 2, 3]\npath = [1, 2]\nunused = {3}\n\nNext complete permutation on this branch?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '[1, 2, 3]', 'next' => 'count'],
                ['label' => '[1, 2] — already complete at length 2', 'next' => 'w_short'],
            ],
        ],
        'w_short' => [
            'message' => "Wrong.\n\nA permutation of 3 elements has length 3.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'count' => [
            'message' => "State:\nn = 3, all orderings\n\nHow many permutations?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '6 = 3!', 'next' => 'copy'],
                ['label' => '3 — one per starting element only', 'next' => 'w_3'],
            ],
        ],
        'w_3' => [
            'message' => "Wrong.\n\nEvery ordering counts: 3×2×1 = 6.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'count',
            'choices' => [],
        ],
        'copy' => [
            'message' => "State:\nat a leaf you do answers.append(path) with no copy\nthen you pop while backtracking\n\nWhat happens?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Saved entries mutate/empty — append a copy path[:]', 'next' => 'success'],
                ['label' => 'Nothing — append freezes the list forever', 'next' => 'w_ref'],
            ],
        ],
        'w_ref' => [
            'message' => "Wrong.\n\nYou stored a reference. Undos change every saved row.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'copy',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct.\n\n- Build perms with used[] or swaps\n- n! leaves, copy path at each leaf\n\nYou finished this path.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
