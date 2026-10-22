Write a generator that takes a start date, an end date, and a step in days, and yields every date from the start to the end, inclusive, step days apart, as date strings. The exact format and argument types are in the official statement. For instance, from 2023-04-01 to 2023-04-04 with step 1 it yields all four dates; with step 2 it yields 2023-04-01 and 2023-04-03. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## UTC steps

1. `d = new Date(start)`, `end = new Date(end)`.
2. While `d ≤ end`: yield `d.toISOString().slice(0, 10)`; `d.setUTCDate(d.getUTCDate() + step)`.

Constructed checks (run in Node): the examples above, and 2023-02-27 to 2023-03-02 with step 1 → 02-27, 02-28, 03-01, 03-02.

Use ≤, since the end is included; < drops 2023-04-04. Date-only strings parse as UTC, so local getters west of UTC start a day early: with TZ=America/Los_Angeles the first example begins at 2023-03-31.

Time: O(number of dates)  
Space: O(1)

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
