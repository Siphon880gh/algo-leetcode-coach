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
            'message' => "State:\nTwo Sum on [2, 7, 11, 15]\ntarget 9\nthe scan is at 7\n\nWhich value must already be in the map?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '2', 'next' => 'mid'],
                ['label' => '7', 'next' => 'w1'],
            ],
        ],
        'w1' => [
            'message' => "Wrong.\n\nYou need target − 7 = 2.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'mid' => [
            'message' => "State:\ngroup words that are anagrams of each other\n\nWhat is the key idea?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Map each sorted signature to a list of words', 'next' => 'final'],
                ['label' => 'Compare every pair of words with nested loops', 'next' => 'w2'],
            ],
        ],
        'w2' => [
            'message' => "Wrong.\n\nA hash map groups words by their signature in one pass.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'mid',
            'choices' => [],
        ],
        'final' => [
            'message' => "State:\ncount the subarrays whose sum equals k, using prefix sums\n\nWhat do you store?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'A map from each prefix sum to its count or index', 'next' => 'success'],
                ['label' => 'Only the raw array', 'next' => 'w3'],
            ],
        ],
        'w3' => [
            'message' => "Wrong.\n\nThe map turns each prefix difference into an O(1) lookup.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'final',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct.\n\n- Match the problem to a pattern.\n- Store the value you will look up later.\n\nYou finished this path.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
