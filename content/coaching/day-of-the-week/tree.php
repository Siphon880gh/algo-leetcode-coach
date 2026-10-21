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
            'message' => "Read the problem statement above.\nReference day?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '1971-01-01 is a Friday', 'next' => 's2'],
                ['label' => '1971-01-01 is a Monday', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Start the week list on Friday.\nStep back to when you used Monday.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Add the day of the month as?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'day', 'next' => 'wrong_b'],
                ['label' => 'day − 1', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. January 1 itself is offset 0.\nStep back to when you added the full day.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Is 2100 a leap year?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: divisible by 100, not by 400', 'next' => 'success'],
                ['label' => 'Yes', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. 2100 is in range and not leap.\nStep back to when you used the 4-year rule only.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(years). 31/8/2019 → \"Saturday\". 18/7/1999 → \"Sunday\". 15/8/1993 → \"Sunday\".\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
