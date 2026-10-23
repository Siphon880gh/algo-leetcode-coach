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
            'message' => "State:\ncombinations size 2 from [1,2,3]\n\nIncludes?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '[1,2],[1,3],[2,3]', 'next' => 'mid'],
                ['label' => 'Also [2,1] as different', 'next' => 'w1'],
            ],
        ],
        'w1' => [
            'message' => "Wrong.\n\nCombinations ignore order.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'mid' => [
            'message' => "State:\navoid ordered dups in combinations\n\nTrick?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Start index / pick only forward', 'next' => 'final'],
                ['label' => 'used[] exactly like permutations', 'next' => 'w2'],
            ],
        ],
        'w2' => [
            'message' => "Wrong.\n\nForward index is the usual combo trick.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'mid',
            'choices' => [],
        ],
        'final' => [
            'message' => "State:\nN-Queens board search\n\nChoice list?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Columns (or cells) that are not banned', 'next' => 'success'],
                ['label' => 'Take/skip each number 1..n as a subset', 'next' => 'w3'],
            ],
        ],
        'w3' => [
            'message' => "Wrong.\n\nBoard search tries placements.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'final',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct.\n\n- Same template; different choice lists\n- Combos pick forward\n\nYou finished this path.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
