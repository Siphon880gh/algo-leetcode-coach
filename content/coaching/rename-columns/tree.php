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
            'message' => "Read the problem statement above.\nPass the mapping as?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'columns={...}', 'next' => 's2'],
                ['label' => 'The first positional argument', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. A bare mapping renames index labels; the columns stay id, first, last, age.\nStep back to when you dropped columns=.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Return?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The original students', 'next' => 'wrong_b'],
                ['label' => 'The DataFrame rename returns', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. rename does not change it in place; the old names remain.\nStep back to when you returned the original.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Columns → student_id, first_name, last_name, age_in_years.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
