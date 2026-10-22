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
            'message' => "Problem: Given a function and an array of arguments in which some entries are placeholders, return a function that takes more arguments, fills the placeholders with them in order, appends any that are left over, and calls the original. The placeholder value is in the official statement. For instance, with arguments [1, placeholder, 3] and new arguments 2 and 4, the call is made with 1, 2, 3, 4. (Restated from memory; limits and examples may differ slightly.)\nFill the placeholders in?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'A copy of args', 'next' => 's2'],
                ['label' => 'args itself', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. The first call’s values stick; in Node the second call → 1, 2, 3, 5 instead of 1, 5, 3.\nStep back to when you changed args.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "New arguments left over?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Drop them', 'next' => 'wrong_b'],
                ['label' => 'Append them', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. They belong at the end; in Node the example → 1, 2, 3 instead of 1, 2, 3, 4.\nStep back to when you dropped them.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(arguments) per call. The checks → 1, 2, 3, 4 and 1, 5, 3.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
