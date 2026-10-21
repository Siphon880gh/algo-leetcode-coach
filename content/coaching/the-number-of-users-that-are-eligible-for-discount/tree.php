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
            'message' => "Problem: A table Purchases records user_id, time_stamp and amount. Given a start date, an end date and a minimum amount, count the distinct users who made at least one purchase within the date range the statement defines with an amount of at least the minimum. For instance, with a range covering only mid-March and a minimum of 1000, users with one 4523 purchase in range, one 678 purchase in range, and one big purchase in April → 1. (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nCount what?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'COUNT(DISTINCT user_id)', 'next' => 's2'],
                ['label' => 'COUNT(*)', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. A user with two qualifying purchases would be counted twice.\nStep back to when you counted rows.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Amount condition?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'amount > minAmount', 'next' => 'wrong_b'],
                ['label' => 'amount ≥ minAmount', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A purchase of exactly the minimum qualifies.\nStep back to when you used >.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Purchases outside the dates?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Filter them out', 'next' => 'success'],
                ['label' => 'Count them too', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The constructed example’s April purchase would make the answer 2 instead of 1.\nStep back to when you ignored the dates.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Constructed example → 1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
