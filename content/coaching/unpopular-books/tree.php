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
            'message' => "Problem: A books table records when each book became available, and an orders table records quantities with dispatch dates. Relative to a fixed reference date, report the books that sold fewer than a small threshold of copies over the past year, excluding books that became available too recently (within about a month). Books with no orders in that period count as 0. The statement gives the exact dates and threshold. (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nPut the order-date filter in WHERE?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: put it in the ON clause of a left join', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Books with no recent orders would disappear.\nStep back to when you filtered in WHERE.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "A book has no recent orders. Its total?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'NULL, so it is skipped', 'next' => 'wrong_b'],
                ['label' => '0, via COALESCE', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Zero copies is below the threshold.\nStep back to when you skipped it.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Where does the availability filter go?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'WHERE, on the books table', 'next' => 'success'],
                ['label' => 'HAVING on the sum', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. It is a property of the book, not of the orders.\nStep back to when you put it in HAVING.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n) with hashing. Books that are old enough and sold too few copies are returned.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
