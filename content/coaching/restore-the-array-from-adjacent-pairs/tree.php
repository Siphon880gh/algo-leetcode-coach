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
            'message' => "Read the problem statement above.\nWhere to start?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'A value with exactly one neighbour', 'next' => 's2'],
                ['label' => 'The first pair\'s first value', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Pairs are unordered and may start mid-array.\nStep back to when you used the first pair.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Storage for neighbours?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Array indexed by value', 'next' => 'wrong_b'],
                ['label' => 'Hash map (values can be negative)', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Negative values need an offset or a map.\nStep back to when you indexed by raw value.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Next element?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The neighbour that is not the previous one', 'next' => 'success'],
                ['label' => 'Always adj[cur][0]', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. That can step back to where you came from.\nStep back to when you took index 0.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → [1,2,3,4], [-2,4,1,-3], [100000,-100000].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
