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
            'message' => "Problem: A TV program table records what content aired when, and a content table gives each title, whether it is kid-friendly, and its type. Report the distinct titles of kid-friendly movies aired in the month the statement specifies. (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nSame movie aired twice?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'DISTINCT title', 'next' => 's2'],
                ['label' => 'List both rows', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Each title appears once.\nStep back to when you listed duplicates.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Month filter?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Equality with one date', 'next' => 'wrong_b'],
                ['label' => 'Half-open date range', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A month spans many dates (and possibly times).\nStep back to when you used equality.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Type filter?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Movies only', 'next' => 'success'],
                ['label' => 'All kid content', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Series are excluded.\nStep back to when you dropped the type check.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Distinct kid-friendly movie titles for that month.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
