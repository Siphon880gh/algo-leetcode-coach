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
            'message' => "Problem: One table gives each task and its number of subtasks (numbered from 1 up to that count); another lists the (task, subtask) pairs that were executed. Report every (task, subtask) pair that was not executed, with the column names the statement specifies. For instance, task 1 with 3 subtasks of which only subtask 2 ran, and task 2 with 2 subtasks that both ran, give (1, 1) and (1, 3). (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nGenerate subtask ids how?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Recursive CTE counting up to the count', 'next' => 's2'],
                ['label' => 'Hard-code a numbers list', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Counts vary; the recursion adapts per task.\nStep back to when you hard-coded numbers.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Stop condition?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'A global maximum', 'next' => 'wrong_b'],
                ['label' => 'sub < that task\'s count', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Each task stops at its own count.\nStep back to when you used a global limit.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Keep which rows?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Unmatched after the left join', 'next' => 'success'],
                ['label' => 'Matched rows', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. We want the ones that did not run.\nStep back to when you kept matches.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(total subtasks). Constructed check → (1, 1), (1, 3).\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
