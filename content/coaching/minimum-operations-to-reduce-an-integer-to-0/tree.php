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
            'message' => "Read the problem statement above.\nLow bits are 11?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Add 1 to carry the run', 'next' => 's2'],
                ['label' => 'Subtract 1', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Clearing a run bit by bit costs more; Example 1 → 4 instead of 3.\nStep back to when you subtracted.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Low bits are 01?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Add 1', 'next' => 'wrong_b'],
                ['label' => 'Subtract 1', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. n = 1 turns into 2 and back to 1 forever; n = 5 never finishes instead of 2.\nStep back to when you added.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(log n). Examples → 3, 3.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
