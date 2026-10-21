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
            'message' => "Read the problem statement above.\nWhat size is the grid?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'h + 1 rows and 2^(h+1) − 1 columns, for height h (edges)', 'next' => 's2'],
                ['label' => 'n rows and n columns', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The size depends on the height, not the node count.\nStep back to when you used n.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Where does the root go?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Row 0, column 0', 'next' => 'wrong_b'],
                ['label' => 'Row 0, column (cols − 1) / 2', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The root is centered.\nStep back to when you used column 0.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "A node at row r, column c. Its children?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Row r + 1, columns c ∓ 2^(h − r − 1)', 'next' => 'success'],
                ['label' => 'Columns c − 1 and c + 1', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The gaps halve each level, or subtrees would overlap.\nStep back to when you used a fixed offset.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Fill a grid of empty strings by DFS: O(h · 2^h). [1,2] → [[\"\",\"1\",\"\"],[\"2\",\"\",\"\"]].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
