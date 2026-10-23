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
            'message' => "State:\nTwo Sum [2,7,11,15], target 9, scanning at 7\n\nNeed in map?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '2', 'next' => 'mid'],
                ['label' => '7', 'next' => 'w1'],
            ],
        ],
        'w1' => [
            'message' => "Wrong.\n\nneed = target-7 = 2.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'mid' => [
            'message' => "State:\ngroup anagrams\n\nKey idea?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Map sorted signature → list of words', 'next' => 'final'],
                ['label' => 'Nested compare every pair only', 'next' => 'w2'],
            ],
        ],
        'w2' => [
            'message' => "Wrong.\n\nHash groups by signature.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'mid',
            'choices' => [],
        ],
        'final' => [
            'message' => "State:\nsubarray sum equals k with prefixes\n\nStore?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'prefix → count/index in a map', 'next' => 'success'],
                ['label' => 'Only the raw array', 'next' => 'w3'],
            ],
        ],
        'w3' => [
            'message' => "Wrong.\n\nMap turns prefix differences into O(1) hits.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'final',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct.\n\n- Map the pattern\n- Store the Y you will query later\n\nYou finished this path.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
