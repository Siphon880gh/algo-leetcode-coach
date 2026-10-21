## Monotone in the wait

1. Multi-source BFS from fire cells: `fire[c]` = minute cell `c` burns (∞ if never).
2. `ok(w)`: BFS from `(0,0)` at time `w`; enter a grass cell at time `t` only if `t < fire[c]`, or `t ≤ fire[c]` for the safehouse.
3. If `ok(0)` fails, −1; if `ok(10^9)` holds, 10^9; otherwise binary search the largest `w` with `ok(w)`.

Examples → 3, −1, 10^9. Checked against a minute-by-minute simulation on 300 small grids.

Waiting longer can only make the race harder, so `ok` is monotone. The safehouse exception exists because arriving as the fire does still counts.

Time: O(m · n · log(m · n))  
Space: O(m · n)

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
