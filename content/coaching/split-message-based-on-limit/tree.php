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
            'message' => "Read the problem statement above.\nRoom in part a of b?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'limit − 3 − digits(a) − digits(b)', 'next' => 's2'],
                ['label' => 'limit − 5', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Two-digit numbers make longer suffixes; Example 1 → 10 parts, but <1/10> leaves only 3 letters in 9 characters, not 4.\nStep back to when you assumed one digit.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "3 + 2 · digits(b) ≥ limit?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Keep trying larger b', 'next' => 'wrong_b'],
                ['label' => 'Return []', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A larger b only lengthens the suffix; with limit = 5 even one part has no room, so the loop never succeeds.\nStep back to when you kept going.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 14 parts, [short mess<1/2>, age<2/2>].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
