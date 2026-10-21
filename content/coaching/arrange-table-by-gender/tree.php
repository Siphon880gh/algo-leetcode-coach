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
            'message' => "Problem: A table Genders records user_id and gender, where gender is female, other or male and the three appear equally often. Rearrange the rows so the genders alternate female, other, male, female, other, male and so on, with each gender’s users in ascending user_id order. For instance, female users 3, 7, 9, other users 1, 2, 6 and male users 4, 5, 8 → 3, 1, 4, 7, 2, 5, 9, 6, 8. (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nGender order within a round?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'CASE: female, other, male', 'next' => 's2'],
                ['label' => 'ORDER BY gender alphabetically', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. That gives female, male, other; the constructed case → 3, 4, 1, … instead of 3, 1, 4, ….\nStep back to when you sorted alphabetically.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Number users how?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Sort all users by user_id', 'next' => 'wrong_b'],
                ['label' => 'ROW_NUMBER within each gender by user_id', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The constructed case → 1, 2, 3, … with genders out of turn.\nStep back to when you dropped the per-gender rank.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Sort keys?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Rank, then gender', 'next' => 'success'],
                ['label' => 'Gender, then rank', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. All females come first: 3, 7, 9, 1, … instead of 3, 1, 4, ….\nStep back to when you sorted by gender first.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Constructed check → 3, 1, 4, 7, 2, 5, 9, 6, 8.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
