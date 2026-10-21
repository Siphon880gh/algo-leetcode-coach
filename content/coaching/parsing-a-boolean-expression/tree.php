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
            'message' => "Read the problem statement above.\nEvaluate left to right ignoring nesting?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: reduce innermost groups first', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Operators can contain other expressions.\nStep back to when you ignored nesting.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "What do you do with commas?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Push them', 'next' => 'wrong_b'],
                ['label' => 'Skip them', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. They only separate arguments.\nStep back to when you pushed commas.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Operator & over values. Result?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'true only if every value is t', 'next' => 'success'],
                ['label' => 'true if any value is t', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. That is |.\nStep back to when you used any.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). \"&(|(f))\" → false. \"|(f,f,f,t)\" → true. \"!(&(f,t))\" → true.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
