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
            'message' => "Read the problem statement above.\nLetters in the last round?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Those with the highest count', 'next' => 's2'],
                ['label' => 'Every distinct letter', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 → bca instead of ba.\nStep back to when you kept every letter.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Order them by?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'First occurrence', 'next' => 'wrong_b'],
                ['label' => 'Last occurrence', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 1 → ab instead of ba.\nStep back to when you used the first occurrence.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → ba, abcd.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
