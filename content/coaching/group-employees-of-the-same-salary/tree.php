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
            'message' => "Problem: An employees table gives each employee's id, name and salary. Employees who share a salary with at least one other employee form a team; employees with a unique salary are left out. Teams get ids by salary rank, lowest salary first (as the statement specifies). Report each team member with their team id, ordered as the statement specifies (typically by team id, then employee id). For instance, with salaries 3000, 3000, 7400, 6100, 7400 for employees 2, 3, 7, 8, 9: employees 2 and 3 form team 1, 7 and 9 form team 2, and 8 is left out. (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nRank before or after filtering?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'After filtering out unique salaries', 'next' => 's2'],
                ['label' => 'Before', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Unique salaries would take team numbers.\nStep back to when you ranked first.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Ranking function?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'RANK', 'next' => 'wrong_b'],
                ['label' => 'DENSE_RANK', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. RANK skips numbers after ties.\nStep back to when you used RANK.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Team 1 is?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The lowest shared salary', 'next' => 'success'],
                ['label' => 'The highest', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Team ids rise with salary.\nStep back to when you ordered descending.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Constructed check → team 1: 2, 3; team 2: 7, 9.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
