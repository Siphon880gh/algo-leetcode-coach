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
            'message' => "State:\nhot op = random index reads\n\nPrefer?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Array / dynamic array', 'next' => 'mid'],
                ['label' => 'Singly linked list', 'next' => 'w1'],
            ],
        ],
        'w1' => [
            'message' => "Wrong.\n\nLists make index O(n).\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'mid' => [
            'message' => "State:\nhot op = repeated push_front\n\nPrefer?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Linked list or deque', 'next' => 'final'],
                ['label' => 'Dynamic array without spare head room', 'next' => 'w2'],
            ],
        ],
        'w2' => [
            'message' => "Wrong.\n\nArray front insert shifts.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'mid',
            'choices' => [],
        ],
        'final' => [
            'message' => "State:\nhot op = “have I seen this key?”\n\nPrefer?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Hash set/map', 'next' => 'success'],
                ['label' => 'Unsorted array scans forever without thought', 'next' => 'w3'],
            ],
        ],
        'w3' => [
            'message' => "Wrong.\n\nHash membership is the upgrade.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'final',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct.\n\n- Match structure to the hot operation\n- Arrays / lists / hash each win differently\n\nYou finished this path.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
