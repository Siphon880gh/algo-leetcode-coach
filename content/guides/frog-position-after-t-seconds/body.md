## Arrive and stay

1. `dfs(u, parent, time, p)`; `children` = neighbours except `parent`.
2. If `u == target`: return `p` when `time == t` or `children` is empty; else 0 (the frog must leave).
3. If `time == t`, return 0.
4. Return `Σ dfs(c, u, time + 1, p / len(children))`.

`t = 2`, target 4 → 1/6. `t = 1`, target 7 → 1/3.

Do not stop at the target early when it has unvisited children and time remains; the frog jumps away. Do not count the parent as a choice.

Time: O(n)  
Space: O(n)

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
