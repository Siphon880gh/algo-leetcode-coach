Add a method to every Date that returns the following calendar day as a date string, such as year-month-day. The method name and exact format are in the official statement. For instance, for new Date("2014-06-20") the next day is 2014-06-21, and for 2016-02-28 it is 2016-02-29. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## UTC day

1. `const d = new Date(this.getTime())`.
2. `d.setUTCDate(d.getUTCDate() + 1)`.
3. Return `d.toISOString().slice(0, 10)`.

Constructed checks (run in Node): 2014-06-20 → 2014-06-21, 2017-10-31 → 2017-11-01, 2016-02-28 → 2016-02-29, 2023-12-31 → 2024-01-01.

setUTCDate handles month and year rollover. Mixing in local time breaks west of UTC: with TZ=America/Los_Angeles, setDate and getDate on new Date("2014-06-20") give 2014-06-20 instead of 2014-06-21.

Time: O(1)  
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
