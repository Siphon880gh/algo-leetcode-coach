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
            'message' => "Read the problem statement above.\nEqual digits?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Not a pair', 'next' => 's2'],
                ['label' => 'Allowed', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. 22 → 22 instead of the empty string.\nStep back to when you allowed them.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Which pair?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The last', 'next' => 'wrong_b'],
                ['label' => 'The first from the left', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. 122333 → 23 instead of 12.\nStep back to when you kept the last.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 23, 21, empty.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
