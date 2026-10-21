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
            'message' => "Read the problem statement above.\nRun two updates: m → f, then f → m?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: one UPDATE with CASE', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The second update would turn every row back to m.\nStep back to when you used two updates.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Which CASE?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'CASE WHEN sex = \'m\' THEN \'f\' END', 'next' => 'wrong_b'],
                ['label' => 'CASE sex WHEN \'m\' THEN \'f\' ELSE \'m\' END', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Without ELSE, every f row becomes NULL.\nStep back to when you left out ELSE.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Add a SELECT to show the result?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: the answer is the UPDATE alone', 'next' => 'success'],
                ['label' => 'Yes', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The problem asks for a single update statement and no select.\nStep back to when you added a SELECT.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. UPDATE Salary SET sex = CASE sex WHEN 'm' THEN 'f' ELSE 'm' END: O(n).\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
