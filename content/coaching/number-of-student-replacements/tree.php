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
            'message' => "Problem: Students arrive in order with given ranks, where a smaller rank is better. The first student starts as the selection, and each later student who is strictly better than the current selection replaces it. Return how many replacements happen. Limits are in the official statement. (Restated from memory; limits and examples may differ slightly.)\nReplace on a tie?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No, only on a strictly better rank', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. [5, 3, 3, 1] → 3 instead of 2.\nStep back to when you replaced on the tie.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Better means?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'A larger rank', 'next' => 'wrong_b'],
                ['label' => 'A smaller rank', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. [5, 3, 3, 1] → 0 instead of 2.\nStep back to when you compared the wrong way.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Checks → 2, 0, 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
