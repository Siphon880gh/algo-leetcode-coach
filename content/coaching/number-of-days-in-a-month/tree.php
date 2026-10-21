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
            'message' => "Problem: Given a year and a month (1 to 12), return the number of days in that month. For instance, July 1992 has 31 days, February 2000 has 29, and February 1900 has 28. (Restated from memory; limits and examples may differ slightly.)\nIs every year divisible by 4 a leap year?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: century years need divisibility by 400', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. 1900 is not a leap year.\nStep back to when you used only the 4 rule.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Year 2000, month 2?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '28', 'next' => 'wrong_b'],
                ['label' => '29', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. 2000 is divisible by 400.\nStep back to when you said 28.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Month 9?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '30', 'next' => 'success'],
                ['label' => '31', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. September has 30 days.\nStep back to when you said 31.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(1). 1992, 7 → 31. 2000, 2 → 29. 1900, 2 → 28.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
