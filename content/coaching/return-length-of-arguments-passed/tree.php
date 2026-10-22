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
            'message' => "Read the problem statement above.\nCollect the arguments with?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'A rest parameter', 'next' => 's2'],
                ['label' => 'arguments inside an arrow function', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Arrows have no arguments of their own; in a Node CommonJS file one argument → 5 instead of 1.\nStep back to when you used arguments.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Count what?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only truthy ones', 'next' => 'wrong_b'],
                ['label' => 'Every argument', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. null still counts; example 2 → 2 instead of 3.\nStep back to when you filtered.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples (run in Node) → 1, 3.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
