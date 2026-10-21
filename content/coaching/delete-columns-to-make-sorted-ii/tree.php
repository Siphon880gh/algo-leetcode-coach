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
            'message' => "Read the problem statement above.\nJudge each column on its own as in part I?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: rows are compared as whole strings', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. A column that is unsorted can be fine if earlier columns already order the rows.\nStep back to when you judged columns alone.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "A kept column has strs[i][j] < strs[i+1][j]. Then?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Nothing', 'next' => 'wrong_b'],
                ['label' => 'Mark the pair (i, i+1) as settled', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. That pair no longer depends on later columns.\nStep back to when you ignored it.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "A column breaks a settled pair. Delete it?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: settled pairs ignore later columns', 'next' => 'success'],
                ['label' => 'Yes', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Their order is already decided.\nStep back to when you deleted it.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n · m). [\"ca\",\"bb\",\"ac\"] → 1. [\"xc\",\"yb\",\"za\"] → 0. [\"zyx\",\"wvu\",\"tsr\"] → 3.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
