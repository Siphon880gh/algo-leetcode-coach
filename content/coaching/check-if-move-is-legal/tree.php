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
            'message' => "Read the problem statement above.\nDirections?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'All 8', 'next' => 's2'],
                ['label' => 'Only 4 orthogonal', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Diagonal lines count too.\nStep back to when you used four.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Adjacent own colour immediately?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Good line', 'next' => 'wrong_b'],
                ['label' => 'Not a good line', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A line needs at least three cells.\nStep back to when you accepted length 2.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Free cell on the way?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Stop; this direction fails', 'next' => 'success'],
                ['label' => 'Skip over it', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Free cells break a line.\nStep back to when you skipped it.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(64). Examples → true, false.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
