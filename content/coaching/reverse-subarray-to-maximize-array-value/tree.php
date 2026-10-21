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
            'message' => "Read the problem statement above.\nTry every subarray?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: analyse the edges', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. That is O(n²) or worse.\nStep back to when you tried them all.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Interior gain?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'max − min', 'next' => 'wrong_b'],
                ['label' => '2 · (max min − min max)', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Two edges change, each by that gap.\nStep back to when you dropped the factor 2.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Prefix or suffix reversal?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Handle separately', 'next' => 'success'],
                ['label' => 'Covered by the interior formula', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Only one edge changes there.\nStep back to when you skipped it.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). [2,3,1,5,4] → 10. [2,4,9,24,2,1,10] → 68.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
