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
            'message' => "Read the problem statement above.\nA trainer cannot take the weakest unmatched player?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Skip the trainer', 'next' => 's2'],
                ['label' => 'Discard players until one fits', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Those players may suit a stronger trainer; Example 1 → 0 instead of 2.\nStep back to when you discarded players.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "A match needs?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'player < trainer', 'next' => 'wrong_b'],
                ['label' => 'player ≤ trainer', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Equal values match; players = [5], trainers = [5] → 0 instead of 1.\nStep back to when you required <.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "How many players per trainer?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'At most one', 'next' => 'success'],
                ['label' => 'Every player it can train', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Example 2 → 3 instead of 1.\nStep back to when one trainer took several.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n + m log m). Examples → 2, 1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
