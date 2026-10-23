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
            'message' => "Read the problem statement above.\nDistance rule?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Invert only if the nearest inverted ancestor is ≥ k edges up', 'next' => 's2'],
                ['label' => 'Invert anywhere', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 2 → 15 instead of 9.\nStep back to when you ignored the distance.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "After inverting u, distance passed to children?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The old distance + 1', 'next' => 'wrong_b'],
                ['label' => '1', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 2 → 15 instead of 9.\nStep back to when you kept counting from the older ancestor.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n · k). Examples → 27, 9, 3.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
