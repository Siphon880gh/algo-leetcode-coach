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
            'message' => "Read the problem statement above.\nTest within a row?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Every j: row[j] = row[(j + k) mod n]', 'next' => 's2'],
                ['label' => 'Only row[0] = row[k mod n]', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. [[1, 2, 1, 3]] with k = 2 → true instead of false.\nStep back to when you checked one position.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Which rows?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only even rows', 'next' => 'wrong_b'],
                ['label' => 'All of them', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. [[1, 1], [1, 2]] with k = 1 → true instead of false.\nStep back to when you checked only even rows.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(mn). Examples → false, true, true.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
