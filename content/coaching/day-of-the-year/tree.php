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
            'message' => "Read the problem statement above.\nSum which months?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Those before the given month', 'next' => 's2'],
                ['label' => 'Up to and including it', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The current month adds only the day.\nStep back to when you included it.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Leap year rule?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Divisible by 4', 'next' => 'wrong_b'],
                ['label' => 'Divisible by 4, and not by 100 unless by 400', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. 1900 is in range and is not a leap year.\nStep back to when you used only 4.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "January date in a leap year. Add 1?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: only after February', 'next' => 'success'],
                ['label' => 'Yes', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The leap day comes after January.\nStep back to when you added it.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(1). \"2019-01-09\" → 9. \"2019-02-10\" → 41.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
