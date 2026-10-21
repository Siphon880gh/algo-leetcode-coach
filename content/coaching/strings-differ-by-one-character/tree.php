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
            'message' => "Problem: Given distinct equal-length strings, decide whether two differ in exactly one position. For instance, [\"abcd\",\"acbd\",\"aacd\"] → true. (Restated from memory; limits and examples may differ slightly.)\nCompare all pairs?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: O(n² m)', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Masked hashing is O(nm).\nStep back to when you compared pairs.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Hash collision?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Trust the hash', 'next' => 'wrong_b'],
                ['label' => 'Verify the pair directly', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Collisions give false positives.\nStep back to when you trusted it.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Masked hash update?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Subtract c[j] · base^(m−1−j)', 'next' => 'success'],
                ['label' => 'Recompute from scratch', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. That makes it O(n m²).\nStep back to when you recomputed.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n · m). [\"abcd\",\"acbd\",\"aacd\"] → true.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
