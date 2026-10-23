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
            'message' => "Read the problem statement above.\nFirst ride of a kind?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The one that finishes earliest', 'next' => 's2'],
                ['label' => 'The one that opens earliest', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Land [1, 2] lasting [10, 1], water [5] lasting [10] → 16 instead of 15.\nStep back to when you took the earliest opening.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Orders?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Land first only', 'next' => 'wrong_b'],
                ['label' => 'Both', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 2 → 18 instead of 14.\nStep back to when you fixed the order.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n + m). Examples → 9, 14.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
