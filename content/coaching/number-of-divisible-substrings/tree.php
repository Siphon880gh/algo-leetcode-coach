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
            'message' => "Problem: Each lowercase letter has a fixed small value, given by a mapping in the official statement. A substring is divisible when the sum of its letters’ values is divisible by its length. Count the divisible substrings. Limits are in the official statement. For instance, letters with values [1, 2, 3] give 4 divisible substrings: the three single letters and the whole string. (Restated from memory; limits and examples may differ slightly.)\nFor average d, a substring counts when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The sum of (value − d) is 0', 'next' => 's2'],
                ['label' => 'The sum is divisible by d', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Divisible by d is not the same as average d; the [1, 2, 3] example → 13 instead of 4.\nStep back to when you tested divisibility by d.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Prefix map starts with?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Empty', 'next' => 'wrong_b'],
                ['label' => 's = 0 counted once', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Substrings starting at index 0 are missed; the example → 2 instead of 4.\nStep back to when you started empty.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(9n). The example → 4.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
