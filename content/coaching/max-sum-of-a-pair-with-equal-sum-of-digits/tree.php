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
            'message' => "Read the problem statement above.\nGroup numbers by?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Digit sum', 'next' => 's2'],
                ['label' => 'Last digit', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. 43 and 13 pair although their digit sums differ; Example 1 → 56 instead of 54.\nStep back to when you grouped by last digit.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Kept value per group?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The first seen', 'next' => 'wrong_b'],
                ['label' => 'The largest seen so far', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. [9,18,27] → 36 instead of 45.\nStep back to when you kept the first number.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "No group has two numbers?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Return −1', 'next' => 'success'],
                ['label' => 'Return 0', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. [1,2] → 0 instead of −1.\nStep back to when you returned 0.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n · digits). Examples → 54, −1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
