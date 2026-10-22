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
            'message' => "Read the problem statement above.\nChoices per element?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Outside, in T only, or in U', 'next' => 's2'],
                ['label' => 'In U or not', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. That is a plain subset count: example 1 → 2 instead of 6.\nStep back to when you used two choices.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Update f?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'In place, sums rising', 'next' => 'wrong_b'],
                ['label' => 'Into a new array g', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. f[j − x] is already updated, so x is reused: example 1 → 24 instead of 6.\nStep back to when you updated in place.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n k). Examples → 6, 4, 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
