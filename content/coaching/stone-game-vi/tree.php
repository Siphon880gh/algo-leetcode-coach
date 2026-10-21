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
            'message' => "Read the problem statement above.\nPick by own value?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: by a + b', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Taking a stone also denies the opponent its value.\nStep back to when you used your own value.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Who takes even positions?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Bob', 'next' => 'wrong_b'],
                ['label' => 'Alice (she moves first)', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Alice starts.\nStep back to when you gave Bob the first pick.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Return?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '1, 0 or −1 by comparing totals', 'next' => 'success'],
                ['label' => 'The score difference', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The statement asks for the outcome sign.\nStep back to when you returned the difference.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). Examples → 1, 0, −1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
