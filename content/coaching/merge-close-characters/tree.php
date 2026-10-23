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
            'message' => "Read the problem statement above.\nDistance in?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The current string', 'next' => 's2'],
                ['label' => 'The original string', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 3 → \"ybyzbz\" instead of \"ybzybz\".\nStep back to when you kept original indices.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Which character goes?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The left one', 'next' => 'wrong_b'],
                ['label' => 'The right one', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 1 → \"bca\" instead of \"abc\".\nStep back to when you deleted the left one.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n² · k). Examples → \"abc\", \"abca\", \"ybzybz\".\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
