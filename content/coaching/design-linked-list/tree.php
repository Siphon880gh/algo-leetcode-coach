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
            'message' => "Read the problem statement above.\nHow do you avoid special-casing the head?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'A dummy node before the first element', 'next' => 's2'],
                ['label' => 'Check for index 0 in every method', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. That spreads edge cases everywhere; a sentinel removes them.\nStep back to when you special-cased the head.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "addAtIndex(size, v). Valid?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: the index is out of range', 'next' => 'wrong_b'],
                ['label' => 'Yes: it appends at the tail', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Inserting at size is allowed and means append.\nStep back to when you rejected it.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "To insert or delete at index i, where do you stop?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'At the predecessor, i steps from the dummy', 'next' => 'success'],
                ['label' => 'At node i itself', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Singly linked nodes cannot reach back to fix the previous pointer.\nStep back to when you stopped at node i.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(i) per operation. addAtHead 1, addAtTail 3, addAtIndex(1, 2), get(1) → 2, deleteAtIndex 1, get(1) → 3.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
