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
            'message' => "Read the problem statement above.\n* on an empty string?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Length stays 0', 'next' => 's2'],
                ['label' => 'Length becomes −1', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. \"*a\", k = 0 → \".\" instead of \"a\".\nStep back to when you let it go negative.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "k is?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '1-indexed', 'next' => 'wrong_b'],
                ['label' => '0-indexed', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 1 → b instead of a.\nStep back to when you shifted k.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → a, d, \".\".\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
