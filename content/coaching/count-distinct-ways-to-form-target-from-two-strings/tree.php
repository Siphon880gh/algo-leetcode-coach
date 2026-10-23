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
            'message' => "Read the problem statement above.\nOne-string ways?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Remove them', 'next' => 's2'],
                ['label' => 'Keep them', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 → 6 instead of 5.\nStep back to when you kept them.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Remove which?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only word1-only', 'next' => 'wrong_b'],
                ['label' => 'Both word1-only and word2-only', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Constructed check (run in code): word1 = \"ab\", word2 = \"ab\", target = \"ab\" → 3 instead of 2.\nStep back to when you removed only one side.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(T · A · B). Examples → 5, 4, 2, 1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
