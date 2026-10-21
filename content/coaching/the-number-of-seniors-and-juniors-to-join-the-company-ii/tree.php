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
            'message' => "Problem: The same hiring setup as part I: a candidates table with each candidate's id, experience (Senior or Junior) and salary, and a fixed budget given in the statement. Hire seniors cheapest first while the running total fits the budget, then juniors cheapest first with the remainder, and report the ids of everyone hired, as the statement specifies. For instance, with a made-up budget of 100, seniors 1 (30), 2 (50), 3 (40) and juniors 4 (10), 5 (20), 6 (40): hired ids 1, 3, 4, 5. (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nOutput?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The ids of hired candidates', 'next' => 's2'],
                ['label' => 'Counts per level', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. That was part I; this one lists who is hired.\nStep back to when you counted.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Running sums computed how?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'One window over all candidates', 'next' => 'wrong_b'],
                ['label' => 'Separately for seniors and for juniors', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Juniors must only compete for what the seniors left.\nStep back to when you used one window.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "No senior fits the budget?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Juniors get the whole budget (spent = 0)', 'next' => 'success'],
                ['label' => 'Return nothing', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. With no seniors hired, juniors can still be hired; COALESCE the spent amount to 0.\nStep back to when you returned nothing.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Constructed check → 1, 3, 4, 5.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
