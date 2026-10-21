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
            'message' => "Problem: One table logs friend requests (sender, receiver, date) and another logs accepted requests (requester, accepter, date); both may contain duplicates. Return the overall acceptance rate: distinct accepted pairs divided by distinct requested pairs, rounded as the statement specifies, or 0 when there are no requests. (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nCount rows or distinct pairs?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Distinct pairs, in both tables', 'next' => 's2'],
                ['label' => 'Rows', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Repeated requests or acceptances between the same two people must count once.\nStep back to when you counted rows.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Join requests to acceptances?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Yes: count the matching rows', 'next' => 'wrong_b'],
                ['label' => 'No: two independent counts, then divide', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The rate is defined as two separate counts, even if an acceptance has no matching request row.\nStep back to when you joined the tables.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "There are no requests at all. Then?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'IFNULL(rate, 0), then rounded', 'next' => 'success'],
                ['label' => 'Return NULL', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Dividing by zero gives NULL in MySQL, but the expected answer is 0.\nStep back to when you returned NULL.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. COUNT(DISTINCT pair) over COUNT(DISTINCT pair), IFNULL to 0, ROUND 2: O(n).\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
