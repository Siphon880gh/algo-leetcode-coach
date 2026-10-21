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
            'message' => "Read the problem statement above.\nDenominator?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Total rows in Users', 'next' => 's2'],
                ['label' => 'Registrations in the contest', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. That would always give 100.\nStep back to when you used registrations.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Rounding?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Truncate', 'next' => 'wrong_b'],
                ['label' => 'ROUND(…, 2)', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The output shows 66.67, a rounded value.\nStep back to when you truncated.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Ordering?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'percentage DESC, contest_id ASC', 'next' => 'success'],
                ['label' => 'contest_id only', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Ties on percentage are broken by contest_id.\nStep back to when you ordered by id only.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Example → 208, 209, 210 at 100.0, then 215 at 66.67, 207 at 33.33.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
