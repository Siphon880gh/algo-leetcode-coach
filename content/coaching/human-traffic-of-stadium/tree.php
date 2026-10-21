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
            'message' => "Read the problem statement above.\nWhat does consecutive mean here?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Consecutive ids', 'next' => 's2'],
                ['label' => 'Consecutive visit dates', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The problem defines consecutive rows by id, which can differ from the date order.\nStep back to when you used dates.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "After keeping people >= 100, how do you label each run?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'ROW_NUMBER() on its own', 'next' => 'wrong_b'],
                ['label' => 'id − ROW_NUMBER() OVER (ORDER BY id)', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. ROW_NUMBER keeps rising across gaps in the ids, so it cannot tell where a run ends.\nStep back to when you used the row number alone.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Which rows do you keep?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Rows whose run has COUNT(*) OVER (PARTITION BY grp) >= 3', 'next' => 'success'],
                ['label' => 'Rows whose next two rows are busy (LEAD)', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The last two rows of a run have no two busy rows after them, but they are part of the run.\nStep back to when you only looked ahead.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Filter, id − ROW_NUMBER() as the run key, keep runs of 3+, order by visit_date: O(n log n).\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
