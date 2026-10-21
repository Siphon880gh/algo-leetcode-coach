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
            'message' => "Read the problem statement above.\nCompare what?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'sum ≥ k · threshold', 'next' => 's2'],
                ['label' => 'sum / k ≥ threshold with floats', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Integer comparison avoids rounding.\nStep back to when you divided.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Update the window?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Recompute the sum', 'next' => 'wrong_b'],
                ['label' => 'Add arr[i], subtract arr[i − k]', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. That is O(k) per window.\nStep back to when you recomputed.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Equal to the bound?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Counts', 'next' => 'success'],
                ['label' => 'Does not count', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The condition is ≥.\nStep back to when you used >.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). First example → 3. Second → 6.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
