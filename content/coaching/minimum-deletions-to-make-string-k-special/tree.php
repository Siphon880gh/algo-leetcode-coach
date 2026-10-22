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
            'message' => "Read the problem statement above.\nFloor f?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Try every existing count', 'next' => 's2'],
                ['label' => 'The smallest count', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Dropping a rare letter can be cheaper: example 1 → 4 instead of 3.\nStep back to when you fixed the floor.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Letters above f + k?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Delete entirely', 'next' => 'wrong_b'],
                ['label' => 'Trim to f + k', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 2 → 3 instead of 2.\nStep back to when you deleted them.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n + 26²). Examples → 3, 2, 1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
