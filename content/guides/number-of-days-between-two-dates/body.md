## Day numbers

1. `days(y, m, d)`: add 365 or 366 for each year from 1971 to `y − 1`; add month lengths for months before `m` (February 29 in leap years); add `d`.
2. Leap year: divisible by 4 and not by 100, or divisible by 400.
3. Return `|days(date1) − days(date2)|`.

`"2019-06-29"`, `"2019-06-30"` → 1. `"2020-01-15"`, `"2019-12-31"` → 15.

Do not forget the 100 and 400 rules. Do not return a signed difference; the dates can come in either order.

Time: O(years)  
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
