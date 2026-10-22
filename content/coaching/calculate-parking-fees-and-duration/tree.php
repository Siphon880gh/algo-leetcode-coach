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
            'message' => "Problem: A table logs parking sessions: a car, a lot, entry and exit times and the fee paid. For each car, report the total fee, the fee per hour over all of its parking time (rounded as the statement asks), and the lot where it spent the most time. Table, column and output names, and the ordering, are in the official statement. (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nFee per hour?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Total fee over total hours', 'next' => 's2'],
                ['label' => 'Average of per-session rates', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. In the guide’s check car 1 → 2.37 instead of 2.18.\nStep back to when you averaged rates.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Lot with the most time?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Longest single session', 'next' => 'wrong_b'],
                ['label' => 'Sum hours per car and lot, then rank', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. 3 hours once at lot A against 2 hours twice at lot B → A instead of B.\nStep back to when you used one session.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). The guide’s check → car 1: 12, 2.18, lot 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
