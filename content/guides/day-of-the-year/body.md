## Add the months before

1. Parse `y`, `m`, `d` from `YYYY-MM-DD`.
2. `days = [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31]`.
3. Leap year if `y % 4 == 0 and (y % 100 != 0 or y % 400 == 0)`; then set `days[1] = 29`.
4. Return `sum(days[:m − 1]) + d`.

`"2019-01-09"` → 9, `"2019-02-10"` → 31 + 10 = 41.

Do not treat 1900 as a leap year; it is divisible by 100 but not 400. Do not add the current month's length.

Time: O(1)  
Space: O(1)

> [!ui-builder] Mini game
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a mini-game in this Leetcode Practice Coach IDE app that teaches [INPUT_TOPIC]. Place it under content/games/[INPUT_SLUG]/. Follow meta.php + index.html. Use .agents/skills/game-development-sickn33 for web/2d craft if needed.

> [!ui-builder] Step-by-step
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a step-by-step session for [INPUT_TOPIC] under content/coaching/[INPUT_SLUG]/. Include branching choices with clear labels, at least one wrong-path leaf with rewind_to, and a success leaf. Follow the tree.php contract so Step back and the Path visualizer work.
