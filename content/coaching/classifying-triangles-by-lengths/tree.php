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
            'message' => "Problem: A table lists three side lengths per row. Classify each row as equilateral, isosceles, scalene, or not a triangle, using the labels the statement gives. Table, column and output names, and the ordering, are in the official statement. (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nFirst CASE branch?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Not a triangle', 'next' => 's2'],
                ['label' => 'Equilateral or isosceles', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. (2, 2, 5) comes out isosceles.\nStep back to when you tested equal sides first.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Not a triangle when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'A + B ≤ C only', 'next' => 'wrong_b'],
                ['label' => 'Any two sides sum to at most the third', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. (20, 30, 5) comes out scalene, but 20 + 5 ≤ 30.\nStep back to when you checked one sum.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). The check → equilateral, isosceles, scalene, not, not.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
