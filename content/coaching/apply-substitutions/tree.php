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
            'message' => "Problem: Each key is one uppercase letter mapped to a short value, and a text holds placeholders written %X%. A value may itself contain placeholders, and there are no cycles. Return the text with every placeholder replaced until none remain. Limits are in the official statement. (Restated from memory; limits and examples may differ slightly.)\nPlaceholder inside a value?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Expand it too', 'next' => 's2'],
                ['label' => 'Copy the value as is', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. P = xy, Q = %P%z, text %Q%_%P% → %P%z_xy instead of xyz_xy.\nStep back to when you copied the value.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "One pass in list order?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Yes', 'next' => 'wrong_b'],
                ['label' => 'No, recurse', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Keys C, B, A on the second check → 1%B%_3_2%C%.\nStep back to when you made one pass.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(output size). Checks → xyz_xy, 123_3_23.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
