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
                ['label' => 'Count edges: 4 per land cell, minus the shared ones', 'next' => 's2'],
                ['label' => 'Count the land cells', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Counting land cells gives area, not perimeter. The example has 7 land cells and perimeter 16.\nStep back to when you counted cells.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Walk every cell. For land, add 4.\nWhat do you subtract?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '2 for each of the four neighbors that is land', 'next' => 'wrong_b'],
                ['label' => '2 if the cell below is land, 2 if the cell to the right is land', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Looking in all four directions finds each touching pair twice. Subtracting 2 each time removes 4 per pair.\nStep back to when you checked all four neighbors.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Each touching pair hides one side on each cell, so 2 per pair, found once by looking down and right. O(rows × cols), O(1) space. Number of Islands (200) counts islands.\nLock it in?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '4 × land − 2 × shared pairs (down and right only). Not 200', 'next' => 'success'],
                ['label' => 'Subtract 1 per shared side', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. One shared side removes a side from both cells, so it is 2, not 1.\nStep back to when you subtracted 1.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. 4 per land cell, minus 2 per pair that touches below or to the right. Example → 16.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
