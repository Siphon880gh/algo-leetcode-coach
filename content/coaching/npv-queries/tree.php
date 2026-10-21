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
            'message' => "Problem: An NPV table holds a value per (id, year), and a queries table lists (id, year) pairs. Report the NPV for each query, using 0 when the pair is missing. For instance, a query for a pair absent from the NPV table returns 0. (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nJoin type?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'LEFT JOIN from queries', 'next' => 's2'],
                ['label' => 'INNER JOIN', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Missing pairs must still appear.\nStep back to when you used INNER JOIN.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Join key?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'id only', 'next' => 'wrong_b'],
                ['label' => 'id and year', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. An id has several years.\nStep back to when you joined on id alone.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Missing value?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'COALESCE to 0', 'next' => 'success'],
                ['label' => 'Leave NULL', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The statement asks for 0.\nStep back to when you left NULL.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Every query row, with its NPV or 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
