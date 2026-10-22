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
            'message' => "Problem: A table lists chemical elements, each with a symbol and a type, where the types include metals and nonmetals. Return every pair of one metal and one nonmetal. For instance, metals Na and Ca with nonmetals Cl and N give four pairs. (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nJoin condition?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'One side metals, the other nonmetals', 'next' => 's2'],
                ['label' => 'Any two different elements', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Metal pairs, nonmetal pairs and other types slip in; Na, Ca, Cl, N, He → 20 rows instead of 4.\nStep back to when you paired any two elements.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Each pair appears?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'In both orders', 'next' => 'wrong_b'],
                ['label' => 'Once, metal first', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The same bond is listed twice; the same table → 8 rows instead of 4.\nStep back to when you allowed both orders.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(metals · nonmetals). Constructed check (run in SQLite) → (Na, Cl), (Na, N), (Ca, Cl), (Ca, N).\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
