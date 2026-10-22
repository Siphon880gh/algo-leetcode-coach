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
            'message' => "Problem: A transactions table records, for each transaction, a customer, a date and an amount. Find the stretches of consecutive days on which a customer’s amount rose every day, and report each long enough stretch with its customer and first and last dates. The minimum stretch length, whether a tie breaks a stretch, the columns and the output order are in the official statement. For instance, a customer paying 100, 150 and 200 on three consecutive days, then 120 on the fourth, has one rising stretch covering the first three days. (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nA stretch breaks when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The day is not the next one, or the amount does not rise', 'next' => 's2'],
                ['label' => 'Only when a day is missing', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Amounts must rise too; in SQLite 50, 50, 70 → a stretch May 1–3 instead of none.\nStep back to when you checked only days.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Group the rows by?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Customer only', 'next' => 'wrong_b'],
                ['label' => 'Customer and the running count of breaks', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A customer can have several stretches and drops; in SQLite customer 101 → May 1–4 instead of May 1–3.\nStep back to when you grouped by customer.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). Constructed check (run in SQLite) → May 1–3 for the first customer, May 3–5 for the third.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
