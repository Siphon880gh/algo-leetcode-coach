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
            'message' => "Read the problem statement above.\nNegative number?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Digits descending', 'next' => 's2'],
                ['label' => 'Digits ascending', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 2 → −7650; ascending gives −567, which is larger.\nStep back to when you sorted ascending.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Positive with zeros?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Plain ascending sort', 'next' => 'wrong_b'],
                ['label' => 'Swap the first non-zero digit to the front', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. 310 → 013, which has a leading zero; the answer is 103.\nStep back to when you kept the zero in front.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Magnitude?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '64-bit', 'next' => 'success'],
                ['label' => '32-bit', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. |num| reaches 10^15.\nStep back to when you chose 32-bit.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(d log d). Examples → 103, −7650.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
