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
            'message' => "Read the problem statement above.\nChanges may chain?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Yes: all-pairs shortest paths', 'next' => 's2'],
                ['label' => 'No: direct rules only', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 → 30 instead of 28, and example 2 → −1 instead of 12.\nStep back to when you used direct rules only.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Same pair listed twice?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Keep the last cost', 'next' => 'wrong_b'],
                ['label' => 'Keep the cheaper cost', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Rules a → b at 1 then 5: changing a to b → 5 instead of 1.\nStep back to when you kept the last.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(26³ + n + m). Examples → 28, 12, −1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
