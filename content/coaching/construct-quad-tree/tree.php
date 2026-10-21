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
            'message' => "Read the problem statement above.\nWhat do you try first?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Recurse on squares: uniform → leaf, mixed → four quadrants', 'next' => 's2'],
                ['label' => 'Always split down to 1 by 1 cells, then return the tree', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Splitting all the way to single cells ignores the rule that a uniform square must be one leaf. A grid of all 0s should be a single leaf, not 4^x nodes.\nStep back to when you always split.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "On square (row r, col c, size s): check whether all cells are equal.\nIn which order do the four children go?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Any order, the judge only checks leaf values', 'next' => 'wrong_b'],
                ['label' => 'topLeft (r, c), topRight (r, c + s/2), bottomLeft (r + s/2, c), bottomRight (r + s/2, c + s/2)', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The Node fields are fixed: topLeft, topRight, bottomLeft, bottomRight. Swapping them builds a mirrored tree that fails the judge.\nStep back to when you ordered the quadrants.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Optional shortcut: build the four children first; if all four are leaves with the same value, merge them into one leaf. That makes each level O(1) per node and the whole build O(n²). Quad Tree Intersection (558) merges two finished trees.\nLock it in?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Uniform → leaf. Mixed → TL, TR, BL, BR. 1 by 1 is a leaf. Not 558', 'next' => 'success'],
                ['label' => 'Split a 1 by 1 cell into four size-0 children too', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. A 1 by 1 cell is always uniform, so it is always a leaf. Splitting it would recurse into size 0.\nStep back to when you split a single cell.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Uniform squares are leaves, mixed squares split into TL, TR, BL, BR, and 1 by 1 cells stop the recursion. [[0,1],[1,0]] → root with four leaves.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
