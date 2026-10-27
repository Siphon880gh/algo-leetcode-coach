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
            'message' => "State:\nthe two lists meet at node c1\np and q are walking\none pointer has just reached null\n\nWhat should that pointer do next?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Jump to the head of the other list', 'next' => 'mid'],
                ['label' => 'Stop, because there can be no intersection', 'next' => 'w1'],
            ],
        ],
        'w1' => [
            'message' => "Wrong.\n\nSwitching to the other head evens out the distance left, so both pointers reach the shared part together.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'mid' => [
            'message' => "State:\nchecking whether p and q have met\n\nWhat does \"the lists intersect here\" mean?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Both pointers are on the same node, not just nodes with equal values', 'next' => 'final'],
                ['label' => 'The two nodes hold equal values, wherever they are', 'next' => 'w2'],
            ],
        ],
        'w2' => [
            'message' => "Wrong.\n\nThe shared tail is made of the same node objects. Equal values in different nodes do not count.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'mid',
            'choices' => [],
        ],
        'final' => [
            'message' => "State:\nlist A has m nodes\nlist B has n nodes\n\nWhat is the running time?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'O(m + n)', 'next' => 'success'],
                ['label' => 'O(mn), because you need nested scans', 'next' => 'w3'],
            ],
        ],
        'w3' => [
            'message' => "Wrong.\n\nEach pointer walks each list at most once, so the total is linear.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'final',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct.\n\n- When a pointer reaches null, switch it to the other head.\n- The pointers meet at the intersection, or both reach null.\n\nYou finished this path.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
