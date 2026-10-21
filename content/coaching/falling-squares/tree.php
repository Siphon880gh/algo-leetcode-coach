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
            'message' => "Read the problem statement above.\nWhere does a new square come to rest?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'On the highest top among earlier squares overlapping its span', 'next' => 's2'],
                ['label' => 'On the square directly below its left edge', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Any overlap along its whole width can hold it up.\nStep back to when you looked only at the left edge.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "A square covering [1, 3) and one covering [3, 5) touch at 3. Do they stack?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Yes', 'next' => 'wrong_b'],
                ['label' => 'No: the right end is open, so touching is not overlapping', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Edges that only touch let the square slide down.\nStep back to when you stacked them.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "What do you output after each drop?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The tallest stack so far', 'next' => 'success'],
                ['label' => 'The height of the new square only', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The answer is the maximum height on the board.\nStep back to when you reported only the new square.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n²) overlap checks, or a segment tree with range max and assign. [[1,2],[2,3],[6,1]] → [2,5,5].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
