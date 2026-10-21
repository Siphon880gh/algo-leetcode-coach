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
            'message' => "Read the problem statement above.\nUse the problem-769 rule, max == index?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: values repeat and are arbitrary', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. That rule needs a permutation of 0 … n − 1.\nStep back to when you reused 769.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "x is smaller than the top chunk's max. Then?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Push x as its own chunk', 'next' => 'wrong_b'],
                ['label' => 'Pop the top as m, pop all maxima > x, push m back', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. x must sort before those larger values, so their chunks merge with x.\nStep back to when you pushed x.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "x equals the top. Merge?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: push x, it can be its own chunk', 'next' => 'success'],
                ['label' => 'Yes', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Equal values can sit in separate chunks.\nStep back to when you merged on equal.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). [5,4,3,2,1] → 1. [2,1,3,4,4] → 4.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
