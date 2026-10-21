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
            'message' => "Read the problem statement above.\nWhich numbers are single?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'GROUP BY num HAVING COUNT(*) = 1', 'next' => 's2'],
                ['label' => 'SELECT DISTINCT num', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. DISTINCT keeps one copy of numbers that repeat.\nStep back to when you used DISTINCT.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Where does the count condition go?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'WHERE COUNT(*) = 1', 'next' => 'wrong_b'],
                ['label' => 'HAVING, after grouping', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. WHERE runs before grouping and cannot see the count.\nStep back to when you used WHERE.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "How do you return the largest single?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'MAX(num) over the singles', 'next' => 'success'],
                ['label' => 'ORDER BY num DESC LIMIT 1', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. With no singles that returns no row at all, but the answer must be one row with null; MAX of nothing is null.\nStep back to when you used LIMIT.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Singles with HAVING COUNT(*) = 1, then MAX(num): O(n) with hashing.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
