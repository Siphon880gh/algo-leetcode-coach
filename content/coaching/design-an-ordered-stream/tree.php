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
            'message' => "Read the problem statement above.\nReturn what on insert?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Filled run starting at ptr', 'next' => 's2'],
                ['label' => 'Just the inserted value', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Values wait until all earlier ids arrive.\nStep back to when you returned it alone.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "ptr slot empty?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Search ahead', 'next' => 'wrong_b'],
                ['label' => 'Return []', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Output must stay in id order.\nStep back to when you searched ahead.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Total cost?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'O(n) over all calls', 'next' => 'success'],
                ['label' => 'O(n) per call', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Each id is emitted once.\nStep back to when you estimated per call.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Example → [], [\"aaaaa\"], [\"bbbbb\",\"ccccc\"], [], [\"ddddd\",\"eeeee\"].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
