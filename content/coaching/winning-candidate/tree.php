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
            'message' => "Problem: A candidate table lists candidates, and a vote table has one row per vote naming a candidate. Return the name of the candidate with the most votes; the winner is unique. (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nJoin first, then group by name?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: count votes per candidateId first', 'next' => 's2'],
                ['label' => 'Yes: join and group by name', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Two candidates can share a name, and grouping by name would merge their votes.\nStep back to when you grouped by name.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "How do you take the winner?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'MAX(COUNT(*)) in the same SELECT', 'next' => 'wrong_b'],
                ['label' => 'ORDER BY COUNT(*) DESC LIMIT 1', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Aggregates cannot be nested in one SELECT.\nStep back to when you nested MAX.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "You have the winning candidateId. What do you return?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Join it to Candidate.id and return name', 'next' => 'success'],
                ['label' => 'Return the candidateId', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The output column is the candidate's name.\nStep back to when you returned the id.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Count by candidateId, take the top, join for the name: O(n log n).\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
