Design a to-do list shared by many users. Each user can add tasks that carry a description, a due date and a set of tags, and gets back the new task’s id. A user can list their tasks that are not yet completed in due-date order, list only those that carry a given tag, and mark one of their tasks complete. The exact method names, how ids are numbered and what happens for unknown ids are in the official statement. For instance, user 1 adds report (due 50, tag work) and groceries (due 30, no tags); listing gives groceries, report; filtering by work gives report; after completing report, listing gives groceries. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Per-user lists

1. A global counter hands out task ids; `tasks[user]` is a list of records {id, description, due, tags, done}.
2. Add: create a record, append it, return its id.
3. List: take the user’s records that are not done (and carry the tag, if one is asked for), sort by due date, return the descriptions.
4. Complete: find the record by id in that user’s list and mark it done.

Constructed checks (run against this design): the walk-through above gives ids 1 and 2 and the listed results shown; another user’s list is unaffected.

Calls are few, so sorting on each listing is fine; a sorted container per user also works when listings are frequent. Keep tags in a set so the tag filter is a quick lookup.

Time: O(1) add and complete by id with a map, O(k log k) to list k tasks  
Space: O(total tasks)

> [!ui-builder] Mini game
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a mini-game in this Algo Learning IDE app that teaches [INPUT_TOPIC]. Place it under content/games/[INPUT_SLUG]/. Follow meta.php + index.html. Use .agents/skills/game-development-sickn33 for web/2d craft if needed.

> [!ui-builder] Step-by-step
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a step-by-step session for [INPUT_TOPIC] under content/coaching/[INPUT_SLUG]/. Include branching choices with clear labels, at least one wrong-path leaf with rewind_to, and a success leaf. Follow the tree.php contract so Step back and the Path visualizer work.
