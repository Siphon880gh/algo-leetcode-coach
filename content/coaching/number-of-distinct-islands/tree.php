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
            'message' => "Problem: Problem: Given a binary grid, count the islands of different shape, where two islands are the same if one can be translated (not rotated or reflected) onto the other. (Restated from memory; limits and examples may differ slightly.)\nHow do you compare shapes?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Turn each into a key and store the keys in a set', 'next' => 's2'],
                ['label' => 'Compare every pair of islands cell by cell', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Pairwise comparison is slow; a hashable key per shape makes counting a set size.\nStep back to when you compared pairs.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "How do you remove translation?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Record absolute coordinates', 'next' => 'wrong_b'],
                ['label' => 'Record (r − r0, c − c0) from the island\'s first cell in scan order', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Absolute coordinates make every island unique.\nStep back to when you used absolute coordinates.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Using a DFS direction string instead, what else must you record?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'A back marker when leaving each cell', 'next' => 'success'],
                ['label' => 'Nothing else', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Without back markers, different shapes can produce the same direction string.\nStep back to when you dropped the markers.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. One flood fill per island plus a set: O(m · n). [[1,1,0,0,0],[1,1,0,0,0],[0,0,0,1,1],[0,0,0,1,1]] → 1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
