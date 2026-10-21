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
            'message' => "Read the problem statement above.\nWhat counts as a direct report?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Each employee row whose managerId is that manager', 'next' => 's2'],
                ['label' => 'Everyone below the manager in the chain', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Only direct reports count: the rows that name the manager in managerId.\nStep back to when you counted the whole chain.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "How do you count them?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'WHERE COUNT(*) >= 5', 'next' => 'wrong_b'],
                ['label' => 'GROUP BY managerId HAVING COUNT(*) >= 5', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. WHERE runs before grouping and cannot see aggregates; HAVING filters the groups.\nStep back to when you used WHERE.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "You have the manager ids. How do you get names?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Join back to Employee on id = managerId', 'next' => 'success'],
                ['label' => 'GROUP BY name instead of managerId', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Two people can share a name, so grouping by name can merge different managers.\nStep back to when you grouped by name.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Group by managerId, HAVING ≥ 5, join back for the names: O(n) with hashing.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
