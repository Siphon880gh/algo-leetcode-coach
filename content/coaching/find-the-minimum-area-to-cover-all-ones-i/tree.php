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
            'message' => "Read the problem statement above.\nRows of the box?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Min and max rows holding a 1', 'next' => 's2'],
                ['label' => 'First and last rows of the grid', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 2 → 2 instead of 1.\nStep back to when you used the whole grid.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Area?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '(r2 − r1)(c2 − c1)', 'next' => 'wrong_b'],
                ['label' => '(r2 − r1 + 1)(c2 − c1 + 1)', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 2 → 0 instead of 1.\nStep back to when you dropped the + 1.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(m n). Examples → 6, 1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
