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
            'message' => "Read the problem statement above.\nCompute the product how?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '2 to the sum of exponents', 'next' => 's2'],
                ['label' => 'Build big_nums and multiply', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Indices reach 10^15.\nStep back to when you built the array.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "First index?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '1', 'next' => 'wrong_b'],
                ['label' => '0', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. big_nums starts at index 0: example 1 → [2] instead of [4].\nStep back to when you counted from 1.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(log² N) per query. Examples → [4], [2, 2].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
