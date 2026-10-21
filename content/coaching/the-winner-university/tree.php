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
            'message' => "Problem: Two tables, one per university (New York and California), list student ids and exam scores. A student is excellent when the score reaches a threshold the statement gives. Report the university with more excellent students, or that there is no winner when the counts are equal. For instance, with a sample threshold of 90, New York scores 90, 87 and California scores 89, 95, 91 → California University; dropping the 91 makes it a tie. (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nCombine the two tables?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: two scalar subqueries', 'next' => 's2'],
                ['label' => 'JOIN them on student id', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Student ids belong to different universities, so a join pairs unrelated students and drops or duplicates rows.\nStep back to when you joined.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Count which rows?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'All rows', 'next' => 'wrong_b'],
                ['label' => 'Rows meeting the score threshold', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Only excellent students count; with all rows the sample above becomes 2 against 3 for the wrong reason.\nStep back to when you counted every row.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Equal counts?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Report no winner', 'next' => 'success'],
                ['label' => 'Pick either university', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. A tie has its own output.\nStep back to when you picked one.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Constructed check → California University, then No Winner after the tie.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
