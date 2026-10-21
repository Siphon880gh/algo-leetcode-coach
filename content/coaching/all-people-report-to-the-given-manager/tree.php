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
            'message' => "Problem: An employees table gives each employee's direct manager, and the head is their own manager. Return everyone other than the head who reports to the head directly or through a short chain (the statement gives the depth limit; three levels in the usual version). (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nHow to follow the chain?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Self-join once per level', 'next' => 's2'],
                ['label' => 'One join only', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. One join finds only direct reports.\nStep back to when you used one join.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Filter on?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The first manager only', 'next' => 'wrong_b'],
                ['label' => 'The last joined manager = @head', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Indirect reports have someone else as direct manager.\nStep back to when you filtered the first link.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "The head itself?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Exclude it', 'next' => 'success'],
                ['label' => 'Keep it', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The head is their own manager, so it matches; drop it.\nStep back to when you kept it.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. A fixed number of self-joins, filtered on the head, excluding the head.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
