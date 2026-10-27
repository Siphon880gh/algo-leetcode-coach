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
            'message' => "State:\nthe problem says the list might contain a cycle\n\nWhich pattern fits?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Fast and slow pointers', 'next' => 'mid'],
                ['label' => 'Merging two sorted lists', 'next' => 'w1'],
            ],
        ],
        'w1' => [
            'message' => "Wrong.\n\nA possible cycle calls for Floyd's fast and slow pointers.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'mid' => [
            'message' => "State:\ntwo lists share the same tail of nodes\n\nWhich pattern fits?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Intersection, by switching heads', 'next' => 'final'],
                ['label' => 'Partition around a pivot', 'next' => 'w2'],
            ],
        ],
        'w2' => [
            'message' => "Wrong.\n\nSwitching to the other head evens out the lengths so the pointers meet at the shared node.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'mid',
            'choices' => [],
        ],
        'final' => [
            'message' => "State:\nyou are about to change cur.next\n\nWhat do you do first?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Save nxt = cur.next', 'next' => 'success'],
                ['label' => 'Nothing. No temporary variable is needed.', 'next' => 'w3'],
            ],
        ],
        'w3' => [
            'message' => "Wrong.\n\nAlways save the next node before rewiring.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'final',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct.\n\n- Spot the clue, pick the pattern, then draw the pointers.\n- These walks are O(n).\n\nYou finished this path.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
