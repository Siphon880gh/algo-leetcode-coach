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
            'message' => "Problem: Given a sorted list of disjoint intervals and one interval to remove, return the sorted list of what remains (intervals are typically half-open [a, b); check the statement). For instance, removing [1,6] from [[0,2],[3,4],[5,7]] gives [[0,1],[6,7]]. (Restated from memory; limits and examples may differ slightly.)\nAn interval partly overlaps?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Keep its outside pieces', 'next' => 's2'],
                ['label' => 'Drop it', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Only the overlap is removed.\nStep back to when you dropped it.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Left piece exists when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'x ≤ a', 'next' => 'wrong_b'],
                ['label' => 'x < a', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. With x = a the left piece is empty.\nStep back to when you allowed equality.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Need to re-sort the output?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: the order is preserved', 'next' => 'success'],
                ['label' => 'Yes', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Pieces come out in input order, which is sorted.\nStep back to when you re-sorted.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Removing [1,6] from [[0,2],[3,4],[5,7]] → [[0,1],[6,7]]. Removing [2,3] from [[0,5]] → [[0,2],[3,5]].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
