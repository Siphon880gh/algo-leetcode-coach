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
            'message' => "Problem: A survey log records actions on questions: each row shows a question being shown, answered, or skipped. A question's answer rate is its answers divided by its shows. Return the question with the highest answer rate, taking the smallest question id on a tie. (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nWhat is the rate?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Answer actions divided by show actions, per question', 'next' => 's2'],
                ['label' => 'Answer actions divided by all rows of the question', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Skip and answer rows are not shows; only show rows belong in the denominator.\nStep back to when you used all rows.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "How do you count them in MySQL?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'COUNT(answer_id) / COUNT(*)', 'next' => 'wrong_b'],
                ['label' => 'SUM(action = \'answer\') / SUM(action = \'show\')', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. COUNT(*) includes the answer and skip rows, so the denominator is too big.\nStep back to when you used COUNT(*).",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Two questions have the same rate. Which wins?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'ORDER BY rate DESC, question_id, then LIMIT 1', 'next' => 'success'],
                ['label' => 'ORDER BY rate DESC, then LIMIT 1', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Without the second key, a tie returns an arbitrary question; the smallest id must win.\nStep back to when you skipped the tie rule.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Answers over shows, rate descending, then id: O(n log n).\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
