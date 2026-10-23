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
            'message' => "Read the problem statement above.\nPlace t’s bits how?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Opposite of s[i] when available', 'next' => 's2'],
                ['label' => 'Ones first', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 → \"011\" instead of \"110\".\nStep back to when you sorted t.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Which end first?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The right', 'next' => 'wrong_b'],
                ['label' => 'The left (high bits)', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 1 → \"011\" instead of \"110\".\nStep back to when you started from the right.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → \"110\", \"1101\", \"1111\".\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
