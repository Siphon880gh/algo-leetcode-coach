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
            'message' => "Read the problem statement above.\nWhich letters must be vowels?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'First and last', 'next' => 's2'],
                ['label' => 'First only', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. amy ends in a consonant; Example 1 → 3 instead of 2.\nStep back to when you checked only the first.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Indices to scan?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'left … right − 1', 'next' => 'wrong_b'],
                ['label' => 'left … right, inclusive', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. right is part of the range; Example 1 → 1 instead of 2.\nStep back to when you stopped early.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(right − left + 1). Examples → 2, 3.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
