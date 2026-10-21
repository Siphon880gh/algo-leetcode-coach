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
            'message' => "Problem: A candidates table lists each candidate's id, experience (Senior or Junior) and salary, and the company has a fixed hiring budget given in the statement. Hire seniors first, cheapest first, as long as the running total stays within the budget; then hire juniors, cheapest first, with what remains. Report the number of accepted seniors and juniors, one row each, as the statement specifies. For instance, with a made-up budget of 100, seniors earning 30, 40, 50 and juniors earning 10, 20, 40: seniors 2 (spending 70) and juniors 2. (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nHiring order?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Seniors first, then juniors with the rest', 'next' => 's2'],
                ['label' => 'Cheapest candidates first, whatever the level', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Seniors take priority; mixing levels changes who is hired.\nStep back to when you mixed the levels.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Running cost ordered by?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Employee id', 'next' => 'wrong_b'],
                ['label' => 'Salary ascending', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Cheapest first maximises how many fit.\nStep back to when you ordered by id.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Budget for juniors?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The budget minus what the hired seniors spent', 'next' => 'success'],
                ['label' => 'The full budget', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. In the example the juniors only have 30 left after 70 on seniors.\nStep back to when you reused the full budget.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Constructed check → Senior 2, Junior 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
