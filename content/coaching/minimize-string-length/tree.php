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
            'message' => "Read the problem statement above.\nWhich duplicates can be removed?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Any, near or far', 'next' => 's2'],
                ['label' => 'Only adjacent ones', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. The operation deletes the nearest copy on either side, wherever it is; example 3 → 6 instead of 4.\nStep back to when you removed only adjacent copies.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Count?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Letters that appear once', 'next' => 'wrong_b'],
                ['label' => 'Distinct letters', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A repeated letter keeps one copy; example 1 → 2 instead of 3.\nStep back to when you dropped repeated letters.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 3, 3, 4.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
