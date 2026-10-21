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
            'message' => "Read the problem statement above.\nTest what?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The digit count is even', 'next' => 's2'],
                ['label' => 'The value is even', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. 12 and 7896 count; 2 and 6 do not.\nStep back to when you tested the value.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Count digits by?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'log10 without care', 'next' => 'wrong_b'],
                ['label' => 'String length or dividing by 10', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Floating error can misjudge powers of 10.\nStep back to when you used log10.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Return?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'How many numbers qualify', 'next' => 'success'],
                ['label' => 'The numbers themselves', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The answer is a count.\nStep back to when you returned a list.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n · digits). [12,345,2,6,7896] → 2. [555,901,482,1771] → 1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
