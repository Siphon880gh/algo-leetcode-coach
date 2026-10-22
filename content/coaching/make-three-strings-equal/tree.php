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
            'message' => "Read the problem statement above.\nDeleting from the right leaves?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Prefixes', 'next' => 's2'],
                ['label' => 'Suffixes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Matching endings gives example 1 → −1 instead of 2.\nStep back to when you compared suffixes.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Common prefix empty?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Return the total length', 'next' => 'wrong_b'],
                ['label' => 'Return −1', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Strings cannot be emptied; example 2 → 9 instead of −1.\nStep back to when you returned the total.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 2, −1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
