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
            'message' => "Read the problem statement above.\nApproach?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Count by digits', 'next' => 's2'],
                ['label' => 'Test every number up to n', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. n reaches 2 · 10^9.\nStep back to when you tested every number.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Count of length L < len(n)?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'P(10, L)', 'next' => 'wrong_b'],
                ['label' => '9 · P(9, L − 1)', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. That allows a leading 0; Example 1 → 20 instead of 19.\nStep back to when you used P(10, L).",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "A digit of n repeats an earlier one?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Stop; n and larger prefixes are not special', 'next' => 'success'],
                ['label' => 'Keep walking', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. n = 1100 → 795 instead of 794.\nStep back to when you kept walking.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(len²). Examples → 19, 5, 110.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
