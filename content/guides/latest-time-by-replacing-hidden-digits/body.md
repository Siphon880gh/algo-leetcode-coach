## Four positions

1. `h1 = ?` → `2` if `h2` is `?` or ≤ `3`, else `1`.
2. `h2 = ?` → `3` if `h1` is `2`, else `9`.
3. `m1 = ?` → `5`; `m2 = ?` → `9`.

`"2?:?0"` → `"23:50"`. `"0?:3?"` → `"09:39"`. `"1?:22"` → `"19:22"`. Constructed: `"?4:00"` → `"14:00"`.

Decide `h1` before `h2`; when both are hidden, the result is `23`. Do not set `h1 = 2` when `h2` is 4–9.

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
