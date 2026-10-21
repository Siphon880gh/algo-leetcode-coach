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
            'message' => "Read the problem statement above.\nTrack?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The score difference', 'next' => 's2'],
                ['label' => 'Both scores separately', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The difference captures optimal play directly.\nStep back to when you tracked both.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Taking more stones is always better?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Yes', 'next' => 'wrong_b'],
                ['label' => 'No: values can be negative', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Negative stones can hurt.\nStep back to when you always took three.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "f(0) = 0?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Tie', 'next' => 'success'],
                ['label' => 'Alice wins', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Equal scores are a tie.\nStep back to when you declared a winner.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). [1,2,3,7] → Bob. [1,2,3,-9] → Alice. [1,2,3,6] → Tie.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
