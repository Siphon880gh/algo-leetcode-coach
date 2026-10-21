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
            'message' => "Read the problem statement above.\nIn what order do the CASE branches go?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Root first (p_id IS NULL), then Inner, then Leaf', 'next' => 's2'],
                ['label' => 'Inner first, then Root', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. A root with children is also a parent, so it would be labeled Inner.\nStep back to when you tested Inner first.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "How do you test Inner?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'p_id IS NOT NULL', 'next' => 'wrong_b'],
                ['label' => 'id IN (SELECT p_id FROM Tree)', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Every non-root has a parent, including the leaves; Inner means having children.\nStep back to when you tested p_id.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Test Leaf with id NOT IN (SELECT p_id FROM Tree)?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: let ELSE give Leaf', 'next' => 'success'],
                ['label' => 'Yes', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The root's p_id is NULL, so the subquery contains NULL and NOT IN is never true.\nStep back to when you used NOT IN.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Root, then IN for Inner, then ELSE Leaf: O(n) with hashing.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
