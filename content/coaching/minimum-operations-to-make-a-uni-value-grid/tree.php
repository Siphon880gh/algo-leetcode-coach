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
            'message' => "Read the problem statement above.\nAlways possible?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only if every value has the same remainder mod x', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Adding or subtracting x keeps v mod x; Example 3 → −1.\nStep back to when you assumed it is possible.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Target value?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The mean', 'next' => 'wrong_b'],
                ['label' => 'The median', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. For [1,2,9] with x = 1 the mean 4 costs 10, the median 2 costs 8.\nStep back to when you used the mean.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Operations for one value?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '|v − t| / x', 'next' => 'success'],
                ['label' => '|v − t|', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Each operation moves by x; Example 1 would give 8 instead of 4.\nStep back to when you forgot to divide.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(mn log(mn)). Examples → 4, 5, −1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
