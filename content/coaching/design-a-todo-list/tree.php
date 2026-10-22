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
            'message' => "Problem: Design a to-do list shared by many users. Each user can add tasks that carry a description, a due date and a set of tags, and gets back the new task’s id. A user can list their tasks that are not yet completed in due-date order, list only those that carry a given tag, and mark one of their tasks complete. The exact method names, how ids are numbered and what happens for unknown ids are in the official statement. For instance, user 1 adds report (due 50, tag work) and groceries (due 30, no tags); listing gives groceries, report; filtering by work gives report; after completing report, listing gives groceries. (Restated from memory; limits and examples may differ slightly.)\nListing a user’s tasks: completed ones?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Leave them out', 'next' => 's2'],
                ['label' => 'Include them', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Only pending tasks are listed; after completing report, listing → groceries, report instead of groceries.\nStep back to when you kept finished tasks.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Order of the listing?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'In the order they were added', 'next' => 'wrong_b'],
                ['label' => 'By due date', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Insertion order ignores the dates; the first listing → report, groceries instead of groceries, report.\nStep back to when you kept insertion order.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(k log k) per listing. Constructed checks → ids 1, 2; groceries, report; report; groceries.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
