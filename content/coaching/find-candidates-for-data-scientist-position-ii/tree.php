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
            'message' => "Problem: One table lists candidates’ skills with a proficiency, and another lists projects’ required skills with an importance. For each project, pick the best candidate who has every required skill, scoring each candidate by how their proficiencies compare with the importances, as the statement defines the score and tie-break. Table, column and output names, and the ordering, are in the official statement. (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nKeep which pairs?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Those covering every required skill', 'next' => 's2'],
                ['label' => 'Any matching skill', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. In the guide’s check candidate 100 wins project 1 without sql.\nStep back to when you dropped the coverage test.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Pick the top with?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'RANK by score only', 'next' => 'wrong_b'],
                ['label' => 'ROW_NUMBER with the tie-break', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Two candidates with equal scores both get rank 1, so the project returns two rows (checked in SQLite).\nStep back to when you used RANK.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). The guide’s check → (1, 101, 110), (2, 100, 100).\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
