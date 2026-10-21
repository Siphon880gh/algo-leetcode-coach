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
            'message' => "Read the problem statement above.\nWhere does the count condition go?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'HAVING COUNT(*) >= 5, after GROUP BY class', 'next' => 's2'],
                ['label' => 'WHERE COUNT(*) >= 5', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. WHERE runs before grouping and cannot see aggregates.\nStep back to when you used WHERE.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Which column do you group by?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'student', 'next' => 'wrong_b'],
                ['label' => 'class', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Grouping by student counts the classes each student takes.\nStep back to when you grouped by student.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Which comparison?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '>= 5', 'next' => 'success'],
                ['label' => '> 5', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. A class with exactly five students counts.\nStep back to when you used > 5.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. GROUP BY class HAVING COUNT(*) >= 5: O(n) with hashing.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
