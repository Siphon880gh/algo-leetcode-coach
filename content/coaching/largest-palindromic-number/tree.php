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
            'message' => "Read the problem statement above.\nHalf starts with 0?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Strip the zeros', 'next' => 's2'],
                ['label' => 'Keep them', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 2 → 00900 instead of 9.\nStep back to when you kept leading zeros.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Middle digit candidates?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only digits that appear once', 'next' => 'wrong_b'],
                ['label' => 'Any digit with an odd count', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. num = 333 → 33 instead of 333.\nStep back to when you required a single copy.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Half and middle are both empty?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Return 0', 'next' => 'success'],
                ['label' => 'Return the empty string', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. num = 00 → (empty) instead of 0.\nStep back to when you returned nothing.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 7449447, 9.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
