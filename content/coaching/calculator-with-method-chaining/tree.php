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
            'message' => "Read the problem statement above.\nEach operation returns?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'this', 'next' => 's2'],
                ['label' => 'The new value', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. The next call then runs on a number; in Node add(5).subtract(7) throws a TypeError.\nStep back to when you returned the value.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "divide by 0?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Let JavaScript divide', 'next' => 'wrong_b'],
                ['label' => 'Throw Division by zero is not allowed', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. 20 / 0 is Infinity in JavaScript, not an error; example 3 → Infinity instead of the message.\nStep back to when you skipped the check.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(1) per call. Examples → 8, 100, Division by zero is not allowed.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
