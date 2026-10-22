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
            'message' => "Read the problem statement above.\ncreateHelloWorld returns?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'A function that returns the string', 'next' => 's2'],
                ['label' => 'The string itself', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. The result is called next; in Node calling a string → a TypeError instead of Hello World.\nStep back to when you returned the string.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "When arguments are passed?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Return the string only when there are none', 'next' => 'wrong_b'],
                ['label' => 'Ignore them', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Arguments must not matter; Example 2 → undefined instead of Hello World.\nStep back to when you checked the arguments.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(1). Examples → Hello World, Hello World.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
