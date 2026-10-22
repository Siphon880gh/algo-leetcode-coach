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
            'message' => "Read the problem statement above.\nFirst step?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Sort the digits ascending', 'next' => 's2'],
                ['label' => 'Keep their order', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Small digits must take the high places; Example 1 → 77 instead of 59.\nStep back to when you skipped sorting.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "How to split the sorted digits?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'First half and second half', 'next' => 'wrong_b'],
                ['label' => 'Alternate between the two numbers', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Halves give the second number large high digits; Example 1 → 68 instead of 59.\nStep back to when you cut in halves.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(d log d). Examples → 59, 75.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
