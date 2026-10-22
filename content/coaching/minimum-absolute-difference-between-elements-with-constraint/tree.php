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
            'message' => "Read the problem statement above.\nThe sorted set holds?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'nums[0 … j − x]', 'next' => 's2'],
                ['label' => 'All of nums', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. An element matches itself; example 3 → 0 instead of 3.\nStep back to when you inserted everything.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Check which values?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only the one just above', 'next' => 'wrong_b'],
                ['label' => 'The ones just above and just below', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The closest may be below; example 3 finds no pair instead of 3.\nStep back to when you looked only up.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). Examples → 0, 1, 3.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
