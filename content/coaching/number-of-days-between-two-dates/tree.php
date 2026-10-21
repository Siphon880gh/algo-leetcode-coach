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
            'message' => "Read the problem statement above.\nLeap year rule?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Divisible by 4, not by 100 unless by 400', 'next' => 's2'],
                ['label' => 'Divisible by 4', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. 2100 is not a leap year.\nStep back to when you used only 4.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Dates in either order?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Subtract date1 − date2', 'next' => 'wrong_b'],
                ['label' => 'Take the absolute difference', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The answer is non-negative.\nStep back to when you kept the sign.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "February in a leap year?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '29 days', 'next' => 'success'],
                ['label' => '28 days', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Leap years add February 29.\nStep back to when you used 28.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(years). 2019-06-29 to 2019-06-30 → 1. 2020-01-15 to 2019-12-31 → 15.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
