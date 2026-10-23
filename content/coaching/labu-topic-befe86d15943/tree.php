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
            'message' => "State:\nprompt says list might contain a cycle\n\nPattern?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Fast/slow', 'next' => 'mid'],
                ['label' => 'Merge two sorted lists', 'next' => 'w1'],
            ],
        ],
        'w1' => [
            'message' => "Wrong.\n\nCycle → Floyd fast/slow.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'mid' => [
            'message' => "State:\nshared node suffix of two lists\n\nPattern?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Intersect switch-heads', 'next' => 'final'],
                ['label' => 'Partition around a pivot', 'next' => 'w2'],
            ],
        ],
        'w2' => [
            'message' => "Wrong.\n\nIntersect equalizes lengths via switches.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'mid',
            'choices' => [],
        ],
        'final' => [
            'message' => "State:\nabout to flip cur.next\n\n?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Save nxt first', 'next' => 'success'],
                ['label' => 'No temps needed', 'next' => 'w3'],
            ],
        ],
        'w3' => [
            'message' => "Wrong.\n\nAlways save before rewire.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'final',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct.\n\n- Cue → pattern → pointer sketch\n- O(n) walks\n\nYou finished this path.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
