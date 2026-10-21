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
            'message' => "Read the problem statement above.\nRepeatedly delete \"abc\" with string replace?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: a stack does it in one pass', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Repeated replacing can be O(n²).\nStep back to when you used replace.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "You read c. What must be on top?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Anything', 'next' => 'wrong_b'],
                ['label' => 'b, with a below it', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. c only completes an abc.\nStep back to when you accepted anything.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "The scan ends. When is the word valid?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The stack is empty', 'next' => 'success'],
                ['label' => 'The stack has fewer than 3 characters', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Any leftover letter is an incomplete abc.\nStep back to when you allowed leftovers.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). \"aabcbc\" → true. \"abcabcababcc\" → true. \"abccba\" → false.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
