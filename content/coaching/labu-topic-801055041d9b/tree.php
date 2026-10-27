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
            'message' => "State:\na = 'ab', b = 'a'\nonly deletions are allowed\n\nWhat is the distance?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '1', 'next' => 'mid'],
                ['label' => '0', 'next' => 'w1'],
            ],
        ],
        'w1' => [
            'message' => "Wrong.\n\nOne deletion turns \"ab\" into \"a\".\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'mid' => [
            'message' => "State:\nthe characters match: a[i-1] == b[j-1]\n\nWhat is the usual move?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Take the diagonal value, dp[i-1][j-1]', 'next' => 'final'],
                ['label' => 'Always pay for a deletion', 'next' => 'w2'],
            ],
        ],
        'w2' => [
            'message' => "Wrong.\n\nMatching characters move along the diagonal for free.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'mid',
            'choices' => [],
        ],
        'final' => [
            'message' => "State:\nyou have mastered delete-only tables\n\nWhat do you learn next?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Add insert and replace for full edit distance', 'next' => 'success'],
                ['label' => 'Switch to sorting', 'next' => 'w3'],
            ],
        ],
        'w3' => [
            'message' => "Wrong.\n\nLevenshtein distance adds the other operations.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'final',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct.\n\n- Start with prefix tables.\n- Then grow into full edit distance.\n\nYou finished this path.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
