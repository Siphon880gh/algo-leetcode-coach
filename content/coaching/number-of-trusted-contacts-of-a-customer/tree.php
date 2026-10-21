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
            'message' => "Problem: Customers have names and emails, each customer has contacts with names and emails, and invoices record a price and a customer. For each invoice, report the customer's name, the price, the number of contacts, and how many contacts are themselves customers (by email). (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nJoin contacts how?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'LEFT JOIN', 'next' => 's2'],
                ['label' => 'INNER JOIN', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Customers without contacts would lose their invoices.\nStep back to when you used an inner join.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Trusted means?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Contact name matches', 'next' => 'wrong_b'],
                ['label' => 'Contact email matches a customer', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The match is by email.\nStep back to when you matched names.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Count with?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'COUNT(column)', 'next' => 'success'],
                ['label' => 'COUNT(*)', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. An unmatched row would count as 1.\nStep back to when you counted rows.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. For instance, three contacts, two of them customers → 3 and 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
