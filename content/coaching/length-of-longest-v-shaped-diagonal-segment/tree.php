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
            'message' => "Read the problem statement above.\nTurn direction?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Clockwise', 'next' => 's2'],
                ['label' => 'Counter-clockwise', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 → 3 instead of 5.\nStep back to when you turned counter-clockwise.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Turns?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Any number', 'next' => 'wrong_b'],
                ['label' => 'At most one', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. grid [[0, 2, 2], [0, 2, 1], [0, 2, 2]] → 4 instead of 3.\nStep back to when you allowed more.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(8 · nm). Examples → 5, 4, 5, 1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
