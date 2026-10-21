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
            'message' => "Read the problem statement above.\nThe width can be 2^31. Try every x position?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: only positions where some brick ends matter', 'next' => 's2'],
                ['label' => 'Yes: sweep x from 1 to width − 1', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The width is huge; only brick edges can be better than crossing every row.\nStep back to when you swept every x.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "How do you find edge positions in a row?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Prefix sums including the last brick', 'next' => 'wrong_b'],
                ['label' => 'Prefix sums of the brick widths, skipping the last brick', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The last prefix is the right side of the wall, and a line there crosses nothing by definition, which is not allowed.\nStep back to when you counted the wall end.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "You have a hash map position → number of rows with an edge there. Answer?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'rows − the largest count (rows if the map is empty)', 'next' => 'success'],
                ['label' => 'The largest count', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The count is rows the line avoids; the question asks for bricks crossed.\nStep back to when you returned the count.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Edge counts in a hash map, answer rows − max: O(total bricks) time and space.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
