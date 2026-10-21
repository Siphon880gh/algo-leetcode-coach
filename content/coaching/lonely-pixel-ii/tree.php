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
            'message' => "Problem: up to 200 × 200 of B and W, and target. Count Bs at (r, c) where row r and column c have exactly target Bs, and all rows with a B in column c equal row r. Sample → 6. (Restated from memory; limits and examples may differ slightly.)\nWhat do you try first?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Counts plus the identical-rows rule', 'next' => 's2'],
                ['label' => 'Count Bs where rows[r] == cols[c] == target', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Counts alone are not enough; the rows sharing the column must also be identical.\nStep back to when you only checked counts.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Column c has target Bs.\nWhat else do you check?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only compare row r with the rows above and below it', 'next' => 'wrong_b'],
                ['label' => 'Take the first black row r; rows[r] == target and every black row in c equals row r', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The rule is about all rows with a B in column c, not neighbors.\nStep back to when you compared adjacent rows.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "If the column passes, all its target Bs count: add target. Compare rows as strings. O(m n · m) worst case.\nLock it in?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Per-column test, add target when it passes', 'next' => 'success'],
                ['label' => 'Run the full test separately for every B', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Counting each pixel separately repeats the same column test target times.\nStep back to when you tested each pixel on its own.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Column by column: counts and identical rows, then add target. → 6.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
