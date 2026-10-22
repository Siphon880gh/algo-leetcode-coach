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
            'message' => "Problem: A steps table records a user’s step count on a date. For each user and date, report the average over that date and the two dates just before it, but only when all three consecutive dates have rows. Rounding, the columns, output names and ordering are in the official statement. (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nKeep which rows?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Those with LAG(date, 2) = date − 2 days', 'next' => 's2'],
                ['label' => 'Every row', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Partial windows appear; in SQLite the check reports Jan 1 at 100 and user 2’s rows.\nStep back to when you kept everything.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Is LAG(date, 2) IS NOT NULL enough?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Yes', 'next' => 'wrong_b'],
                ['label' => 'No, compare the dates', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Gaps slip through; in SQLite the check also reports Jan 5 at 300 and Jan 6 at 400.\nStep back to when you only tested for NULL.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). The check → user 1 Jan 3 at 200 and Jan 7 at 500.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
