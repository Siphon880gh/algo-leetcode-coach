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
            'message' => "Read the problem statement above.\nPiece length?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'n − numFriends + 1', 'next' => 's2'],
                ['label' => 'n − numFriends', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. dbca, numFriends = 2 → db instead of dbc.\nStep back to when you dropped the + 1.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "One friend?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Same scan', 'next' => 'wrong_b'],
                ['label' => 'Return the whole word', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. ab, numFriends = 1 → b instead of ab.\nStep back to when you used the scan.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n · L). Examples → dbc, g.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
