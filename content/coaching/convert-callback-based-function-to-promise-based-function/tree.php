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
            'message' => "Problem: Given a function that reports its result through a callback, return a function that takes the same other arguments and returns a promise instead: it resolves with the result, or rejects if the callback reports an error. Where the callback goes in the argument list and how it reports errors are in the official statement. (Restated from memory; limits and examples may differ slightly.)\nThe callback reports an error?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'reject with it', 'next' => 's2'],
                ['label' => 'resolve anyway', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Callers never see the failure; in Node, with the guide’s assumed convention, a negative input → resolves undefined.\nStep back to when you ignored the error.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Call the original with?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only the callback', 'next' => 'wrong_b'],
                ['label' => 'The callback plus ...args', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The inputs are lost; in Node the sum of 1 and 2 → NaN instead of 3.\nStep back to when you dropped the arguments.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(1) extra per call. The checks → 3, and a rejection for a negative input.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
