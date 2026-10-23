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
            'message' => "Problem: You get a string that is either an integer literal, possibly negative, or a call op(a,b) where op is add, sub, mul or div and a and b are valid expressions themselves. Return its integer value. Assumed here: every division comes out exact and every intermediate value fits in a 64-bit integer. Limits are in the official statement. (Restated from memory; limits and examples may differ slightly.)\nRead a number how?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Optional "-", then all digits', 'next' => 's2'],
                ['label' => 'Digits only', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Made-up \"add(-4,6)\" → 10 instead of 2.\nStep back to when you dropped the sign.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "sub(a, b)?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'b − a (stack pop order)', 'next' => 'wrong_b'],
                ['label' => 'a − b', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Made-up \"sub(9,5)\" → −4 instead of 4.\nStep back to when you swapped operands.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Constructed checks → 4, −7, 2, 15.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
