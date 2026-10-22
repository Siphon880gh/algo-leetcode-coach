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
            'message' => "Problem: A table lists events, each with a hall and a start day and end day. Within each hall, events that overlap are merged, and chains of overlapping events become one event. Return each hall’s merged events with their first and last days. For instance, one hall with events 1–5, 3–4 and 6–7 → 1–5 and 6–7. (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nA new block starts when the start is past?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The largest end of all earlier events', 'next' => 's2'],
                ['label' => 'The previous row’s end', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. A long event covers later short ones; 1–10, 2–3, 5–6 → 1–10 and 5–6 instead of 1–10.\nStep back to when you used the previous row.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "A block’s days?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'First row’s start to last row’s end', 'next' => 'wrong_b'],
                ['label' => 'MIN(start) to MAX(end)', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The last row need not end last; 1–10, 2–3, 5–6 → 1–6 instead of 1–10.\nStep back to when you took the last row.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). Constructed check (run in SQLite) → (1, 1, 5), (1, 6, 7), (2, 2, 4).\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
