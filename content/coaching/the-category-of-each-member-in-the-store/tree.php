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
            'message' => "Problem: A members table, a visits table (each visit by a member) and a purchases table (visits that ended in a purchase) describe a store. Each member's conversion rate is 100 · purchases / visits. Report each member with a category: members with no visits get the lowest category, and the others are placed into bands of the conversion rate as the statement specifies. For instance, with sample bands of ≥ 80 (Diamond), ≥ 50 (Gold), otherwise Silver, and Bronze for no visits: 2 visits with 2 purchases → Diamond, 4 with 1 → Silver, 2 with 1 → Gold, no visits → Bronze. (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nMembers with no visits?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Keep them with LEFT JOIN', 'next' => 's2'],
                ['label' => 'INNER JOIN visits', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. An INNER JOIN drops members who never visited, but they still need a category.\nStep back to when you chose the join.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Visit count?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'COUNT(*)', 'next' => 'wrong_b'],
                ['label' => 'COUNT of the visit id column', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. After a LEFT JOIN a member with no visits still has one row of NULLs, so COUNT(*) gives 1.\nStep back to when you used COUNT(*).",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Join purchases how?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'LEFT JOIN on the visit id', 'next' => 'success'],
                ['label' => 'INNER JOIN on the visit id', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. An INNER JOIN keeps only visits that ended in a purchase, so every buyer would show a 100% rate.\nStep back to when you chose the join.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. One grouped query; the CASE checks no visits first, then the rate bands from the statement.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
