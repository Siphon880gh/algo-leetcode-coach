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
            'message' => "Problem: A table Teams lists team_name, one row per team. Every team plays every other team twice, once at home and once away. Report every match as its home team and away team, with the output names the statement gives, in any order. For instance, three teams produce six matches. (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nHow to pair teams?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Self-join on different names', 'next' => 's2'],
                ['label' => 'Cross join with no condition', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Teams play themselves; teams A, B and C → 9 rows instead of 6.\nStep back to when you dropped the condition.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Which inequality?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 't1 < t2', 'next' => 'wrong_b'],
                ['label' => 't1 <> t2', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Only one leg of each pairing survives; A, B and C → 3 rows instead of 6.\nStep back to when you used <.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "How many matches for n teams?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'n(n − 1)', 'next' => 'success'],
                ['label' => 'n(n − 1) / 2', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Each pairing is played twice, home and away; 3 teams → 3 instead of 6.\nStep back to when you halved the count.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n²). Constructed check with A, B, C → 6 rows.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
