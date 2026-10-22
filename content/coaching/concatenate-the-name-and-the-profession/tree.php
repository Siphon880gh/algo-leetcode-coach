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
            'message' => "Problem: A table lists people, each with an id, a name and a profession. For every person, return the id together with a label made of the name followed by the first letter of the profession in parentheses; the column names and row order are in the official statement. For instance, Alex the Singer → Alex(S). (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nBetween the name and the parenthesis?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Nothing', 'next' => 's2'],
                ['label' => 'A space', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. The label is Alex(S), not Alex (S).\nStep back to when you added a space.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Inside the parentheses?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'SUBSTRING(profession, 1)', 'next' => 'wrong_b'],
                ['label' => 'LEFT(profession, 1)', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. With no length that returns the whole word; Alex → Alex(Singer) instead of Alex(S).\nStep back to when you dropped the length.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n) for the ordering. Constructed check (run in SQLite) → Alex(S), Bob(P), Alice(A).\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
