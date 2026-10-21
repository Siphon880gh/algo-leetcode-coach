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
            'message' => "Read the problem statement above.\nA digit run like 123?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Try every split: 1+2+3, 12+3, 1+23, 123', 'next' => 's2'],
                ['label' => 'Read it as one number', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. In Example 2, l123e must be l + 6 letters + e to match 44; 123 as one number cannot.\nStep back to when you read the whole run.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "One side has pending wildcards, the other a letter?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Fail', 'next' => 'wrong_b'],
                ['label' => 'The letter uses up one wildcard', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. In Example 1, the 18 of i18n absorbs nternationalizatio.\nStep back to when you failed.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Nothing pending and both sides show letters?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'They must be equal', 'next' => 'success'],
                ['label' => 'Accept any pair', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Example 3: a5b and c5b differ in the first letter → false.\nStep back to when you accepted any pair.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Memoise (i, j, diff). Examples → true, true, false.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
