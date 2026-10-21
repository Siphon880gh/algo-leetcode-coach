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
            'message' => "Problem: Given customers, orders (with sale date and seller) and sellers tables, report the names of sellers who made no sales in 2020, ordered as the statement specifies (typically by name). For instance, a seller whose only order is in 2019 is reported. (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nWhere does the 2020 test go?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'In the ON clause', 'next' => 's2'],
                ['label' => 'In WHERE', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. WHERE on the right table turns the left join into an inner join.\nStep back to when you used WHERE.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Which rows to keep?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Joined order is not NULL', 'next' => 'wrong_b'],
                ['label' => 'Joined order is NULL', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Those are sellers who did sell.\nStep back to when you kept them.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "NOT IN subquery?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Fine if it has no NULL ids', 'next' => 'success'],
                ['label' => 'Always identical', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. A NULL in NOT IN makes every test unknown.\nStep back to when you assumed it.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Constructed check: A (2019 only) and C (no orders) are reported; B (2020) is not.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
