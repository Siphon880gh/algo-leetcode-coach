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
            'message' => "Read the problem statement above.\nA digit removes?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The top of the stack', 'next' => 's2'],
                ['label' => 'The leftmost letter', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. ab1c2 → c instead of a.\nStep back to when you took the leftmost.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "The digit itself?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Stays', 'next' => 'wrong_b'],
                ['label' => 'Goes too', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 2 → 34 instead of an empty string.\nStep back to when you kept the digits.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → abc, empty string.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
