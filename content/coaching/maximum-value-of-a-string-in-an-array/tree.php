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
            'message' => "Read the problem statement above.\nValue of 0001?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '1', 'next' => 's2'],
                ['label' => '4, its length', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. A digits-only string is worth its number; Example 2 → 4 instead of 1.\nStep back to when you used the length.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Treat a string as a number when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'It contains a digit', 'next' => 'wrong_b'],
                ['label' => 'Every character is a digit', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. alic3 is worth its length, 5; reading its digits gives 3, and Example 1 → 4 instead of 5.\nStep back to when you read digits out of a mixed string.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(total length). Examples → 5, 1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
