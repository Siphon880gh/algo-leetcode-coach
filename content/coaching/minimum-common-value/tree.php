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
            'message' => "Read the problem statement above.\nValues differ?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Advance the pointer at the smaller one', 'next' => 's2'],
                ['label' => 'Advance both', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. The larger value may still match; Example 1 → −1 instead of 2.\nStep back to when you moved both.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Values are equal?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Keep scanning and return the last match', 'next' => 'wrong_b'],
                ['label' => 'Return at once', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The first match is the smallest; Example 2 → 3 instead of 2.\nStep back to when you kept scanning.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n + m). Examples → 2, 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
