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
            'message' => "Read the problem statement above.\nAn OR ends in 0 when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Every chosen number is even', 'next' => 's2'],
                ['label' => 'Some chosen number is even', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Any odd number sets bit 0: 1 | 2 = 3.\nStep back to when one even was enough.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Return true when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'At least one even', 'next' => 'wrong_b'],
                ['label' => 'At least two evens', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. You must pick two or more; [1, 2, 3] → true instead of false.\nStep back to when you needed one.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → true, true, false.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
