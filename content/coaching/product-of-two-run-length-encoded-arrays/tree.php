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
            'message' => "Problem: Two run-length encoded arrays are given as lists of [value, frequency] pairs and expand to arrays of the same length. Return the run-length encoding of their element-wise product, using as few runs as possible (adjacent runs with equal values are merged). For instance, [[1,3],[2,3]] × [[6,3],[3,3]] → [[6,6]], and [[1,3],[2,1],[3,2]] × [[2,3],[3,3]] → [[2,3],[6,1],[9,2]]. (Restated from memory; limits and examples may differ slightly.)\nExpand the arrays?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No, walk runs directly', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Frequencies can be huge.\nStep back to when you expanded.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Chunk length?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The first run\'s frequency', 'next' => 'wrong_b'],
                ['label' => 'min of the two remaining frequencies', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The other run may end sooner.\nStep back to when you ignored it.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Product equals the last output value?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Extend the last run', 'next' => 'success'],
                ['label' => 'Append a new run', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The output must use as few runs as possible.\nStep back to when you appended.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(len(a) + len(b)). Constructed check → [[6,6]], [[2,3],[6,1],[9,2]].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
