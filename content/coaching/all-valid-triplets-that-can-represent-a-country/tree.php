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
            'message' => "Problem: Three school tables each list students (id and name). Report every triplet with one student from each school such that no two of the three share an id or a name, with the columns the statement specifies. For instance, A = (1, Ann), B = (2, Bob), C = (3, Cid) is valid; changing C to (1, Cid) is not. (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nJoin condition?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Cross join plus inequality filters', 'next' => 's2'],
                ['label' => 'Equality join on id', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The ids must differ, not match.\nStep back to when you joined on equality.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Which pairs to test?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'a–b and b–c only', 'next' => 'wrong_b'],
                ['label' => 'All three: a–b, a–c, b–c', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. a and c could still clash.\nStep back to when you skipped a–c.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Test names too?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Yes, all three pairs', 'next' => 'success'],
                ['label' => 'Ids are enough', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Two students may share a name with different ids.\nStep back to when you skipped names.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Constructed check: (1, Ann), (2, Bob), (3, Cid) → one row.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
