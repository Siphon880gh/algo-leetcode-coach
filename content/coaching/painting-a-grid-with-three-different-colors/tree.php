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
            'message' => "Read the problem statement above.\nState per column?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The full column colouring (m ≤ 5)', 'next' => 's2'],
                ['label' => 'Just the top cell', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Every row constrains the next column.\nStep back to when you tracked one cell.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Compatible columns?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Differ in at least one row', 'next' => 'wrong_b'],
                ['label' => 'Differ in every row', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Any equal row means equal horizontal neighbours.\nStep back to when you required one difference.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Which side is the column?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The short side m', 'next' => 'success'],
                ['label' => 'The long side n', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Columns of height 1000 cannot be enumerated.\nStep back to when you used n.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n · S²). Examples → 3, 6, 580986.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
