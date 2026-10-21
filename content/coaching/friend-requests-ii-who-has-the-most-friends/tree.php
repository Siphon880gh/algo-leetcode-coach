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
            'message' => "Read the problem statement above.\nWhich column holds the friends?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Both: each friendship counts for the requester and the accepter', 'next' => 's2'],
                ['label' => 'requester_id only', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Someone who never sent a request can still have the most friends.\nStep back to when you used one column.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "How do you stack the two columns?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'UNION', 'next' => 'wrong_b'],
                ['label' => 'UNION ALL', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. UNION removes duplicate ids, so every count would be 1.\nStep back to when you used UNION.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "How do you take the winner?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'GROUP BY id ORDER BY COUNT(*) DESC LIMIT 1', 'next' => 'success'],
                ['label' => 'ORDER BY id DESC LIMIT 1', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The largest id is not the person with the most friends.\nStep back to when you sorted by id.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. UNION ALL both columns, count per id, take the top: O(n log n). → id 3 with 3 friends.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
