## Sum per level

1. `queue = [root]`, `level = 0`, `best = −∞`, `ans = 1`.
2. While the queue is not empty: `level += 1`; pop the whole level, summing values and pushing children.
3. If `sum > best`: `best = sum`, `ans = level`.

`[1,7,0,7,−8,null,null]` → level sums 1, 7, −1 → 2.

Do not start `best` at 0; every level may be negative. Do not use `≥`; ties go to the smaller level.

Time: O(n)  
Space: O(width)

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
