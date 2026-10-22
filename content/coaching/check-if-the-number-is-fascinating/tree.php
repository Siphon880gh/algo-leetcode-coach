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
            'message' => "Read the problem statement above.\nConcatenate what?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'n, 2n and 3n', 'next' => 's2'],
                ['label' => 'n and 2n only', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. That leaves only six digits; example 1 → false instead of true.\nStep back to when you left out 3n.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Then check?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Every digit 1–9 appears', 'next' => 'wrong_b'],
                ['label' => 'The sorted digits equal 123456789', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Digits may repeat; 783 → true instead of false.\nStep back to when you checked presence only.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(1). Examples → true, false.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
