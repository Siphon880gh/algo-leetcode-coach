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
            'message' => "Read the problem statement above.\nOutput size?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '(n − 2) × (n − 2)', 'next' => 's2'],
                ['label' => 'n × n, clipping blocks at the border', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 needs 2 × 2, not 4 × 4.\nStep back to when you kept n × n.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Maximum over?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The middle row and middle column', 'next' => 'wrong_b'],
                ['label' => 'All 9 cells of the block', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Corners are skipped; Example 1 → [[9,8],[8,6]] instead of [[9,9],[8,6]].\nStep back to when you used only the cross.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Block for out[i][j]?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Rows i … i + 2, columns j … j + 2', 'next' => 'success'],
                ['label' => 'Rows i − 1 … i + 1, columns j − 1 … j + 1', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Index −1 is out of range; Python wraps it and Example 1 → [[9,9],[9,9]].\nStep back to when you centred on (i, j).",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n²). Examples → [[9,9],[8,6]], [[2,2,2],[2,2,2],[2,2,2]].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
